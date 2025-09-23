<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


class EmployeesRepository
{
    

    public function makeEmployeePersonalInformationDataFormat($data){
        $employeeData['name']                   = strtoupper($data['name']);
        $employeeData['father_name']            = strtoupper($data['father_name']);
        $employeeData['email']                  = strtoupper($data['email']);
        $employeeData['phone']                  = strtoupper($data['phone']);
        $employeeData['alter_phone']            = strtoupper($data['alter_phone']);
        $employeeData['gender']                 = strtoupper($data['gender']);
        $employeeData['aadhar']                 = strtoupper($data['aadhar']);
        $employeeData['marital_status']         = strtoupper($data['marital_status']);
        $employeeData['highest_qualification']  = strtoupper($data['highest_qualification']);
        $employeeData['weight']                 = strtoupper($data['weight']);
        $employeeData['height']                 = strtoupper($data['height']);
        $employeeData['dob']                    = dateConvertFormtoDB($data['dob']);
        $employeeData['date_of_joining']        = dateConvertFormtoDB($data['date_of_joining']);
        $employeeData['employment_status']      = strtoupper($data['employment_status']);
        $employeeData['post_applied']           = strtoupper($data['post_applied']);
        $employeeData['salary_expectations']    = strtoupper($data['salary_expectations']);
        $employeeData['other_post_applied']     = strtoupper($data['other_post_applied']);
        $employeeData['time_preference']        = strtoupper($data['time_preference']);
        $employeeData['remarks']                = strtoupper($data['remarks']);
        $employeeData['filled_by']              = strtoupper($data['filled_by']);
        $employeeData['referd_by']              = strtoupper($data['referd_by']);
        $employeeData['kyc_doc']                = strtoupper($data['kyc_doc']);
        
        $employeeData['p_district']             = strtoupper($data['p_district']);
        $employeeData['p_city']                 = strtoupper($data['p_city']);
        $employeeData['p_address']              = strtoupper($data['p_address']);
        $employeeData['c_district']             = strtoupper($data['c_district']);
        $employeeData['c_city']                 = strtoupper($data['c_city']);
        $employeeData['c_address']              = strtoupper($data['c_address']);
        
        $employeeData['bank']                   = strtoupper($data['bank']);
        $employeeData['acc_no']                 = strtoupper($data['acc_no']);
        $employeeData['ifc_code']               = strtoupper($data['ifc_code']);
        $employeeData['branch']                 = strtoupper($data['branch']);
        
        $employeeData['esic_no']                = strtoupper($data['esic_no']);
        $employeeData['uan_no']                 = strtoupper($data['uan_no']);
        $employeeData['nominee']                = strtoupper($data['nominee']);
        $employeeData['esic_pf']                = strtoupper($data['esic_pf']);
        // $employeeData['created_by']     = Auth::user()->user_id;
        // $employeeData['updated_by']     = Auth::user()->user_id;

        return $employeeData;
    }


}
