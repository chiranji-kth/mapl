<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


class CompanyRepository
{


    public function makeCompanyDataFormat($data)
    {
        $companyData['company_name']            = strtoupper($data['company_name']);
        $companyData['branch_id']                = strtoupper($data['branch_id']);
        $companyData['industry']                = strtoupper($data['industry']);
        $companyData['email']                   = strtoupper($data['email']);
        $companyData['phone']                   = strtoupper($data['phone']);
        $companyData['gst']                     = strtoupper($data['gst']);
        $companyData['pan']                     = strtoupper($data['pan']);
        $companyData['state']                = strtoupper($data['state']);
        $companyData['district']                = strtoupper($data['district']);
        $companyData['city']                    = strtoupper($data['city']);
        $companyData['address']                 = strtoupper($data['address']);
        $companyData['owner_name']              = strtoupper($data['owner_name']);
        $companyData['owner_phone']             = strtoupper($data['owner_phone']);
        $companyData['contact_person_name']     = strtoupper($data['contact_person_name']);
        $companyData['date_of_service']         = dateConvertFormtoDB($data['date_of_service']);
        $companyData['contact_person_phone']    = strtoupper($data['contact_person_phone']);
        $companyData['site_address']            = strtoupper($data['site_address']);

        return $companyData;
    }
}
