<?php
class PV_KV_Data
{
    public static function getPVKVData()
    {
        $db = new DB;
        $db->query("SELECT ROW_NUMBER() OVER (ORDER BY part_number) AS rownum, t.* FROM pb_rtdc_cognex.cg_label_matrix t WHERE web_form IN ('packing','packing2');");
        return $db->resultset();
    }

    public static function updatePVKVData($data)
    {
        $db = new DB;
        $db->query("UPDATE cg_pn_rev SET rev = :rev, status = :status, remarks = :remarks WHERE pn = :pn;");
        $db->bind(":rev", $data['rev']);
        $db->bind(":status", $data['status']);
        $db->bind(":remarks", '[' . date("Y-m-d") . '] Update By ' . $_SESSION['fullname']);
        $db->bind(":pn", $data['pn']);
        $db->execute();
        return ($db->rowCount() > 0) ? true : false;
    }

    public static function addPVKVData($data)
    {
        $db = new DB;
        $db->query("INSERT INTO cg_pn_rev (pn,rev,status,remarks) VALUES(:pn,:rev,:status,:remarks)");
        $db->bind(':pn', $data['pn']);
        $db->bind(':rev', $data['rev']);
        $db->bind(':status', $data['status']);
        $db->bind(":remarks", '[' . date("Y-m-d") . '] Added By ' . $_SESSION['fullname']);
        $db->execute();
       return ($db->rowCount() > 0) ? true : false;
    }
}
