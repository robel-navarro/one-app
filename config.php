<?php
// RTDC Version
define("RTDC_VERSION",'RTDC_V2.2.0');

//Turn off error reporting
// error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);



// Save report location
//define("REPORT_DIR", '../../core/files/');

//define("PHOTO_DIR", '/var/www/rtdc.mes/html/cognex/data/upload_image/camera/');

// Data URL for Excel report
//define("DATA_URL",'https://pbsrv03-mes.pciltd.com.sg/core/files/');
//define("DATA_URL",'https://vmsrv01-mes.pciltd.com.sg/core/files/');

//Define DB parameters
#PBSRV02 -- Get Fail Code / Add all transaction
define("DB_HOST","10.30.2.23");
define("DB_USER","pb-dbtest");
define("DB_PASS","P@ss#w0rd1");
define("DB_NAME","pb_rtdc_cognex");

#PBSRV01 -- Get Area
define("DB_HOST_01","10.30.2.17");
define("DB_USER_01","pb-dbtest");
define("DB_PASS_01","P@ss#w0rd1");
define("DB_NAME_01","pb_rtdc_inventory");

