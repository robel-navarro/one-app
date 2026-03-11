<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
$_SESSION['DIRECTORY'] = __DIR__;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PCI Digitalization</title>
  <link rel="icon" href="dist/img/input-tablet.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- swal -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- DataTables JS after jQuery -->

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/pci-black.png" alt="" height="100" width="260">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" \>
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $_SESSION['fullname'] ?>

          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" id="logout" style="width: 20%;">
              <i class="fas fa-sign-out-alt"></i>Logout
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="dist/img/pci-white.png" alt="PCI Logo" style="width:240px; height:50px;" style="opacity: .8">
        <!-- <span class="brand-text font-weight-light">PT PCI</span> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar" id="main_sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="display:none">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Inspection Record
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="inspection_record/view/inspection/inspection_form.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <p>Inspection Form</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="inspection_record/view/analysis/analysis_form.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <!-- <i class="fas fa-tasks"></i> -->
                    <p>For Analysis</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="inspection_record/view/hourly/hourly_inspection_record.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <!-- <i class="fas fa-tasks"></i> -->
                    <p>Hourly Record</p>
                  </a>
                </li>
              </ul>
            </li>


          </ul>
        </nav>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Product
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="pn_rev/view/pn_rev.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <p>PN Revision</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="pid/view/pid.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <!-- <i class="fas fa-tasks"></i> -->
                    <p>Product ID</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link menu_list" data-url="pv_kv/view/pv_kv.php">
                    <i class="nav-icon far fa-circle text-success"></i>
                    <!-- <i class="fas fa-tasks"></i> -->
                    <p>PV/KV Label</p>
                  </a>
                </li>
              </ul>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="main_index">


    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong><a href="#">&#169; 2025 PCI Private Limited </a></strong>
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- Data Table -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
  <!-- swal -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Custom Script -->
  <script>
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
    $(document).ready(function() {




      // $('#print_station_name').prop('disabled', false);
      let phpValue = "<?php echo __DIR__; ?>";
      console.log("PHP value:", phpValue);
      let loginSession = "<?php echo $_SESSION['logged_in']; ?>";
      if (loginSession == false) {
        $('#main_sidebar').hide();
        $('#main_index').load('main/view/login/login.php');
      } else {
        $('#main_sidebar').show();
      }

    });
    $(this).parents('.nav-treeview').prev('.nav-link').click();
    $(document).on('click', '.sidebar-search-results .list-group-item', function(e) {
      e.preventDefault();

      const clickedText = $(this).find('.search-title').text().trim().toLowerCase();

      let matched = false;

      $('.menu_list').each(function() {
        const linkText = $(this).find('p').text().trim().toLowerCase();

        if (linkText === clickedText) {
          $(this).trigger('click');
          matched = true;
          return false; // exit each loop
        }
      });

      if (!matched) {
        console.warn("No matching sidebar link found for:", clickedText);
      }
    });

    $(document).on('click', '.menu_list', function(e) {
      e.preventDefault();

      const url = $(this).data('url');

      //  Update active class
      $('.menu_list').removeClass('active');
      $(this).addClass('active');

      if (url) {
        $('#main_index').html('<div class="p-3 text-center">Loading...</div>');

        $('#main_index').load(url, function(response, status, xhr) {
          if (status === "error") {
            $('#main_index').html('<div class="p-3 text-danger">Error loading content: ' + xhr.status + ' ' + xhr.statusText + '</div>');
            console.error("Load failed:", url, xhr.status, xhr.statusText);
          }
        });
      } else {
        console.warn("No data-url found for clicked item.");
      }
    });

    $('#logout').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      $.post('main/route/user.php', {
        action: 'logoutUser'
      }, function(data) {
        if (typeof data.error === 'undefined') {
          Toast.fire({
            icon: 'success',
            title: 'User successfully logout'
          })
          $('#main_sidebar').hide();
          setTimeout(function() {
            window.location.href = "index.php"
          }, 1500);

        } else {
          console.log(data.error);
        }
      }, 'json');
    });
  </script>

</body>

</html>