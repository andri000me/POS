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
<script src="{{ baseUrl('assets/dist/plugins/datatables-select/js/dataTables.select.js')}}"></script>
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