 <?php
    date_default_timezone_set('Asia/Jakarta');
    $serverDT = date('Y-m-d H:i:s');
    ?>

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Product ID (View Only)</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Product</li>
                     <li class="breadcrumb-item active">Product ID</li>
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
                             Part Number Revision List
                         </h3>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <table id="pid_table" class="table table-bordered table-striped" style="width:100% !important; table-layout:fixed;">
                                 <thead>
                                     <tr>
                                         <th>No.</th>
                                         <th>Part Number</th>
                                         <th>Revision</th>
                                         <th>Status</th>
                                         <th>Remarks</th>
                                     </tr>
                                 </thead>
                                 <tbody id="pid_table_body">
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </section>

             <section class="col-lg-12 connectedSortable">
             </section>
         </div>

     </div>
 </section>


 <script>
     var serverTime = new Date("<?php echo $serverDT; ?>".replace(' ', 'T'));
     var clientStartTime = new Date();
     var now = new Date();
     var diff = now - clientStartTime; // time since page loaded
     var currentServerTime = new Date(serverTime.getTime() + diff);

     var pidTable;

     $(document).keydown(function(e) {
         if (e.key === "Escape") {
             e.preventDefault();
         }
     });

     $(document).ready(function() {

         if ($.fn.DataTable.isDataTable("#pid_table")) {
             $("#pid_table").DataTable().destroy();
         }

         pidTable = $("#pid_table").DataTable({
             responsive: true,
             lengthChange: false,
             autoWidth: false
         });
         console.log("Document ready - Loading PID Record");

         LoadPIDRecord();
     });

     function LoadPIDRecord() {
         $('#pid_table_body').empty();
         $.post('pid/route/pid.php', {
             action: 'getPID',
         }, function(data) {

             if (data && typeof data.error === 'undefined') {
                 pidTable.clear();
                 $.each(data.result, function(i, item) {

                     pidTable.row.add([
                         item.rownum,
                         item.part_number,
                         item.product_id,
                         item.last_update,
                         item.remarks
                     ]);
                 });

                 pidTable.draw(false);

             } else {
                 console.log(data.error);
             }

         }, 'json');

     }

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



     });
 </script>