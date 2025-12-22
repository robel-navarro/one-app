<?php
error_reporting(E_ALL | E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try {
    //Server settings 
    $mail->isSMTP();
    $mail->Host       = '10.18.11.113';
    $mail->SMTPAuth   = false;
    $mail->Port       = 25;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;    // Shows full debug info in output
    $mail->Debugoutput = 'html';
    //Recipients
    $mail->setFrom('mes.adminstrator@pciltd.com.sg', 'MES Admin');

    $mail->addAddress('robel.navarro@pciltd.com.sg', 'Robel Navarro');


    //Attachments
    // $mail->addAttachment('/var/www/rtdc.mes/html/core/files/Cognex Traceability Report 2023-02-28.xlsx', 'Cognex Traceability Report 2023-02-28.xlsx');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<h1>This is the HTML message body <b>in bold!</b></h1>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


require("/var/www/rtdc.mes/html/dev1/digitalization/config.php");
require("/var/www/rtdc.mes/html/dev1/digitalization/main/model/db.php");


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
        $alert = $db->resultset();

// 







?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Defect Alert Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            font-size: 20px;
            font-weight: bold;
            color: #d93025;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.5;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 800px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
            vertical-align: top;
            /* Removed white-space: nowrap from here */
        }

        th {
            background-color: #f2f2f2;
            white-space: nowrap; /* Keep nowrap only on headers */
        }

        td.sn-cell {
            max-width: 250px;
            white-space: normal !important;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .footer {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">🚨 Alert: 3 - 5 consecutive Defects Detected</div>

        <p>Dear Team,</p>

        <p>Our monitoring system has detected <strong>three consecutive defects</strong> in the latest runs. Please review the details below and take necessary action immediately.</p>

        <div class="table-wrapper">
            <table class="defect-table" id="table_defect">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Customer</th>
                        <th>Line</th>
                        <th>Station</th>
                        <th>Machine</th>
                        <th>Defect</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>SN</th>
                        <th>Count</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="table_defect_body"></tbody>
            </table>
        </div>

        <p>Please investigate the root cause and update the status in the defect tracking system.</p>

        <div class="footer">
            This is an automated message. Please do not reply.<br />
            &copy; 2025 PCI Private Limited (PCI Digitalization)
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_defect_body').empty();
            $.post('/dev1/digitalization/inspection_record/route/analysis_form.php', {
                action: 'GetTriggeringDefect_AutoEmail',
            }, function (data) {
                console.log(data);
                if (typeof data.error === 'undefined') {
                    $.each(data.result, function (i, item) {
                        var row = "<tr>" +
                            "<td>" + item['rownum'] + "</td>" +
                            "<td>" + item['customer_description'] + "</td>" +
                            "<td>" + item['line_description'] + "</td>" +
                            "<td>" + item['station_description'] + "</td>" +
                            "<td>" + item['machine'] + "</td>" +
                            "<td>" + item['defect_description'] + "</td>" +
                            "<td>" + item['current_t'] + "</td>" +
                            "<td>" + item['current_d'] + "</td>" +
                            "<td class='sn-cell'>" + item['serial_numbers'] + "</td>" +
                            "<td>" + item['count_per_group'] + "</td>" +
                            "<td>Open</td>" +
                            "</tr>";
                        $('#table_defect_body').append(row);
                    });
                } else {
                    console.log(data.error);
                }
            }, 'json');
        });
    </script>
</body>

</html>
