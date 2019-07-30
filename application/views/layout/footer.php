<script src="<?= base_url('assets/js/materialize/materialize.js') ?>"></script>
<script src="<?= base_url('assets/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/alert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/js/script.js') ?>"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
 <script>

    Pusher.logToConsole = true;

    var pusher = new Pusher('6e49ca7b930fac5e00f3', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      if (data.message == 'success') {
          $('.badge').append(data.user);
      }
    });

</script>
</body>

</html>