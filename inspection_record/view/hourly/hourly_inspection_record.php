 <?php
  date_default_timezone_set('Asia/Jakarta');
  $serverDT = date('Y-m-d H:i:s');
  ?>

 <!-- content-header -->
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0">Hourly Inspection Record</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item">Inspection Record</li>
           <li class="breadcrumb-item active">Hourly Inspection Record</li>
         </ol>
       </div>
     </div>
   </div>
 </div>
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <section class="col-lg-2 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-chart-pie mr-1"></i>
               Line Info
             </h3>
           </div>
           <div class="card-body">
             <div class="form-group row">
               <label for="customer" class="col-sm-4 col-form-label">Customer</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="customer">
                   <option selected="selected">Select Customer</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="area" class="col-sm-4 col-form-label">Area</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="area">
                   <option selected="selected">Select Area</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="line" class="col-sm-4 col-form-label">Line</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="line">
                   <option selected="selected">Select Line</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="station" class="col-sm-4 col-form-label">Station</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="station">
                   <option selected="selected">Select Station</option>

                 </select>
               </div>
             </div>
           </div>

         </div>

         <!-- Update Data -->

         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-pencil-alt"></i>
               Update Production Status / Qty
             </h3>
           </div>
           <div class="card-body">
             <div class="form-group row">
               <label for="hourly_time" class="col-sm-4 col-form-label">Time</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="hourly_time" disabled>
                   <option selected="selected">Select Time</option>
                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="hourly_date" class="col-sm-4 col-form-label">Date</label>
               <div class="col-sm-8">
                 <input class="form-control" type="text" placeholder="yyyy-MM-dd" id="hourly_date" disabled>
               </div>
             </div>
             <div class="form-group row">
               <label for="hourly_status" class="col-sm-4 col-form-label">Status</label>
               <div class="col-sm-8">
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="hourly_status" disabled>
                   <option selected="selected">Select Status</option>
                   <option value="1">Breaktime</option>
                   <option value="2">No Production</option>
                   <option value="3">Running</option>
                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="hourly_qty_in" class="col-sm-4 col-form-label">Qty In</label>
               <div class="col-sm-8">
                 <input class="form-control" type="text" placeholder="0" id="hourly_qty_in" disabled>
               </div>
             </div>
             <div class="form-group row">
               <div class="col-sm-12">

                 <button type="button" class="btn btn-success" id="hourly_update_button" style="width: 100%;" disabled><i class="fas fa-save"></i> Save changes</button>
               </div>
             </div>
             <div class="form-group row">
               <div class="col-sm-12">
                 <button type="button" class="btn btn-warning" id="hourly_refresh_button" style="width: 100%;"> <i class="fas fa-sync-alt"></i> Referesh</button>

               </div>
             </div>
           </div>

         </div>
       </section>
       <section class="col-lg-10 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-table"></i>
               24 Hours Data
             </h3>

           </div>
           <div class="card-body">
             <div class="row">
               <table id="hourly_table1" class="table table-bordered table-striped" style="text-align:center;">
                 <thead>
                   <tr>
                     <th>Details</th>
                     <th>07-08</th>
                     <th>08-09</th>
                     <th>09-10</th>
                     <th>10-11</th>
                     <th>11-12</th>
                     <th>12-13</th>
                     <th>13-14</th>
                     <th>14-15</th>
                     <th>15-16</th>
                     <th>16-17</th>
                     <th>17-18</th>
                     <th>18-19</th>
                   </tr>
                 </thead>
                 <tbody id="hourly_table_body1">
                 </tbody>
               </table>
             </div>
           </div>
           <div class="card-body">
             <div class="row">
               <table id="hourly_table2" class="table table-bordered table-striped" style="text-align:center;">
                 <thead>
                   <tr>
                     <th>Details</th>
                     <th>19-20</th>
                     <th>20-21</th>
                     <th>21-22</th>
                     <th>22-23</th>
                     <th>23-00</th>
                     <th>00-01</th>
                     <th>01-02</th>
                     <th>02-03</th>
                     <th>03-04</th>
                     <th>04-05</th>
                     <th>05-06</th>
                     <th>06-07</th>
                   </tr>
                 </thead>
                 <tbody id="hourly_table_body2">
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </section>

     </div>
   </div>
 </section>


 <script>
   var retest_mode = "";
   var retest_verification = "";
   var retest_fail_desc = "";
   var retest_remarks = "";

   var serverTime = new Date("<?php echo $serverDT; ?>".replace(' ', 'T'));
   var clientStartTime = new Date();
   var now = new Date();
   var diff = now - clientStartTime; // time since page loaded
   var currentServerTime = new Date(serverTime.getTime() + diff);

   var autoLoad = false;
   var countDown = 0;

   $(document).keydown(function(e) {
     if (e.key === "Escape") {
       e.preventDefault();
     }
   });

   $(function() {
     //initialize swal toast
     var Toast = Swal.mixin({
       toast: true,
       position: "top-end",
       showConfirmButton: false,
       timer: 3000,
       timerProgressBar: true,
       didOpen: (toast) => {
         toast.onmouseenter = Swal.stopTimer;
         toast.onmouseleave = Swal.resumeTimer;
       }
     });

     var row1 =
       "<tr id='up_qty_in'><td>QTY IN</td></tr>" +
       "<tr id='up_qty_pass'><td>QTY PASS</td></tr>" +
       "<tr id='up_qty_fail'><td>QTY FAIL</td></tr>" +
       "<tr id='up_retest_in'><td>RETEST IN</td></tr>" +
       "<tr id='up_retest_pass'><td>RETEST PASS</td></tr>" +
       "<tr id='up_retest_fail'><td>RETEST FAIL</td></tr>";
     $('#hourly_table_body1').append(row1);
     var row2 =
       "<tr id='down_qty_in'><td>QTY IN</td></tr>" +
       "<tr id='down_qty_pass'><td>QTY PASS</td></tr>" +
       "<tr id='down_qty_fail'><td>QTY FAIL</td></tr>" +
       "<tr id='down_retest_in'><td>RETEST IN</td></tr>" +
       "<tr id='down_retest_pass'><td>RETEST PASS</td></tr>" +
       "<tr id='down_retest_fail'><td>RETEST FAIL</td></tr>";
     $('#hourly_table_body2').append(row2);

     //Get server data time
     setInterval(function() {

       var now = new Date();
       var diff = now - clientStartTime; // time since page loaded
       var currentServerTime = new Date(serverTime.getTime() + diff);

       // Format it
       var year = currentServerTime.getFullYear();
       var month = (currentServerTime.getMonth() + 1).toString().padStart(2, '0');
       var day = currentServerTime.getDate().toString().padStart(2, '0');
       var hours = currentServerTime.getHours().toString().padStart(2, '0');
       var minutes = currentServerTime.getMinutes().toString().padStart(2, '0');
       var seconds = currentServerTime.getSeconds().toString().padStart(2, '0');

       var formatted = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
       $('#dt').val(formatted);
       var hours = currentServerTime.getHours();
       var hoursPlusOne = (hours + 1) % 24;
       var formattedHour = hoursPlusOne.toString().padStart(2, '0');
       $('#time_frame').val(hours.toString().padStart(2, '0') + "-" + formattedHour);
     }, 1000);
     $('#modal_qty_in').on('input', function() {
       $(this).val($(this).val().replace(/[^0-9]/g, ''));
     });

     setInterval(function() {

       if (autoLoad) {
         if (countDown > 180) {
           const requestData = {
             customer_code: $('#customer option:selected').val(),
             station: $('#station option:selected').val(),
             line: $('#line option:selected').val()
           };
           LoadInspectionRecord(requestData);
           countDown = 0;
         }
         countDown++;
       }
     }, 1000);

     //Get all customer
     $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
       action: 'getAllCustomer',
     }, function(data) {

       if (typeof data.error === 'undefined') {
         $('#customer').empty();
         $('#customer').append(new Option('Select Customer', 0));

         if (!jQuery.isEmptyObject(data.result)) {
           $.each(data.result, function(i, item) {
             $('#customer').append($('<option>', {
               value: item['customer_code'],
               text: item['customer_description'],
               'data-id': item['id']
             }));
           });
         }
       } else {
         console.log(data.error);
       }
     }, 'json');

     //Get all location
     $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
       action: 'getAllLocation',
     }, function(data) {

       if (typeof data.error === 'undefined') {
         $('#area').empty();
         $('#area').append(new Option('Select Area', 0));

         if (!jQuery.isEmptyObject(data.result)) {
           $.each(data.result, function(i, item) {
             $('#area').append($('<option>', {
               value: item['location'],
               text: item['location']
             }));
           });
         }
       } else {
         console.log(data.error);
       }
     }, 'json');

     //Get line, part number and station based on customer code
     $('#customer').change(function(e) {
       if ($('#customer option:selected').text() != 'Select Customer') {

         $('#station').empty();
         $('#line').empty();
         $('#machine').val("");
         $('#area').prop('selectedIndex', 0);
         $('#sn').val("");
         $('#fail_mode').prop('selectedIndex', 0);
         $('#fail_location').val("");
         $('#fail_remarks').val("");
         $('#partnumber').focus();
         if ($('#customer option:selected').text() == 'Cognex') {
           $('#fail_location').val('NA');
           $('#area').val('PB-MAIN Lot 2 - 1F');
         }
         $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
           action: 'getPN',
           customer_code: $('#customer').val(),
         }, function(data) {

           if (typeof data.error === 'undefined') {
             $('#pn_list').html('');
             $.each(data.result, function(i, item) {
               $('#pn_list').append("<option value='" + item['part_number'] + "'>");
             });

           } else {
             console.log(data.error);
           }
         }, 'json');

         //Get station base on customer code
         $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
           action: 'getStation',
           customer_code: $('#customer').val(),
         }, function(data) {

           if (typeof data.error === 'undefined') {
             $('#station').empty();
             $('#station').append(new Option('Select Station', 0));

             if (!jQuery.isEmptyObject(data.result)) {
               $.each(data.result, function(i, item) {
                 $('#station').append($('<option>', {
                   value: item['station_code'],
                   text: item['station_description'],
                   'data-id': item['id']

                 }));
               });
             }
           } else {
             console.log(data.error);
           }
         }, 'json');

         //getLine base on customer code
         $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
           action: 'getLine',
           customer_code: $('#customer').val(),
         }, function(data) {

           if (typeof data.error === 'undefined') {
             $('#line').empty();
             $('#line').append(new Option('Select Line', 0));

             if (!jQuery.isEmptyObject(data.result)) {
               $.each(data.result, function(i, item) {
                 $('#line').append($('<option>', {
                   value: item['line_code'],
                   text: item['description'],
                 }));
               });
             }
           } else {
             console.log(data.error);
           }
         }, 'json');
       }
     });

     $('#station').change(function(e) {
       if ($('#station option:selected').text() != 'Select Station') {
         const requestData = {
           customer_code: $('#customer option:selected').val(),
           station: $('#station option:selected').val(),
           line: $('#line option:selected').val()
         };

         //checkInQTY(requestData);
         LoadInspectionRecord(requestData);
         autoLoad = true;
       }
     });

     $('#hourly_refresh_button').on('click', function() {
       const requestData = {
         customer_code: $('#customer option:selected').val(),
         station: $('#station option:selected').val(),
         line: $('#line option:selected').val()
       };
       LoadInspectionRecord(requestData);
     });

     //Update hourly Data
     $('#hourly_update_button').on('click', function() {
       if ($('#hourly_qty_in').val() == '' || $('#hourly_status option:selected').text() == 'Select Status') {
         Toast.fire({
           icon: 'warning',
           title: 'Please complete all required data.'
         })
         return;
       } else {
         let _action = '';
         if ($('#hourly_status option:selected').text() == 'Running') { //update tbinsp_summary
           _action = 'update';
         } else { //add to tbinsp_summary
           _action = 'add';
         }

         $.post('/dev1/digitalization/inspection_record/route/hourly.php', {
           action: _action,
           customer: $('#customer option:selected').val(),
           area: $('#area option:selected').text(),
           line: $('#line option:selected').val(),
           station: $('#station option:selected').val(),
           current_t: $('#hourly_time option:selected').data('current_t'),
           current_d: $('#hourly_time option:selected').data('current_d'),
           qty_in: $('#hourly_qty_in').val(),
           status: $('#hourly_status option:selected').text(),
         }, function(data) {
           console.log(data);
           if (typeof data.error === 'undefined') {
             if (data.result['status'] == 'success') {
               Toast.fire({
                 icon: 'success',
                 title: data.result['message']
               })
               return;
               $('#hourly_refresh_data').click();
             } else if (data.result['status'] == 'error') {
               Toast.fire({
                 icon: 'warning',
                 title: data.result['message']
               })
               return;
             }

             $('#hourly_refresh_button').click();
           } else {
             console.log(data.error);
           }
         }, 'json');
       }
     });

     //Change time/Update Data
     $('#hourly_time').change(function(e) {
       if ($('#hourly_time option:selected').text() != 'Select Time') {
         $('#hourly_date').val($('#hourly_time option:selected').data('current_d'));
         console.log($('#hourly_time option:selected').data('qty_fail'));
         if ($('#hourly_time option:selected').data('qty_fail') != '0' && $('#hourly_time option:selected').data('qty_fail') != '-') { //have transaction
           $('#hourly_status').prop('disabled', true);
           $('#hourly_status option:selected').text('Running');
           $('#hourly_qty_in').prop('disabled', false);
           $('#hourly_qty_in').focus();
           $('#hourly_qty_in').val("0");
         } else {
           $('#hourly_status option:selected').text('Select Status');
           $('#hourly_status option[value="3"]').prop('disabled', true);
           $('#hourly_status').prop('disabled', false);
           $('#hourly_status').focus();
           $('#hourly_qty_in').prop('disabled', true);
           $('#hourly_qty_in').val("0");
         }
       } else {
         $('#hourly_date').val('');
       }

     });

     //Load Hourly Record
     function LoadInspectionRecord(data) {


       $('#hourly_table_body1').empty();
       $('#hourly_table_body2').empty();

       $.post('/dev1/digitalization/inspection_record/route/hourly.php', {
         action: 'GetHourlyData1',
         customer: data['customer_code'],
         line: data['line'],
         station: data['station'],
       }, function(data) {
         console.log(data);
         if (typeof data.error === 'undefined') {

           $('#hourly_update_button').prop('disabled', false);
           $('#hourly_time').prop('disabled', false);
           $('#hourly_status').prop('disabled', false);

           var row1 =
             "<tr id='up_qty_in'><td>QTY IN</td></tr>" +
             "<tr id='up_qty_pass'><td>QTY PASS</td></tr>" +
             "<tr id='up_qty_fail'><td>QTY FAIL</td></tr>" +
             "<tr id='up_retest_in'><td>RETEST IN</td></tr>" +
             "<tr id='up_retest_pass'><td>RETEST PASS</td></tr>" +
             "<tr id='up_retest_fail'><td>RETEST FAIL</td></tr>";
           $('#hourly_table_body1').append(row1);
           var row2 =
             "<tr id='down_qty_in'><td>QTY IN</td></tr>" +
             "<tr id='down_qty_pass'><td>QTY PASS</td></tr>" +
             "<tr id='down_qty_fail'><td>QTY FAIL</td></tr>" +
             "<tr id='down_retest_in'><td>RETEST IN</td></tr>" +
             "<tr id='down_retest_pass'><td>RETEST PASS</td></tr>" +
             "<tr id='down_retest_fail'><td>RETEST FAIL</td></tr>";
           $('#hourly_table_body2').append(row2);

           const jsonData = data.result;

           // Sort by time
           jsonData.sort((a, b) => a.current_t - b.current_t);

           // Reset dropdown and table
           $('#hourly_time').empty();
           $('#hourly_time').append(new Option('Select Time', 0));

           // Group by date
           const grouped = {};
           jsonData.forEach(item => {
             if (!grouped[item.current_d]) grouped[item.current_d] = [];
             grouped[item.current_d].push(item);
           });


           // Begin rendering per day
           for (const [current_d, items] of Object.entries(grouped)) {
             const rows = ["qty_in", "qty_pass", "qty_fail", "retest_in", "retest_pass", "retest_fail"];
             const skipIndices = [];

             for (let i = 0; i < items.length; i++) {
               if (skipIndices.includes(i)) continue;

               const now = new Date();
               const currentHour = now.getHours();
               const item = items[i];
               const hour = item.current_t;
               const colLabel = formatHourRange(hour);
               const isCurrentHour = parseInt(hour) === currentHour;

               const isDayShift = hour >= 7 && hour <= 18;
               const tablePrefix = isDayShift ? "up" : "down";

               $(`#${tablePrefix}Header`).append(
                 `<th class="${isCurrentHour ? 'current-hour-header' : ''}">${colLabel}</th>`
               );

               const status = item.status ? item.status.toUpperCase() : '';
               const isEmptyStatus = status === '';
               const isNonRunning = ['BREAKTIME', 'NO PRODUCTION'].includes(status);
               let rowspan = 1;



               rows.forEach((key, rowIndex) => {
                 const rowId = `#${tablePrefix}_${key}`;
                 const td = $('<td></td>');

                 // Compute rowspan for BREAKTIME or NO PRODUCTION
                 if (isNonRunning) {


                   if (rowIndex === 0) {
                     const verticalText = status.split('').map(c => `<div>${c}</div>`).join('');
                     const className = status === 'BREAKTIME' ? 'breaktime' : 'noproduction';
                     // td.attr('rowspan', rows.length * rowspan).addClass('vertical-text').html(verticalText);
                     td.attr('rowspan', rows.length * rowspan).addClass(`vertical-text ${className}`).html(verticalText);
                     $(rowId).append(td);
                   } else {
                     // Append empty <td style="display:none"> to maintain table layout
                     td.css('display', 'none');
                     $(rowId).append(td);
                   }
                   return;
                 }

                 // Render each row

                 // 1️⃣ Vertical label if BREAKTIME or NO PRODUCTION (only on top row)
                 if (isNonRunning && rowIndex === 0) {
                   const verticalText = status.split('').map(c => `<div>${c}</div>`).join('');
                   td.attr('rowspan', rows.length * rowspan).addClass('vertical-text').html(verticalText);
                   $(rowId).append(td);
                   return; // first row handled
                 }

                 // 2️⃣ Skip other rows under BREAKTIME/NO PRODUCTION (since rowspan used)
                 if (isNonRunning) return;

                 // 3️⃣ If status is empty, display '-' for all rows
                 if (isEmptyStatus) {
                   td.html('-');
                   $(rowId).append(td);
                   return;
                 }

                 // 4️⃣ Else, show value
                 const val = item[key];
                 td.html(val === "0" ? "-" : val);
                 $(rowId).append(td);
                 td.addClass(isCurrentHour ? 'current-hour-cell' : '');
               });

               // Populate dropdown
               if ([9, 23].includes(hour)) {
                 $('#hourly_time').append($('<option>', {
                   text: hour === 9 ? '09 - 10' : '23 - 00',
                   'data-current_t': item.current_t,
                   'data-current_d': item.current_d,
                   'data-qty_fail': item.qty_fail
                 }));
               } else if (hour < 9) {
                 $('#hourly_time').append($('<option>', {
                   text: "0" + hour + " - 0" + (parseInt(hour) + 1),
                   'data-current_t': item.current_t,
                   'data-current_d': item.current_d,
                   'data-qty_fail': item.qty_fail
                 }));
               } else if (hour > 9 && hour < 23) {
                 $('#hourly_time').append($('<option>', {
                   text: hour + " - " + (parseInt(hour) + 1),
                   'data-current_t': item.current_t,
                   'data-current_d': item.current_d,
                   'data-qty_fail': item.qty_fail
                 }));
               }
             }
           }


         } else {
           console.log(data.error);
         }
       }, 'json');
     }

     function formatHourRange(hour) {
       const h1 = hour.toString().padStart(2, '0');
       const h2 = ((hour + 1) % 24).toString().padStart(2, '0');
       return `${h1}-${h2}`;
     }



   });
 </script>