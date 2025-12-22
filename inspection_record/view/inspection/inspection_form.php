 <?php
  date_default_timezone_set('Asia/Jakarta');
  $serverDT = date('Y-m-d H:i:s');
  ?>

 <!-- content-header -->
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0">Inspection Form</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item">Inspection Record</li>
           <li class="breadcrumb-item active">Inspection Form</li>
         </ol>
       </div>
     </div>
   </div>
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <section class="content">
   <div class="container-fluid">

     <!-- <div class="row">

     </div> -->

     <!-- Main row -->
     <div class="row">
       <!-- Left col -->
       <section class="col-lg-6 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-chart-pie mr-1"></i>
               Product Info
             </h3>

           </div><!-- /.card-header -->
           <div class="card-body">
             <div class="form-group row">
               <label for="customer" class="col-sm-2 col-form-label">Customer</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="customer">
                   <option selected="selected">Select Customer</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="partnumber" class="col-sm-2 col-form-label">Part Number</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <input class="form-control" type="text" placeholder="Part Number" id="partnumber" list="pn_list">
                 <datalist id="pn_list"></datalist>
               </div>
             </div>
             <div class="form-group row">
               <label for="area" class="col-sm-2 col-form-label">Area</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="area">
                   <option selected="selected">Select Area</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="line" class="col-sm-2 col-form-label">Line</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="line">
                   <option selected="selected">Select Line</option>

                 </select>
               </div>
             </div>
             <div class="form-group row">
               <label for="station" class="col-sm-2 col-form-label">Station</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="station">
                   <option selected="selected">Select Station</option>

                 </select>
               </div>
             </div>

             <div class="form-group row">
               <label for="machine" class="col-sm-2 col-form-label">Machine</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder='Input machine name or "NA" if none' id="machine">
               </div>
             </div>
             <div class="form-group row">
               <label for="dt" class="col-sm-2 col-form-label">Date</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder="yyyy-MM-dd" id="dt" disabled>
               </div>
             </div>

             <div class="form-group row">
               <label for="time_frame" class="col-sm-2 col-form-label">Time Frame</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder="HH - HH" id="time_frame" disabled>
               </div>
             </div>

           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->
       </section>
       <!-- /.Left col -->

       <!-- right col -->
       <section class="col-lg-6 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-microscope"></i>
               Inspection Result
             </h3>

           </div><!-- /.card-header -->

           <!-- /.card -->
           <div class="card-body">
             <div class="form-group row">
               <label for="sn" class="col-sm-2 col-form-label">Serial Number</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder="Serial Number" id="sn">
               </div>
             </div>
             <div class="form-group row">
               <label for="fail_mode" class="col-sm-2 col-form-label">Fail Mode</label>
               <div class="col-sm-10">
                 <!-- <input class="form-control" type="text" placeholder="customer"> -->
                 <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="fail_mode">
                   <option selected="selected">Select Fail Mode</option>

                 </select>
               </div>
             </div>

             <div class="form-group row">
               <label for="fail_location" class="col-sm-2 col-form-label">Fail Location</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder="Fail Location" id="fail_location">
               </div>
             </div>
             <div class="form-group row">
               <label for="fail_remarks" class="col-sm-2 col-form-label">Remarks</label>
               <div class="col-sm-10">
                 <input class="form-control" type="text" placeholder="Fail Remarks" id="fail_remarks">
               </div>
             </div>
             <div class="form-group row">
               <div class="col-sm-4">
                 <button type="button" id="add_defect" class="btn btn-block bg-gradient-success">Add Fail Record</button>
               </div>
               <div class="col-sm-4">
                 <button type="button" id="add_retest" class="btn btn-block bg-gradient-danger">Add Retest Data</button>
               </div>

               <div class="col-sm-4">
                 <button type="button" id="clear_result" class="btn btn-block bg-gradient-warning">Clear</button>
               </div>
             </div>
           </div><!-- /.card-body -->

           <div class="card-body" style="margin-top: 0px;padding-top:0px;">
             <div class="row">
               <section class="col-lg-5 connectedSortable" style="margin-right: 30px;">
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Qty IN</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="qty_in" disabled>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Qty Pass</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="qty_pass" disabled>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Qty Fail</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="qty_fail" disabled>
                   </div>
                 </div>
               </section>
               <section class="col-lg-5 connectedSortable">
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Retest IN</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="retest_in" disabled>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Retest Pass</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="retest_pass" disabled>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_loc" class="col-sm-4 col-form-label">Retest Fail</label>
                   <div class="col-sm-8">
                     <input class="form-control" type="text" placeholder="0" id="retest_fail" disabled>
                   </div>
                 </div>
               </section>
             </div>
           </div>
       </section>

       <section class="col-lg-12 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-table"></i>
               Inspection Hourly Record
             </h3>

           </div><!-- /.card-header -->

           <!-- /.card -->
           <div class="card-body">
             <div class="row">
               <table id="hourly_table" class="table table-bordered table-striped">
                 <thead>
                   <tr>
                     <th>No.</th>
                     <th>Serial Number</th>
                     <th>Part Number</th>
                     <th>Line</th>
                     <th>Station</th>
                     <th>Machine</th>
                     <th>Fail Mode</th>
                     <th>Fail Location</th>
                     <!-- <th>Remarks</th> -->
                     <th>Retest Mode</th>
                     <th>Retest Description</th>
                     <th>Retest Verification</th>
                     <!-- <th>Remarks</th> -->
                     <th>View</th>
                   </tr>
                 </thead>
                 <tbody id="hourly_table_body">
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </section>
       <!-- right col -->
     </div>
     <!-- /.row (main row) -->
   </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->
 <!-- Modals -->
 <!-- Test -->
 <div class="modal fade" id="modal-retest" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><i class="fas fa-tools"></i> &nbsp;Add Retest Data</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <!-- Left col -->
           <section class="col-lg-12 connectedSortable">
             <div class="card">
               <div class="card-body">
                 <div class="form-group row">
                   <label for="modal_sn" class="col-sm-2 col-form-label">Serial Number</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" disabled id="modal_sn">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="retest_mode" class="col-sm-2 col-form-label">Retest Mode</label>
                   <div class="col-sm-10">

                     <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="retest_mode">
                       <option selected="selected">Select Retest Mode</option>
                       <option>1st - WO Removal</option>
                       <option>2nd - W Removal [Same Slot]</option>
                       <option>3rd - W Removal [Different Slot]</option>
                       <option>4th - W Removal [Different Slot and Tester]</option>
                       <option>5th - W Removal [Same Slot and Tester]</option>
                     </select>

                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="retest_verification" class="col-sm-2 col-form-label">Verification</label>
                   <div class="col-sm-10">
                     <!-- <input class="form-control" type="text" placeholder="customer"> -->
                     <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" id="retest_verification">
                       <option selected="selected">Select Verifcation</option>
                       <option>Retest PASS</option>
                       <option>Retest FAIL</option>
                     </select>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_desc" class="col-sm-2 col-form-label">Fail Decription</label>
                   <div class="col-sm-10">
                     <!-- <input class="form-control" type="text" placeholder="Input fail description" id="fail_desc"> -->
                     <input class="form-control" type="text" placeholder="Input fail description" id="fail_desc" list="fail_desc_list">
                     <datalist id="fail_desc_list"></datalist>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_remarks" class="col-sm-2 col-form-label">Remarks</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" placeholder="Input remarks" id="fail_remarks">
                   </div>
                 </div>
               </div><!-- /.card-body -->
             </div>
             <!-- /.card -->
           </section>
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-warning" id="clear_retest_button">Clear</button>
           <button type="button" class="btn btn-success" id="save_retest_button">Save changes</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
 </div>

 <!-- Modal for InQty -->
 <div class="modal fade" id="modal-InQty" style="display: none;" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title" id="modal_add_qty_in_title"><i class="fas fa-tools"></i> &nbsp;Add Qty IN</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <!-- Left col -->
           <section class="col-lg-12 connectedSortable">
             <div class="card">
               <div class="card-body">
                 <div class="form-group row">
                   <label for="modal_qty_in" class="col-sm-2 col-form-label">Qty IN</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" id="modal_qty_in">
                   </div>
                 </div>
               </div><!-- /.card-body -->
             </div>
             <!-- /.card -->
           </section>
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-warning" id="clear_qty_button">Clear</button>
           <button type="button" class="btn btn-success" id="save_qty_button">Save changes</button>
           <button type="button" class="btn btn-danger" id="breaktime_button">Production Breaktime</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
 </div>

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
       //  console.log(serverTime);
     }, 1000);
     $('#modal_qty_in').on('input', function() {
       $(this).val($(this).val().replace(/[^0-9]/g, ''));
     });
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

     //Get all fail mode
     $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
       action: 'getAllFailMode',
     }, function(data) {

       if (typeof data.error === 'undefined') {
         $('#fail_mode').empty();
         $('#fail_mode').append(new Option('Select Fail Mode', 0));
         $('#fail_mode').append(new Option('Others', 1));
         if (!jQuery.isEmptyObject(data.result)) {
           $.each(data.result, function(i, item) {
             $('#fail_mode').append($('<option>', {
               value: item['defect_code'],
               text: item['defect_code'] + ' - ' + item['defect_description'],
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

         //getFailDesc base on station_code
         $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
           action: 'getFailDesc',
           station_code: $('#station option:selected').val(),
         }, function(data) {

           if (typeof data.error === 'undefined') {
             $('#fail_desc_list').html('');
             $.each(data.result, function(i, item) {
               $('#fail_desc_list').append("<option value='" + item['part_number'] + "'>");
             });

           } else {
             console.log(data.error);
           }
         }, 'json');

         checkInQTY(requestData);
         LoadInspectionRecord(requestData);
       }
     });

     //Save Retest Data
     $('#save_retest_button').on('click', function() {
       if ($('#modal_sn').val() == '' || $('#retest_verification option:selected').text() == 'Select Verifcation' || $('#retest_mode option:selected').text == 'Select Retest Mode') {
         Toast.fire({
           icon: 'warning',
           title: 'Please complete all required data on the retest form.'
         })
         return;
       } else {
         retest_mode = $('#retest_mode option:selected').text();
         retest_verification = $('#retest_verification option:selected').text();
         retest_fail_desc = $('#fail_desc').val();
         retest_remarks = $('#fail_remarks').val();
         Toast.fire({
           icon: 'success',
           title: 'Retest Verication data added.'
         })
         $('#modal-retest').modal('hide');
       }
     });

     //add retest data
     $('#add_retest').on('click', function() {
       if ($('#sn').val() == '') {
         Toast.fire({
           icon: 'warning',
           title: 'Please scan/input serial number form.'
         })
         $('#modal-retest').modal('hide');
         return;

       } else {
         $('#modal_sn').val($('#sn').val());

         $('#modal-retest')
           .modal({
             backdrop: 'static',
             keyboard: false
           }) // Set config
           .modal('show');
       }

     });

     //Add defect button
     $('#add_defect').on('click', function() {
       if ($('#fail_mode').text == 'Select Fail Mode' || $('#sn').val() == '' || $('#customer').text == 'Select Customer' ||
         $('#partnumber').val == '' || $('#area').text == 'Select Area' || $('#line').text == 'Select Line' || $('#machine').val() == '' ||
         $('#station').text == 'Select Station') { //|| $('#fail_location').val() == '') 
         Toast.fire({
           icon: 'warning',
           title: 'Please complete all required data on the inspection form.'
         })
         $('#modal-retest').modal('hide');
       } else {
         if ($('#customer option:selected').val() == 'CG') {
           $('#add_retest').click();
           $('#modal-retest').on('hidden.bs.modal', function() {
             AddtoDB();
           });
         } else {
           Swal.fire({
             title: "Do you want to add Retest data?",
             icon: "question",
             showCancelButton: true,
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Yes",
             cancelButtonText: "No"
           }).then((result) => {
             if (result.isConfirmed) {
               //show modal
               $('#add_retest').click();
               $('#modal-retest').on('hidden.bs.modal', function() {
                 AddtoDB();
               });
             } else {
               AddtoDB();
             }
           });
         }

       }
     });

     $('#modal-retest').on('hidden.bs.modal', function() {
       $(this).find('input[type="text"], textarea').val('');
       $(this).find('select').prop('selectedIndex', 0);
     });

     $('#clear_retest_button').on('click', function() {
       $(this).find('input[type="text"], textarea').val('');
       $(this).find('select').prop('selectedIndex', 0);
       $('#modal_sn').val($('#sn').val());
     });

     //Clear Inspection Result Section
     $('#clear_result').on('click', function() {
       $('#sn').val("");
       $('#fail_mode').prop('selectedIndex', 0);
       $('#fail_location').val("");
       $('#fail_remarks').val("");
       $('#sn').focus();
     });

     //Load Hourly Record
     function LoadInspectionRecord(data) {
       $('#hourly_table_body').empty();
       let RetestPASSCount = 0;
       let RetestFAILCount = 0;
       $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
         action: 'GetHourlyInspectionRecord',
         customer_code: data['customer_code'],
         line: data['line'],
         station: data['station'],
       }, function(data) {
         console.log(data);
         if (typeof data.error === 'undefined') {
           var rowCount = $('#hourly_table tbody tr').length;
           $.each(data.result, function(i, item) {
             if (item['retest_mode'] == 'Retest PASS') {
               RetestPASSCount += 1;
             } else if (item['retest_mode'] == 'Retest FAIL') {
               RetestFAILCount += 1;
             }
             //'data-id': item['id']
             var row = "<tr>" +
               "<td>" + item['rownum'] + "</td><td>" + item['serial_number'] + "</td><td>" + item['model'] + "</td>" +
               "<td>" + item['description'] + "</td><td>" + item['station_description'] + "</td><td>" + item['machine'] + "</td><td>" + item['defect'] + "</td>" +
               "<td>" + item['fail_loc'] + "</td>" + "</td><td>" + item['retest_mode'] + "</td><td>" + item['fail_desc'] + "</td><td>" + item['retest_verification'] + "</td><td></td>"
             "</tr>";
             $('#hourly_table_body').append(row);
           });
           $('#retest_in').val(RetestFAILCount + RetestPASSCount);
           $('#retest_pass').val(RetestPASSCount);
           $('#retest_fail').val(RetestFAILCount);
           $('#qty_fail').val(RetestFAILCount + RetestPASSCount);
         } else {
           console.log(data.error);
         }
       }, 'json');
     }
     //Check Previvous Hour if have Qty IN
     function checkInQTY(data) {

       //check if inQty is exists; if exist means no in qty from previous hours
       if (localStorage.getItem('InQty') !== null) {

         var _hours = currentServerTime.getHours();
         var _hoursMinusOne = (_hours - 1) % 24;
         var _formattedHour = _hoursMinusOne.toString().padStart(2, '0');
         $('#modal_add_qty_in_title').text(_formattedHour + "-" + _hours.toString().padStart(2, '0'));

         $('#modal-InQty')
           .modal({
             backdrop: 'static',
             keyboard: false
           }) // Set config
           .modal('show');
       } else {
         // continue
       }

       $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
         action: 'GetHourlyInspectionRecord',
         customer_code: data['customer_code'],
         line: data['line'],
         station: data['station'],
       }, function(data) {
         console.log(data);
         if (typeof data.error === 'undefined') {
           if (data.result == '') {
             localStorage.setItem('InQty', '0'); // no record of transaction last hour
             localStorage.setItem('customer_code', data['customer_code']);
             localStorage.setItem('line', data['line']);
             localStorage.setItem('station', data['station']);
           } else {
             if (data.result['qty_in'] == '0') { // have record but no qty in
               localStorage.setItem('InQty', '0');
               localStorage.setItem('customer_code', data['customer_code']);
               localStorage.setItem('line', data['line']);
               localStorage.setItem('station', data['station']);
             } else {
               localStorage.removeItem('InQty');
               localStorage.removeItem('customer_code');
               localStorage.removeItem('line');
               localStorage.removeItem('station');
             }
           }
         } else {
           console.log(data.error);
         }
       }, 'json');
     }

     function AddtoDB() {


       //add to DB
       //alert($('#customer option:selected').val());
       $.post('/dev1/digitalization/inspection_record/route/inspection_form.php', {
         action: 'add',
         sn: $('#sn').val(),
         customer: $('#customer option:selected').val(),
         area: $('#area option:selected').text(),
         line: $('#line option:selected').val(),
         model: $('#partnumber').val(),
         station: $('#station option:selected').val(),
         machine: $('#machine').val(),
         fail_mode: $('#fail_mode option:selected').val(),
         fail_location: $('#fail_location').val(),
         fail_remarks: $('#fail_remarks').val(),
         retest_mode: retest_mode,
         retest_verification: retest_verification,
         retest_fail_desc: retest_fail_desc,
         retest_remarks: retest_remarks,
       }, function(data) {

         if (typeof data.error === 'undefined') {
           if (data.result['error']) {
             Swal.fire({

               title: data.result['error'],
               icon: "error"
             });
           } else {
             var rowCount = $('#hourly_table tbody tr').length;
             var row = "<tr>" +
               "<td>" + (rowCount + 1) + "</td><td>" + $('#sn').val() + "</td><td>" + $('#partnumber').val() + "</td>" +
               "<td>" + $('#line option:selected').text() + "</td><td>" + $('#station option:selected').text() + "</td><td>" + $('#machine').val() + "</td><td>" + $('#fail_mode option:selected').text() + "</td>" +
               "<td>" + $('#fail_location').val() + "</td>" + "</td><td>" + retest_mode + "</td><td>" + retest_fail_desc + "</td><td>" + retest_verification + "</td>"
             "</tr>";
             $('#hourly_table_body').append(row);
             Swal.fire({

               title: data.result['success'],
               icon: "success"
             });

             $('#clear_result').click();
             retest_mode = "";
             retest_verification = "";
             retest_fail_desc = "";
             retest_remarks = "";
           }

         } else {
           console.log(data.error);
         }
       }, 'json');

     }
   });
 </script>