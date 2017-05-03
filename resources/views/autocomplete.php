<!DOCTYPE html>
<html>
  <head>
  	<title>Laravel Autocomplete</title>
  	<meta charset="utf-8">
  	<link rel="stylesheet" href="../public/css/jquery-ui.min.css" />
    <script src="../public/js/jquery-3.2.1.min.js"></script>
    <script src="../public/js/jquery-ui.min.js"></script>
  </head>
  <body>
    <h2>Laravel Autocomplete</h2>
    <?= Form::open() ?>
    <?= Form::label('auto', 'Find a color: ') ?>
    <?= Form::text('auto', '', array('id' => 'auto')) ?>
    <br>
    <?= Form::label('response', 'Our color key: ') ?>
    <?= Form::text('response', '', array('id' => 'response', 'disabled' => 'disabled')) ?>
    <?= Form::close() ?>

    <script type="text/javascript">
    	$(function() {
    		$("#auto").autocomplete({
    			source: "getdata",
    			minLength: 1,
    			select: function( event, ui ) {
    				$('#response').val(ui.item.id);
    			}
    		});
    	});
    </script>
  </body>
</html>
