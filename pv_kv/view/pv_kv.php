 <?php
    date_default_timezone_set('Asia/Jakarta');
    $serverDT = date('Y-m-d H:i:s');
    ?>

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">PV/KV Label Management</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Product</li>
                     <li class="breadcrumb-item active">PV/KV Label</li>
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
                             <i class="fas fa-microscope"></i>
                             Part Number Info
                         </h3>
                     </div>

                     <div class="card-body">
                         <div class="form-group row">
                             <label for="sn" class="col-sm-2 col-form-label">CG Part Number</label>
                             <div class="col-sm-10">
                                 <input class="form-control" type="text" placeholder="Cognex Part Number (ex. 820-10100-002)" id="pn">
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="fail_location" class="col-sm-2 col-form-label">Revision</label>
                             <div class="col-sm-10">
                                 <input class="form-control" type="text" placeholder="Revision (ex. 01)" id="rev">
                             </div>
                         </div>

                         <div class="form-group row" style="display:flex;justify-content:flex-end;gap:20px;">
                             <div class="col-sm-2">
                                 <button type="button" id="add_pv_kv" class="btn btn-block bg-gradient-success">Add New</button>
                             </div>

                             <div class="col-sm-2">
                                 <button type="button" id="clear_result" class="btn btn-block bg-gradient-warning">Clear</button>
                             </div>

                             <div class="col-sm-2">
                                 <button type="button" id="refresh" class="btn btn-block bg-gradient-primary">Refresh</button>
                             </div>

                         </div>
                     </div>
             </section>
         </div>
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
                             <table id="pv_kv_table" class="table table-bordered table-striped">
                                 <thead>
                                     <tr>
                                         <th>No.</th>
                                         <th>Part Number</th>
                                         <th>Revision</th>
                                         <th>Module PN</th>
                                         <th>Module Revision</th>
                                         <th>Module Description</th>
                                         <th>Module Type</th>
                                         <th>Label Type</th>
                                         <th>Product ID</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody id="pv_kv_table_body">
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



 <script>
     var serverTime = new Date("<?php echo $serverDT; ?>".replace(' ', 'T'));
     var clientStartTime = new Date();
     var now = new Date();
     var diff = now - clientStartTime; // time since page loaded
     var currentServerTime = new Date(serverTime.getTime() + diff);

     var pnRevTable;

     $(document).keydown(function(e) {
         if (e.key === "Escape") {
             e.preventDefault();
         }
     });

     $(document).ready(function() {

         if ($.fn.DataTable.isDataTable("#pv_kv_table")) {
             $("#pv_kv_table").DataTable().destroy();
         }

         pnRevTable = $("#pv_kv_table").DataTable({
             responsive: true,
             lengthChange: false,
             autoWidth: false
         });

         LoadPNREVRecord();
     });

     function LoadPNREVRecord() {
         $('#pv_kv_table_body').empty();
         $.post('pv_kv/route/pv_kv.php', {
             action: 'getPVKV',
         }, function(data) {

             if (data && typeof data.error === 'undefined') {
                 pnRevTable.clear();
                 $.each(data.result, function(i, item) {

                     pnRevTable.row.add([
                         item.rownum,
                         item.part_number,
                         item.revision,
                         item.module_pn,
                         item.module_rev,
                         item.module_desc,
                         item.module_type,
                         item.web_form,
                         item.product_id,
                         `
                    <button 
                        class="btn btn-sm btn-primary btn-update"
                        data-pn="${item.pn}"
                        data-rev="${item.rev}"
                        data-status="${item.status}"
                        data-remarks="${item.remarks}">
                        <i class="fas fa-edit"></i> Update
                    </button>
                    `
                     ]);
                 });

                 pnRevTable.draw(false);

             } else {
                 console.log(data.error);
             }

         }, 'json');

         $(document).on("click", ".btn-update", function() {

             const pn = $(this).data("pn");
             const rev = $(this).data("rev");
             const status = $(this).data("status");


             Swal.fire({
                 title: "Update PN Revision",
                 width: 520,
                 html: `
            <div class="swal-form">
                <div class="swal-group">
                <label>Part Number</label>
                <input id="swal-pn" class="swal2-input" value="" disabled>
                </div>

                <div class="swal-row">
                <div class="swal-group">
                    <label>Revision</label>
                    <input id="swal-rev" class="swal2-input" value="">
                </div>

                <div class="swal-group">
                    <label>Status</label>
                    <select id="swal-status" class="swal2-select">
                    <option value="Active">Active</option>
                    <option value="In-Active">In-Active</option>
                    </select>
                </div>
                </div>
            </div>
            `,
                 showCancelButton: true,
                 confirmButtonText: "Save Changes",
                 cancelButtonText: "Cancel",
                 focusConfirm: false,
                 didOpen: () => {
                     document.getElementById("swal-pn").value = pn;
                     document.getElementById("swal-rev").value = rev;
                     document.getElementById("swal-status").value = status;
                 },
                 preConfirm: () => {
                     const revVal = document.getElementById("swal-rev").value.trim();

                     if (!revVal) {
                         Swal.showValidationMessage("Revision cannot be empty");
                         return false;
                     }

                     return {
                         pn: pn,
                         rev: revVal,
                         status: document.getElementById("swal-status").value,

                     };
                 }
             }).then(result => {

                 if (!result.isConfirmed) return;

                 Swal.showLoading();

                 $.post('pv_kv/route/pv_kv.php', {
                     action: 'update',
                     pn: result.value.pn,
                     rev: result.value.rev,
                     status: result.value.status
                 }, function(data) {
                     console.log(data);
                     if (typeof data.error === 'undefined') {
                         if (data.result === true) {
                             Swal.fire('Updated!', 'Data updated successfully.', 'success');
                             LoadPNREVRecord();
                         } else {
                             Swal.fire('Failed', 'Update failed.', 'error');
                         }

                     } else {
                         console.log(data.error);
                     }
                 }, 'json');
             });
         });


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

         //Clear Inspection Result Section
         $('#clear_result').on('click', function() {
             $('#sn').val("");
             $('#fail_mode').prop('selectedIndex', 0);
             $('#fail_location').val("");
             $('#fail_remarks').val("");
             $('#sn').focus();
         });


         $('#add_pv_kv').on('click', function() {

             if ($('#pn').length != 0 && $('#rev').length != 0) {
                 $.post('pv_kv/route/pv_kv.php', {
                     action: 'add',
                     pn: $('#pn').val(),
                     rev: $('#rev').val(),
                     status: 'Active'
                 }, function(data) {
                     console.log(data);
                     if (typeof data.error === 'undefined') {
                         if (data.result === true) {
                             Swal.fire('Added!', 'Data added successfully.', 'success');
                             LoadPNREVRecord();
                         } else {
                             Swal.fire('Failed', 'Adding failed.', 'error');
                         }
                     } else {
                         console.log(data.error);
                     }
                 }, 'json');
             }

         });


     });
 </script>