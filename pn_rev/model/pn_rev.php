<?php
class PN_REV_Data
{
    public static function getPNREVData()
    {
        $db = new DB;
        $db->query("SELECT ROW_NUMBER() OVER (ORDER BY pn) AS rownum, t.* FROM pb_rtdc_cognex.cg_pn_rev t;");
        return $db->resultset();
    }

    public static function updatePNREVData($data)
    {
        $db = new DB;
        $db->query("UPDATE cg_pn_rev SET rev = :rev, status = :status, remarks = :remarks WHERE pn = :pn;");
        $db->bind(":rev", $data['rev']);
        $db->bind(":status", $data['status']);
        $db->bind(":remarks", '[' . date("Y-m-d h:i:s") . '] Update By ' . $_SESSION['fullname']);
        $db->bind(":pn", $data['pn']);
        $db->execute();
        return ($db->rowCount() > 0) ? true : false;
    }

    public static function addPNREVData($data)
    {
        $db = new DB;
        $db->query("INSERT INTO cg_pn_rev (pn,product_id,last_update,remarks) VALUES(:pn,:pid,:status,:)");
        $db->bind(':pn', $data['pn']);
        $db->bind(':rev', $data['rev']);
        $db->bind(':dt', date('Y-m-d H:i:s'));
        $db->bind(':remarks', "Added last " . date('Y-m-d'));
        $db->execute();
        if ($db->lastInsertId()) {
            return true;
        } else {
            return false;
        }
    }
}
