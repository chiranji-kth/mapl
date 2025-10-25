<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


class AssignjobRepository
{
    

    public function makeAssignjobDataFormat($data){
        $jobData['emp_id']          = $data['emp_id'];
        $jobData['company_id']           = $data['company_id'];
        $jobData['perday_wages']        = $data['perday_wages'];
        $jobData['from_date']= dateConvertFormtoDB($data['from_date']);
        $jobData['to_date']= dateConvertFormtoDB($data['to_date']);
        $jobData['deduction']  = (!is_array($data['deduction'])) ? '' : implode(',', $data['deduction']);
        $jobData['status']  = 1;

        return $jobData;
    }


}
