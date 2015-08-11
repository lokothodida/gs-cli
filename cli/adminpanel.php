<div id="terminal"></div>

<script src="<?php echo $js['jquery.terminal']; ?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $css['jquery.terminal']; ?>"/>
<script>
(function($) {
  $(function() {
    $('#terminal').terminal(function(command, term) {
      console.log(arguments);
      var args = command.match(/(?:[^\s"]+|"[^"]*")+/g);
      console.log(args);
      var cmd = args.shift();
      
      $.ajax({
        method: 'post',
        url: '<?php echo $adminurl . 'api.php' ;?>',
        data: { cmd: cmd, args: args }
      })
      .then(function(response) {
        var data = JSON.parse(response);
        term.echo(data.echo);
      })
      .always(function() {
        console.log(arguments);
      });
    }, {
        greetings: <?php echo json_encode($this->i18n('PLUGIN_TITLE')); ?>,
        name: 'js_demo',
        height: 200,
        prompt: 'getsimple> '
    });
  });
})(jQuery);
</script>