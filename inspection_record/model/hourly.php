<?php

class HourlyData
{

   public static function GetHourlyData1($data){
    $db = new DB;
        $db->query("
        WITH RECURSIVE hour_window AS (
        SELECT 
            7 AS h,
            CASE 
            WHEN HOUR(NOW()) < 7 THEN CURDATE() - INTERVAL 1 DAY
            ELSE CURDATE()
            END AS d,
            1 AS step
        UNION ALL
        SELECT
            CASE WHEN h = 23 THEN 0 ELSE h + 1 END,
            CASE WHEN h = 23 THEN DATE_ADD(d, INTERVAL 1 DAY) ELSE d END,
            step + 1
        FROM hour_window
        WHERE step < 24
        ),
        reference AS (
        SELECT :customer AS customer, :line AS line, :station AS station
        )
        SELECT
        r.customer,
        r.line,
        r.station,
        h.d AS current_d,
        h.h AS current_t,
        COALESCE(p.qty_in, '-') AS qty_in,
        COALESCE(p.qty_pass, '-') AS qty_pass,
        COALESCE(p.qty_fail, '-') AS qty_fail,
        COALESCE(p.retest_in, '-') AS retest_in,
        COALESCE(p.retest_pass, '-') AS retest_pass,
        COALESCE(p.retest_fail, '-') AS retest_fail,
        p.status
        FROM reference r
        CROSS JOIN hour_window h
        LEFT JOIN tbinsp_summary p
        ON p.customer = r.customer
        AND p.line = r.line
        AND p.station = r.station
        AND p.current_d = h.d
        AND p.current_t = h.h
        WHERE r.customer = :customer
        AND r.line = :line
        AND r.station = :station
        ORDER BY r.customer, r.line, r.station, h.d, h.h;"
        );
    $db->bind(':customer',$data['customer']);
    $db->bind(':line',$data['line']);
    $db->bind(':station',$data['station']);
    return $db->resultset();
    }

    public static function add($data)
    {
        $db = new DB;
        $db->query('
        INSERT INTO tbinsp_summary (
            customer, area, line, station, current_t, current_d,
            qty_in, qty_pass, qty_fail, retest_in, retest_pass, retest_fail, status
        ) VALUES (
            :customer, :area, :line, :station, :current_t, :current_d,
            0, 0, 0, 0, 0, 0, :status
        )
    ');
        $db->bind(':customer', $data['customer']);
        $db->bind(':area', $data['area']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        $db->bind(':current_t', $data['current_t']);
        $db->bind(':current_d', $data['current_d']);
        $db->bind(':status', $data['status']);

        $db->execute();

        return $db->lastInsertId() ? true : false;
    }

    
    public static function update($data)
    {
     
        $db = new DB;
        $db->query('
        UPDATE tbinsp_summary SET qty_pass = (:qty_in - qty_fail), qty_in = :qty_in
        WHERE customer = :customer AND line = :line
        AND station = :station AND current_t = :current_t
        AND current_d = :current_d
    ');
        $db->bind(':customer', $data['customer']);
        $db->bind(':area', $data['area']);
        $db->bind(':line', $data['line']);
        $db->bind(':station', $data['station']);
        $db->bind(':current_t', $data['current_t']);
        $db->bind(':current_d', $data['current_d']);
        $db->bind(':qty_in', $data['qty_in']);

        $db->execute();

        return $db->rowCount() > 0 ? true : false;
    }
}
