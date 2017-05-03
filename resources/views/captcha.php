<h1>Laravel Captcha</h1>
<?php
if (Session::get('captcha_result')) {
echo '<h2>' . Session::get('captcha_result') . '</h2>';
}
?>
<?php echo Form::open() ?>
<?php echo Form::label('captcha', 'Type these letters:') ?>
<br>
<img src="<?php echo $cap ?>">
<br>
<?php echo Form::text('captcha') ?>
<br>
<?php echo Form::submit('Verify!') ?>
<?php echo Form::close() ?>
