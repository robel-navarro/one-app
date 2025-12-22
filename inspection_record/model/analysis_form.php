<?php

class Analysis_FormData
{


    public static function GetTriggeringDefect()
    {
        $db = new DB;
        $db->query("
                WITH unioned_data AS (
                    SELECT
                      
                        all_data.*
                    FROM (
                        -- your UNION ALL of 3 SELECTs starts here
                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            MAX(t5.defect_description) AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        LEFT JOIN tbdefect_code t5 ON t1.fail_mode = t5.defect_code
                        WHERE t1.fail_mode IS NOT NULL AND t1.fail_mode != '' AND t1.fail_mode != '1'
                        GROUP BY t1.customer, t1.line, t1.station, t1.fail_mode, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 3)

                        UNION ALL

                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            t1.fail_desc AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        WHERE t1.fail_mode = '1' AND t1.fail_desc IS NOT NULL AND t1.fail_desc != ''
                        GROUP BY t1.customer, t1.line, t1.station, t1.fail_mode, t1.fail_desc, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 3)

                        UNION ALL

                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            GROUP_CONCAT(DISTINCT t5.defect_description ORDER BY t5.defect_description) AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        LEFT JOIN tbdefect_code t5 ON t1.fail_mode = t5.defect_code
                        WHERE t1.fail_mode IS NOT NULL AND t1.fail_mode != ''
                        GROUP BY t1.customer, t1.line, t1.station, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 5)
                    ) AS all_data
                )

                SELECT 
                ROW_NUMBER() OVER () AS rownum,
                u.customer_description,
                u.customer, 
                u.line_description,
                u.line, 
                u.station_description,
                u.station,
                u.machine,
                u.defect_description,
                CONCAT(u.current_t, '-', (u.current_t + 1) % 24) AS current_t,  -- Updated here
                u.current_d,
                u.count_per_group, 
                u.serial_numbers
            FROM unioned_data u
            LEFT JOIN tbanalysis a ON
                TRIM(LOWER(a.customer)) = TRIM(LOWER(u.customer))
                AND TRIM(LOWER(a.line)) = TRIM(LOWER(u.line))
                AND TRIM(LOWER(a.station)) = TRIM(LOWER(u.station))
                AND TRIM(LOWER(a.machine)) = TRIM(LOWER(u.machine))
                AND TRIM(LOWER(a.defect)) = TRIM(LOWER(u.defect_description))
                AND TRIM(a.time) = TRIM(u.current_t)
                AND TRIM(a.date) = TRIM(u.current_d)
                AND a.count = u.count_per_group
                AND REPLACE(TRIM(LOWER(a.sn)), ' ', '') = REPLACE(TRIM(LOWER(u.serial_numbers)), ' ', '')
            WHERE NOT EXISTS (
                SELECT 1
                FROM tbanalysis a
                WHERE
                    TRIM(LOWER(a.customer)) = TRIM(LOWER(u.customer_description)) AND
                    TRIM(LOWER(a.line)) = TRIM(LOWER(u.line_description)) AND
                    TRIM(LOWER(a.station)) = TRIM(LOWER(u.station_description)) AND
                    TRIM(LOWER(a.machine)) = TRIM(LOWER(u.machine)) AND
                    TRIM(LOWER(a.defect)) = TRIM(LOWER(u.defect_description)) AND
                    TRIM(a.time) = TRIM(u.current_t) AND
                    TRIM(a.date) = TRIM(u.current_d) AND
                    a.count = u.count_per_group AND
                    REPLACE(TRIM(LOWER(a.sn)), ' ', '') = REPLACE(TRIM(LOWER(u.serial_numbers)), ' ', '')        
            )

        ");
        return $db->resultset();
    }
    public static function GetTriggeringDefect_AutoEmail()
    {
        $db = new DB;
        $db->query("
                WITH unioned_data AS (
                    SELECT
                      
                        all_data.*
                    FROM (
                        -- your UNION ALL of 3 SELECTs starts here
                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            MAX(t5.defect_description) AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        LEFT JOIN tbdefect_code t5 ON t1.fail_mode = t5.defect_code
                        WHERE t1.fail_mode IS NOT NULL AND t1.fail_mode != '' AND t1.fail_mode != '1'
                        GROUP BY t1.customer, t1.line, t1.station, t1.fail_mode, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 3)

                        UNION ALL

                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            t1.fail_desc AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        WHERE t1.fail_mode = '1' AND t1.fail_desc IS NOT NULL AND t1.fail_desc != ''
                        GROUP BY t1.customer, t1.line, t1.station, t1.fail_mode, t1.fail_desc, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 3)

                        UNION ALL

                        (SELECT
                            t1.customer,
                            MAX(t2.customer_description) AS customer_description,
                            t1.line,
                            MAX(t3.description) AS line_description,
                            t1.station,
                            MAX(t4.station_description) AS station_description,
                            GROUP_CONCAT(DISTINCT t5.defect_description ORDER BY t5.defect_description) AS defect_description,
                            MAX(t1.machine) AS machine,
                            t1.current_t,
                            t1.current_d,
                            GROUP_CONCAT(DISTINCT t1.serial_number ORDER BY t1.serial_number) AS serial_numbers,
                            COUNT(*) AS count_per_group
                        FROM tbinsp_record t1
                        LEFT JOIN pb_rtdc_cognex.customer t2 ON t1.customer = t2.customer_code
                        LEFT JOIN pb_rtdc_cognex.line_info t3 ON t1.line = t3.line_code
                        LEFT JOIN pb_rtdc_cognex.station t4 ON t1.station = t4.station_code
                        LEFT JOIN tbdefect_code t5 ON t1.fail_mode = t5.defect_code
                        WHERE t1.fail_mode IS NOT NULL AND t1.fail_mode != ''
                        GROUP BY t1.customer, t1.line, t1.station, t1.current_t, t1.current_d
                        HAVING COUNT(*) >= 5)
                    ) AS all_data
                )

                SELECT 
                ROW_NUMBER() OVER () AS rownum,
                u.customer_description,
                u.customer, 
                u.line_description,
                u.line, 
                u.station_description,
                u.station,
                u.machine,
                u.defect_description,
                CONCAT(u.current_t, '-', (u.current_t + 1) % 24) AS current_t,  -- Updated here
                u.current_d,
                u.count_per_group, 
                u.serial_numbers
            FROM unioned_data u
            LEFT JOIN tbanalysis a ON
                TRIM(LOWER(a.customer)) = TRIM(LOWER(u.customer))
                AND TRIM(LOWER(a.line)) = TRIM(LOWER(u.line))
                AND TRIM(LOWER(a.station)) = TRIM(LOWER(u.station))
                AND TRIM(LOWER(a.machine)) = TRIM(LOWER(u.machine))
                AND TRIM(LOWER(a.defect)) = TRIM(LOWER(u.defect_description))
                AND TRIM(a.time) = TRIM(u.current_t)
                AND TRIM(a.date) = TRIM(u.current_d)
                AND a.count = u.count_per_group
                AND REPLACE(TRIM(LOWER(a.sn)), ' ', '') = REPLACE(TRIM(LOWER(u.serial_numbers)), ' ', '')
            WHERE NOT EXISTS (
                SELECT 1
                FROM tbanalysis a
                WHERE
                    TRIM(LOWER(a.customer)) = TRIM(LOWER(u.customer_description)) AND
                    TRIM(LOWER(a.line)) = TRIM(LOWER(u.line_description)) AND
                    TRIM(LOWER(a.station)) = TRIM(LOWER(u.station_description)) AND
                    TRIM(LOWER(a.machine)) = TRIM(LOWER(u.machine)) AND
                    TRIM(LOWER(a.defect)) = TRIM(LOWER(u.defect_description)) AND
                    TRIM(a.time) = TRIM(u.current_t) AND
                    TRIM(a.date) = TRIM(u.current_d) AND
                    a.count = u.count_per_group AND
                    REPLACE(TRIM(LOWER(a.sn)), ' ', '') = REPLACE(TRIM(LOWER(u.serial_numbers)), ' ', '')
                    AND a.status IN ('Open','Acknowledge','Done')
        
            )

        ");
        return $db->resultset();
    }

    public static function Add($data)
    {
        $db = new DB;
        $db->query('INSERT INTO tbanalysis (customer,line,station,machine,defect,time,date,count,acknowledge_by,root_cause,action_taken,sn,status)
                    VALUES(:customer,:line,:station,:machine,:defect,:time,:date,:count,:acknowledge_by,:root_cause,:action_taken,:sn,:status) ');
        $db->bind(':customer', $data['customer']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        $db->bind(':machine', $data['machine']);
        $db->bind(':defect', $data['defect']);
        $db->bind(':time', $data['time']);
        $db->bind(':date', $data['date']);
        $db->bind(':count', $data['count']);
        $db->bind(':acknowledge_by', 'robel');
        $db->bind(':root_cause', $data['root_cause']);
        $db->bind(':action_taken', $data['action_taken']);
        $db->bind(':sn', $data['sn']);
        $db->bind(':status', 'Acknowledge');
        $db->execute();
        if ($db->lastInsertId()) {
            return true;
        } else {
            return false;
        }
    }

     public static function Update($data)
    {
        $db = new DB;
        $db->query('UPDATE tbanalysis SET status = :status,acknowledge_by = :acknowledge_by ,root_cause = :root_cause ,action_taken = :action_taken
        WHERE  customer = :customer AND  line = :line AND station = :station AND  machine = :machine  AND defect = :defect AND time = :time AND date = :date 
        AND count = :count AND sn = :sn');
        $db->bind(':customer', $data['customer']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        $db->bind(':machine', $data['machine']);
        $db->bind(':defect', $data['defect']);
        $db->bind(':time', $data['time']);
        $db->bind(':date', $data['date']);
        $db->bind(':count', $data['count']);
        $db->bind(':acknowledge_by', 'robel');
        $db->bind(':root_cause', $data['root_cause']);
        $db->bind(':action_taken', $data['action_taken']);
        $db->bind(':sn', $data['sn']);
        $db->bind(':status', 'Acknowledge');
        $db->execute();
        if ($db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkifExists($data)
     {
        $db = new DB;
        $db->query('SELECT * FROM tbanalysis WHERE customer = :customer AND line = :line AND station = :station AND 
        machine = :machine AND defect = :defect AND time = :time AND date = :date AND count = :count AND sn = :sn) ');
        $db->bind(':customer', $data['customer']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        $db->bind(':machine', $data['machine']);
        $db->bind(':defect', $data['defect']);
        $db->bind(':time', $data['time']);
        $db->bind(':date', $data['date']);
        $db->bind(':count', $data['count']);
        $db->bind(':sn', $data['sn']);
        $result = $db->single();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
