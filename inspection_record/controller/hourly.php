<?php
class Hourly
{

    public function GetHourlyData1($data)
    {
        return HourlyData::GetHourlyData1($data);
    }

    public function add($data)
    {
        $result =   HourlyData::add($data);
        if ($result) {
            return array('status' => 'success', 'message' => 'Successfully Update Line status.');
        } else {
            return array('status' => 'error', 'message' => 'Error, Please try again.');
        }
    }

    public function update($data)
    {
        $result =   HourlyData::update($data);
        if ($result) {
            return array('status' => 'success', 'message' => 'Successfully Update Line status.');
        } else {
            return array('status' => 'error', 'message' => 'Error, Please try again.');
        }
    }
}
