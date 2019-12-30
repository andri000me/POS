<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="{{ baseUrl('assets/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ baseUrl('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/moment.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootbox.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootstrap-notify.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootstrap-select.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootstrap-selectpicker.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/jquery.mask.js')}}"></script>
<script src="{{ baseUrl('assets/dist/plugins/all/js/jasny-bootstrap.min.js')}}"></script>
<script src="{{ baseUrl('assets/dist/js/app.js')}}"></script>

{{-- <!-- <script src="{{ baseUrl('assets/bootstrapdashboard/vendor/jquery/jquery.min.js')}}"></script> --> --}}
{{-- <script src="{{ baseUrl('assets/js/popper.min.js')}}"></script>
<script src="{{ baseUrl('assets/js/app.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/bootstrap-select.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/moment.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/bootstrap-datepicker.id.min.js')}}"></script> --}}
{{-- <!-- <script src="{{ baseUrl('assets/bootstrapdashboard/js/file/custom-file-input.js')}}"></script> --> --}}
{{-- <script src="{{ baseUrl('assets/bootstrapdashboard/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{ baseUrl('assets/bootstrapdashboard/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/moment.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/jquery.mask.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/jasny-bootstrap.min.js')}}"></script>
<script src="{{ baseUrl('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/summernote-bs4.min.js')}}"></script> --}}
<!-- Main File-->
{{-- <script src="{{ baseUrl('assets/bootstrapdashboard/js/front.js')}}"></script> --}}
<!-- <script src="https://www.gstatic.com/firebasejs/6.6.2/firebase.js"></script> -->
{{-- <script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-messaging.js"></script>
<script src="{{ baseUrl('assets/js/firebaseclient.js')}}"></script>
<script src="{{ baseUrl('assets/js/firebase-messaging-sw.js')}}"></script> --}}
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
 
</script>
<script>
    // $('.summernote').summernote();
    $('.selectpicker').selectpicker({
      style: 'btn-primary'
    });
  </script>
  <script>
    $('.time').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: 'fa fa-angle-double-left',
        next: 'fa fa-angle-double-right',
      },
      format: 'HH:mm'
    });
  
    $('.datetimepicker').datetimepicker({
      icons: {
        time: "fas fa-clock",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
      },
      format: 'DD-MM-YYYY HH:mm'
    });
  
    $('.date').datetimepicker({
      icons: {
        time: "fas fa-clock",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
      },
      format: 'DD-MM-YYYY'
    });
  
    $('.datepicker').datepicker({
      language: 'id',
      format: "dd-mm-yyyy"
    });
  
  
    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
  
  
    $('.yearperiod').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years"
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(e) {
  
    })
  
    function setNotification(message, title, position = "bottom", align = "right") {
  
      if (title == 1) {
        var titlestr = "WARNING";
        var type = "warning";
      } else if (title == 2) {
        var titlestr = "SUCCESS";
        var type = "success";
      } else if (title == 3) {
        var titlestr = "DANGER";
        var type = "danger";
      } else {
        var titlestr = "INFO";
        var type = "info";
      }
  
      $.notify({
        title: titlestr + " : ", 
        message: message 
      }, {
        element: 'body',
        position: null,
        type: type,
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
          from: position,
          align: align
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: 'pause',
        animate: {
          enter: 'animated fadeInRight',
          exit: 'animated fadeOutRight'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<span data-notify="icon"></span> ' +
          '<span data-notify="title"><b>{1}</b></span> ' +
          '<span data-notify="message">{2}</span>' +
          '<div class="progress" data-notify="progressbar">' +
          '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
          '</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
          '</div>'
      });
    }
  
    function deleteData(name, callback) {
      bootbox.confirm({
        message: "Hapus " + name + " ?",
        buttons: {
          cancel: {
            label: "CANCEL"
          },
          confirm: {
            label: "CONFIRM"
          }
        },
        callback: function(result) {
          callback(result);
        }
      });
    }
  
    function makeAlert(message, size = "") {
      bootbox.alert({
        message: message,
        backdrop: true,
        size: size
      });
    }
  </script>
  <script>
    $('.transnumberformat').inputmask({
      mask: 'aaa/{YYYY}{MM}/9'
    });
  
    $('.itemdimention').inputmask({
      mask: '99 x 99 x 99'
    });
  
  
  
    $('.money').mask('000.000.000.000.000,00', {
      reverse: true
    });
    $('.money2').mask("#.##0,00", {
      reverse: true
    });
    $('.percent').mask('##0,00 %', {
      reverse: true
    });
  </script>
  

  <script>
      <?php 
        if(Core\Session::isFlashExist('success_msg')){
          $msg = Core\Session::getFlash('success_msg');
          for ($i = 0; $i < count($msg); $i++) {
        ?>
          setNotification("{{ $msg[$i] }}", 2, "bottom", "right");
        <?php
          }
        }
      ?>

      <?php 
        if(Core\Session::isFlashExist('add_warning_msg')){
          $msg = Core\Session::getFlash('add_warning_msg');
          for ($i = 0; $i < count($msg); $i++) {
        ?>
          setNotification("{{ $msg[$i] }}", 3, "bottom", "right");
        <?php
          }
        }
      ?>

      <?php 
        if(Core\Session::isFlashExist('edit_warning_msg')){
          $msg = Core\Session::getFlash('edit_warning_msg');
          for ($i = 0; $i < count($msg); $i++) {
        ?>
          setNotification("{{ $msg[$i] }}", 3, "bottom", "right");
        <?php
          }
        }
      ?>
  </script>

</body>

</html>