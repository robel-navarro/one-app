<?php
class PN_REV
{

    public function getPNREV()
    {
        return PN_REV_Data::getPNREVData();
    }

    public function updatePNREV($data)
    {
        return PN_REV_Data::updatePNREVData($data);
    }

    public function addPNREV($data)
    {

    }
   
}
