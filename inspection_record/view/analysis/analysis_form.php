 <?php
  date_default_timezone_set('Asia/Jakarta');
  $serverDT = date('Y-m-d H:i:s');
  ?>

 <!-- content-header -->
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0">Analysis and Corrective Action Form</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item">Inspection Record</li>
           <li class="breadcrumb-item active">For Analysis</li>
         </ol>
       </div>
     </div>
   </div>
 </div>
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <section class="col-lg-12 connectedSortable">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <i class="fas fa-table"></i>
               Defect Record <button type='button' class='btn btn-warning' id='btn-reload'><i class="fas fa-sync-alt"></i> Reload</button>
             </h3>

           </div>
           <div class="card-body">
             <div class="row" style="width: 100% !important;; overflow-x: auto;">
               <table id="hourly_table" class="table table-bordered table-striped">
                 <thead>
                   <tr>
                     <th style="background-color: #f0f8ff; color: #333;">No.</th>
                     <th style="background-color: #f0f8ff; color: #333;">Customer</th>
                     <th style="background-color: #f0f8ff; color: #333;">Line</th>
                     <th style="background-color: #f0f8ff; color: #333;">Station</th>
                     <th style="background-color: #f0f8ff; color: #333;">Machine</th>
                     <th style="background-color: #f0f8ff; color: #333;">Defect</th>
                     <th style="background-color: #f0f8ff; color: #333;">Time</th>
                     <th style="background-color: #f0f8ff; color: #333;">Date</th>
                     <th style="background-color: #f0f8ff; color: #333;">Serial Number</th>
                     <th style="background-color: #f0f8ff; color: #333;">Count per Group</th>
                     <th style="background-color: #C7EFD7; color: #333;">Action</th>
                   </tr>
                 </thead>
                 <tbody id="hourly_table_body">
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </section>
     </div>
   </div>
 </section>
 <div class="modal fade" id="modal-analysis" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><i class="fas fa-tools"></i> &nbsp;Add Analysis Data</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
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
                   <label for="modal_failmode" class="col-sm-2 col-form-label">Fail Mode</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" disabled id="modal_failmode">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_line" class="col-sm-2 col-form-label">Line</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" disabled id="modal_line">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_machine" class="col-sm-2 col-form-label">Machine</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" disabled id="modal_machine">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_station" class="col-sm-2 col-form-label">Station</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" disabled id="modal_station">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_ca" class="col-sm-2 col-form-label">Cause Analysis</label>
                   <div class="col-sm-10">
                     <textarea style="width: 600px;" id="modal_ca"></textarea>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_at" class="col-sm-2 col-form-label">Action Taken</label>
                   <div class="col-sm-10">
                     <textarea style="width: 600px;" id="modal_at"></textarea>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="modal_result" class="col-sm-2 col-form-label">Verication Result</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" placeholder="" id="modal_result" disabled>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="fail_remarks" class="col-sm-2 col-form-label">Remarks</label>
                   <div class="col-sm-10">
                     <input class="form-control" type="text" placeholder="" id="fail_remarks" disabled>
                   </div>
                 </div>
               </div>
             </div>
           </section>
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-warning" id="clear_button">Clear</button>
           <button type="button" class="btn btn-success" id="save_button">Save changes</button>
         </div>
       </div>
     </div>
   </div>
 </div>
 <script>
   var current_tm, current_dt = '';
   var customer, defect_count = '';
   ;
   $(document).keydown(function(e) {
     if (e.key === "Escape") {
       e.preventDefault();
     }
   });

   $(function() {
     LoadDefectData(); //Load the 3 and 5 consecutive defect found

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
     var serverTime = new Date("<?php echo $serverDT; ?>".replace(' ', 'T'));
     var clientStartTime = new Date();

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


     $('#modal-analysis').on('hidden.bs.modal', function() {
       $(this).find('input[type="text"], textarea').val('');
     });

     function LoadDefectData() {
       $('#hourly_table_body').empty();
       let RetestPASSCount = 0;
       let RetestFAILCount = 0;
       $.post('/dev1/digitalization/inspection_record/route/analysis_form.php', {
         action: 'GetTriggeringDefect',
       }, function(data) {
         console.log(data);
         if (typeof data.error === 'undefined') {
           var rowCount = $('#hourly_table tbody tr').length;
           $.each(data.result, function(i, item) {

             //'data-id': item['id']
             var row = "<tr>" +
               "<td>" + item['rownum'] + "</td><td>" + item['customer_description'] + "</td><td>" + item['line_description'] + "</td>" +
               "<td>" + item['station_description'] + "</td><td>" + item['machine'] + "</td><td>" + item['defect_description'] + "</td><td>" + item['current_t'] + "</td><td>" + item['current_d'] + "</td>" +
               "<td>" + item['serial_numbers'] + "</td><td>" + item['count_per_group'] + "</td><td><button type='button' class='btn btn-primary' id='btn-update'>Update</button></td>"
             "</tr>";
             $('#hourly_table_body').append(row);
   
           });
           $('#hourly_table').DataTable({
             fixedHeader: true,
             scrollX: true,
             responsive: true
           });
         } else {
           console.log(data.error);
         }
       }, 'json');
     }

     $('#btn-reload').on('click', function() {
       $('#hourly_table').DataTable().destroy();
       LoadDefectData();
     });

     $('#save_button').on('click', function() {
       if ($('#modal_ca').val() != "" && $('#modal_at').val() != "") {
         //save
         AddtoDB();
       //  $('#modal-analysis').modal('hide'); 
       }else{
         Toast.fire({
           icon: 'warning',
           title: 'Please complete all required data on the analysis form.'
         })
       }
     });

     $(document).on('click', '#btn-update', function() {
       var $row = $(this).closest('tr');
       var tds = $row.find('td');

       // Example: Get specific column values

       $('#modal_sn').val(tds.eq(8).text());
       $('#modal_failmode').val(tds.eq(5).text());
       $('#modal_line').val(tds.eq(2).text());
       $('#modal_machine').val(tds.eq(4).text());
       $('#modal_station').val(tds.eq(3).text());
       customer = tds.eq(1).text();
       current_tm = tds.eq(6).text();
       current_dt = tds.eq(7).text();
       defect_count = tds.eq(9).text();
       if (tds.eq(8).text() != '-' || tds.eq(8).text() != '') {
         $('#modal_result').prop('disabled', false);
         $('#fail_remarks').prop('fail_remarks', false);
       }
       $('#modal-analysis')
         .modal({
           backdrop: 'static',
           keyboard: false
         }) // Set config
         .modal('show');

     });


     function AddtoDB() {
       $.post('/dev1/digitalization/inspection_record/route/analysis_form.php', {
         action: 'Add',
         'customer': customer,
         'line': $('#modal_line').val(),
         'station': $('#modal_station').val(),
         'machine': $('#modal_machine').val(),
         'defect': $('#modal_failmode').val(),
         'time': current_tm,
         'date': current_dt,
         'count': defect_count,
         'root_cause': $('#modal_ca').val(),
         'action_taken': $('#modal_at').val(),
         'sn': $('#modal_sn').val()
       }, function(data) {

         if (typeof data.error === 'undefined') {
           if (data.result['error']) {
             Swal.fire({

               title: data.result['message'],
               icon: "error"
             });
           } else {
             Swal.fire({
               title: data.result['message'],
               icon: "success"
             });
       
            
           }

         } else {
           console.log(data.error);
         }
       }, 'json');

     }
   });
 </script>