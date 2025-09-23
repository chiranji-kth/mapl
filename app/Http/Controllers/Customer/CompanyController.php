<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Model\Company;
use App\Model\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CompanyRepository;

class CompanyController extends Controller
{

    protected $companyRepositories;

    public function __construct(CompanyRepository $companyRepositories)
    {
        $this->companyRepositories = $companyRepositories;
    }

    public function index(Request $request)
    {
        // Eager load branch relation
        $results = Company::with('branch')->orderBy('company_id', 'DESC');

        // Apply filters if AJAX request
        if ($request->ajax()) {
            if ($request->company_name != '') {
                $results->where('company_name', 'like', '%' . $request->company_name . '%');
            }

            if ($request->status != '') {
                $results->where('status', $request->status);
            }

            $results = $results->get();
            return view('admin.company.pagination', ['results' => $results])->render();
        }

        // Non-AJAX: apply status filter from query string if present
        if ($request->status != '') {
            $results->where('status', $request->status);
        }

        $results = $results->get();

        return view('admin.company.index', ['results' => $results]);
    }




    public function create()
    {
        $branches = Branch::orderBy('branch_name')->get();
        return view('admin.company.form', compact('branches'));
    }

    public function store(CompanyRequest $request)
    {
        $photo1 = $request->file('site_photo_1');
        if ($photo1) {
            $imgName1 = md5(str_random(30) . time() . '_' . $request->file('site_photo_1')) . '.' . $request->file('site_photo_1')->getClientOriginalExtension();
            $request->file('site_photo_1')->move('uploads/companyPhoto/', $imgName1);
            $companyPhoto1['site_photo_1'] = $imgName1;
        }
        $photo2 = $request->file('site_photo_2');
        if ($photo2) {
            $imgName2 = md5(str_random(30) . time() . '_' . $request->file('site_photo_2')) . '.' . $request->file('site_photo_2')->getClientOriginalExtension();
            $request->file('site_photo_2')->move('uploads/companyPhoto/', $imgName2);
            $companyPhoto2['site_photo_2'] = $imgName2;
        }
        $companyDataFormat = $this->companyRepositories->makeCompanyDataFormat($request->all());
        //echo "<pre>"; print_r($companyDataFormat); exit;//
        if (isset($companyPhoto1)) {
            $companyData = $companyDataFormat + $companyPhoto1;
        } else {
            $companyData = $companyDataFormat;
        }
        if (isset($companyPhoto2)) {
            $companyData = $companyData + $companyPhoto2;
        } else {
            $companyData = $companyData;
        }
        // echo "<pre>"; print_r($companyData); exit;
        try {
            DB::beginTransaction();

            $childData = Company::create($companyData);

            DB::commit();
            return ajaxResponse(200, 'Company information successfully saved.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function show($id)
    {
        $companyInfo = Company::select('company.*', 'branch.branch_name as branch')
            ->leftJoin('branch', 'branch.branch_id', '=', 'company.branch_id')
            ->where('company.company_id', $id)
            ->first();

        return view('admin.company.details', ['result' => $companyInfo]);
    }

    public function edit($id)
    {
        $editModeData = Company::findOrFail($id);
        $branches = Branch::orderBy('branch_name')->get();

        return view('admin.company.editform', compact('editModeData', 'branches'));
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        $photo1 = $request->file('site_photo_1');
        if ($photo1) {
            $imgName1 = md5(str_random(30) . time() . '_' . $request->file('site_photo_1')) . '.' . $request->file('site_photo_1')->getClientOriginalExtension();
            $request->file('site_photo_1')->move('uploads/companyPhoto/', $imgName1);
            if (file_exists('uploads/companyPhoto/' . $company->site_photo_1) and !empty($company->site_photo_1)) {
                unlink('uploads/companyPhoto/' . $company->site_photo_1);
            }
            $companyPhoto1['site_photo_1'] = $imgName1;
        }
        $photo2 = $request->file('site_photo_2');
        if ($photo2) {
            $imgName2 = md5(str_random(30) . time() . '_' . $request->file('site_photo_2')) . '.' . $request->file('site_photo_2')->getClientOriginalExtension();
            $request->file('site_photo_2')->move('uploads/companyPhoto/', $imgName2);
            if (file_exists('uploads/companyPhoto/' . $company->site_photo_2) and !empty($company->site_photo_2)) {
                unlink('uploads/companyPhoto/' . $company->site_photo_2);
            }
            $companyPhoto2['site_photo_2'] = $imgName2;
        }
        $companyDataFormat = $this->companyRepositories->makeCompanyDataFormat($request->all());

        if (isset($companyPhoto1)) {
            $companyData = $companyDataFormat + $companyPhoto1;
        } else {
            $companyData = $companyDataFormat;
        }
        if (isset($companyPhoto2)) {
            $companyData = $companyData + $companyPhoto2;
        } else {
            $companyData = $companyData;
        }

        try {
            DB::beginTransaction();

            // Update Personal Information
            $company->update($companyData);

            DB::commit();
            return ajaxResponse(200, 'Company information successfully updated.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return ajaxResponse(500, 'Something Error Found !, Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $data = Company::FindOrFail($id);
            $data->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            echo "success";
        } elseif ($bug == 1451) {
            echo 'hasForeignKey';
        } else {
            echo 'error';
        }
    }

    // public function updateStatus(Request $request)
    // {
    //     $result = Customer::where('customer_id', $request->customer_id)->update(['status' => $request->status]);
    //     if (!!$result) {
    //         return "success";
    //     }
    // }

    public function toggleStatus($id)
    {
        $company = Company::findOrFail($id);
        $company->status = $company->status == 1 ? 0 : 1;
        $company->save();

        return redirect()->back()->with('success', 'Company status updated!');
    }
}
