<?php
class PV_KV
{

    public function getPVKV()
    {
        return PV_KV_Data::getPVKVData();
    }

    public function updatePVKV($data)
    {
        return PV_KV_Data::updatePVKVData($data);
    }

    public function addPVKV($data)
    {
        return PV_KV_Data::addPVKVData($data);
    }
   
}
