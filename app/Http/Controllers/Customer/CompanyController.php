<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Model\Company;
use App\Model\Branch;
use App\Model\State;
use App\Model\District;
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
        $branches = Branch::all();
        $states = State::all();
        $districts = District::all();

        if ($request->ajax()) {
            $query = Company::with(['branch', 'states', 'districts']);

            // Status filter
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Branch filter
            if ($request->has('branch_id') && $request->branch_id !== '') {
                $query->where('branch_id', $request->branch_id);
            }

            // State filter (✅ fixed column name)
            if ($request->has('state_id') && $request->state_id !== '') {
                $query->where('state', $request->state_id);
            }

            // District filter (✅ fixed column name)
            if ($request->has('district_id') && $request->district_id !== '') {
                $query->where('district', $request->district_id);
            }

            if ($request->has('created_from')) {
                $query->whereDate('created_at', '>=', $request->created_from);
            }

            if ($request->has('created_to')) {
                $query->whereDate('created_at', '<=', $request->created_to);
            }

            if ($request->has('updated_from')) {
                $query->whereDate('updated_at', '>=', $request->updated_from);
            }

            if ($request->has('updated_to')) {
                $query->whereDate('updated_at', '<=', $request->updated_to);
            }

            $results = $query->get();

            $data = $results->map(function ($company) {
                return [
                    'company_name' => $company->company_name,
                    'branch_name' => $company->branch->branch_name ?? '',
                    'state_name' => $company->states['state_name'] ?? '',
                    'district_name' => $company->districts['dist_name'] ?? '',
                    'email' => $company->email,
                    'phone' => $company->phone,
                    'owner_name' => $company->owner_name,
                    'owner_phone' => $company->owner_phone,
                    'contact_person_name' => $company->contact_person_name,
                    'contact_person_phone' => $company->contact_person_phone,
                    'created_at' => $company->created_at->format('Y-m-d'),
                    'status' => '<a href="' . route('company.toggleStatus', $company->company_id) . '" class="btn btn-xs ' . ($company->status == 1 ? 'btn-success' : 'btn-danger') . '">' . ($company->status == 1 ? 'Active' : 'Inactive') . '</a>',
                    'photo' => $company->site_photo_1 && file_exists(public_path('uploads/companyPhoto/' . $company->site_photo_1))
                        ? '<a href="' . route('employees.show', $company->emp_id) . '"><img src="' . asset('uploads/companyPhoto/' . $company->site_photo_1) . '" class="img-circle" style="width:70px"></a>'
                        : '<a href="' . route('employees.show', $company->emp_id) . '"><img src="' . asset('admin_assets/img/default.png') . '" class="img-circle" style="width:70px"></a>',
                    'actions' => '<a href="' . route('company.show', $company->company_id) . '" class="btn btn-primary btn-xs btnColor"><i class="glyphicon glyphicon-th-large"></i></a>
                      <a href="' . route('company.edit', $company->company_id) . '" class="btn btn-success btn-xs btnColor"><i class="fa fa-pencil-square-o"></i></a>
                      <a href="' . route('company.delete', $company->company_id) . '" data-token="' . csrf_token() . '" data-id="' . $company->company_id . '" class="delete btn btn-danger btn-xs btnColor"><i class="fa fa-trash-o"></i></a>'
                ];
            });


            return response()->json(['data' => $data]);
        }

        return view('admin.company.index', compact('branches', 'states', 'districts'));
    }

    // Get all states for dropdown
    public function getStates()
    {
        $states = State::all();
        return response()->json($states);
    }

    // Get districts by state_id for dropdown
    public function getDistricts($state_id)
    {
        $districts = District::where('state_id', $state_id)
            ->select('dist_id', 'dist_name')
            ->orderBy('dist_name')
            ->get();

        return response()->json($districts);
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
