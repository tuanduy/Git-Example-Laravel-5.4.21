<h1>File Upload</h1>
<?php $messages =  $errors->all('<p style="color:red">:message</p>') ?>
<?php
foreach ($messages as $msg)
{
    echo $msg;
}
?>
<?= Form::open(array('files' => TRUE)) ?>
<?= Form::label('myfile', 'My File (Word or Text doc)') ?>
<br>
<?= Form::file('myfile') ?>
<br>
<?= Form::submit('Send it!') ?>
<?= Form::close() ?>