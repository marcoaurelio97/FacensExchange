<!-- jQuery 3 -->
<script src="<?= site_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= site_url('bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= site_url('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Morris.js charts -->
<script src="<?= site_url('bower_components/raphael/raphael.min.js') ?>"></script>
<script src="<?= site_url('bower_components/morris.js/morris.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?= site_url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap -->
<script src="<?= site_url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?= site_url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= site_url('bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?= site_url('bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?= site_url('bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- datepicker -->
<script src="<?= site_url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= site_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?= site_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= site_url('bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= site_url('dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= site_url('dist/js/pages/dashboard.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= site_url('dist/js/demo.js') ?>"></script>
<!-- fontIconPicker JS -->
<script src="<?= site_url('bower_components/iconpicker/jquery.fonticonpicker.min.js') ?>"></script>
<script src="<?= site_url('dist/js/iconpicker.js') ?>"></script>
<script src="<?= site_url('dist/js/jquery.mask.min.js') ?>"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
  function signOut() {
    debugger;
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      url = "<?= base_url('Login/SignOut/0'); ?>";

      $.post(url, data, function(resp){
        window.location.href = resp.url;
      }, 'json');
    });
  }
</script>

</body>
</html>
