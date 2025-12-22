<?php

class Inspection_Form
{


    public function add($data)
    {
        $serial_number = $data['sn'];
        if ($data['customer'] == 'CG') {
            if (preg_match('/1A\\d{4}PP\\d{6}/', $serial_number, $match)) {
                //using 1A (820/821)
                $data['sn'] = $match[0];
            }
        }
        $inspection_data = Inspection_FormData::add($data);
        if ($inspection_data['isError']) {
            $result = array('error' => $inspection_data['unitMessage']);
        } else {
            $result = array('success' => $inspection_data['unitMessage']);
        }
        return  $result;
    }

    public function getAllCustomer()
    {
        return Inspection_FormData::getAllCustomer();
    }

    public function getAllLocation()
    {
        return Inspection_FormData::getAllLocation();
    }

     public function getAllFailDesc($station_code)
    {
        return Inspection_FormData::getAllFailDesc($station_code);
    }

    public function getPN($customer_code)
    {
        return Inspection_FormData::getPN($customer_code);
    }

    public function getLine($customer_code)
    {
        return Inspection_FormData::getLine($customer_code);
    }

    public function getStation($customer_code)
    {
        return Inspection_FormData::getStation($customer_code);
    }

    public function getAllFailMode()
    {
        return Inspection_FormData::getAllFailMode();
    }
    public function GetHourlyInspectionRecord($data)
    {
        return Inspection_FormData::GetHourlyInspectionRecord($data);
    }

    public function CheckHourlyQTYIN($data)
    {
        return Inspection_FormData::CheckHourlyQTYIN($data);
    }
}
