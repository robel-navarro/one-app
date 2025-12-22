<?php
class Inspection_FormData
{
    public static function add($data)
    {
        $db = new DB;
        $db->query('CALL pb_db_digitalization.Add(:SerialNumber, :Customer, :Area, :Line, :Model, :Station, :Machine, :FailMode, :FailLocation, :FailRemarks, :RetestMode, :FailDesc, :RetestVefication, :RetestRemarks)');
        $db->bind(':SerialNumber', $data['sn']);
        $db->bind(':Customer', $data['customer']);
        $db->bind(':Area', $data['area']);
        $db->bind(':Line', $data['line']);
        $db->bind(':Model', $data['model']);
        $db->bind(':Station', $data['station']);
        $db->bind(':Machine', $data['machine']);
        $db->bind(':FailMode', $data['fail_mode']);
        $db->bind(':FailLocation', $data['fail_location']);
        $db->bind(':FailRemarks', $data['fail_remarks']);
        $db->bind(':RetestMode', $data['retest_mode']);
        $db->bind(':FailDesc', $data['retest_fail_desc']);
        $db->bind(':RetestVefication', $data['retest_verification']);
        $db->bind(':RetestRemarks', $data['retest_remarks']);
        return $db->single();
    }

    public static function getAllCustomer()
    {
        $db = new DB;
        $db->query("SELECT * FROM pb_rtdc_cognex.customer;");
        return $db->resultset();
    }

    public static function getAllLocation()
    {
        $db = new DB01;
        $db->query("SELECT distinct location FROM pb_rtdc_inventory.location;");
        return $db->resultset();
    }

    public static function getPN($customer_code)
    {
        $db = new DB;
        $db->query("SELECT DISTINCT (SUBSTRING_INDEX(part_number, '_', 1) )AS part_number FROM pb_rtdc_cognex.product where customer_code = :customer_code;");
        $db->bind(':customer_code', $customer_code);
        return $db->resultset();
    }

    public static function getLine($customer_code)
    {
        $db = new DB;
        $db->query("SELECT * FROM pb_rtdc_cognex.line_info WHERE customer_code = :customer_code ORDER BY description ASC;");
        $db->bind(':customer_code', $customer_code);
        return $db->resultset();
    }

    public static function getStation($customer_code)
    {
        $db = new DB;
        $db->query("SELECT *  FROM pb_rtdc_cognex.station WHERE customer_code = :customer_code AND  NOT station_type like '%\_%' ORDER BY station_description ASC;");
        $db->bind(':customer_code', $customer_code);
        return $db->resultset();
    }

    public static function getAllFailMode()
    {
        $db = new DB;
        $db->query("SELECT * FROM tbdefect_code ORDER BY defect_description ASC;");
        return $db->resultset();
    }

    public static function getAllFailDesc($station_code)
    {
        $db = new DB;
        $db->query("SELECT distinct description FROM pb_rtdc_cognex.defect where station_code  = :station_code order by description asc");
        $db->bind(':station_code', $station_code);
        return $db->resultset();
    }

    public static function GetHourlyInspectionRecord($data)
    {
        
        $db = new DB;
        $db->query("SELECT ROW_NUMBER() OVER () AS rownum,t1.serial_number,t1.model,t2.customer_description,t3.description,t4.station_description,t1.machine,
                    CASE 
                    WHEN t1.fail_mode <> 1 THEN CONCAT(t1.fail_mode , ' - ' , t5.defect_description)
                    ELSE 'Others'
                    END as 'defect',
                    t1.fail_loc,t1.fail_remarks,
                    t1.retest_mode, t1.fail_desc,t1.retest_verification,t1.retest_remarks,t1.dt	
                FROM (
                    SELECT *,
                        ROW_NUMBER() OVER (PARTITION BY serial_number ORDER BY dt DESC) AS rn
                    FROM pb_db_digitalization.tbinsp_record
                ) t1
                LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                LEFT JOIN tbdefect_code t5 on t1.fail_mode = t5.defect_code
                WHERE t1.rn = 1
                AND current_t = HOUR(NOW())
                AND current_d = CURDATE()
                AND customer = :customer_code
                AND line = :line
                 AND station = :station
                LIMIT 10");
        $db->bind(':customer_code', $data['customer_code']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        return $db->resultset();
    }
    
    public static function CheckHourlyQTYIN($data)
    {
        $db = new DB;
        $db->query('SELECT qty_in FROM pb_db_digitalization.tbinsp_summary WHERE customer =:customer AND line = :line AND station = :station AND current_t = :current_t AND current_d = :current_d');
        $db->bind(':customer' , $data['customer']);
        $db->bind(':line' , $data['line']);
        $db->bind(':station' , $data['station']);
        $db->bind(':current_t' , $data['current_t']);
        $db->bind(':current_d' , $data['current_d']);
        $result = $db->single();

        if($result){
            return true;
        }else{
            return false;
        }
    }
}
