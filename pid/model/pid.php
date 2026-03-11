<?php
class PIDData
{
    public static function getPIDData()
    {
        $db = new DB;
        $db->query("SELECT ROW_NUMBER() OVER (ORDER BY part_number) AS rownum, t.* FROM pb_rtdc_cognex.cg_product_id_list t;");
        return $db->resultset();
    }

    
}
