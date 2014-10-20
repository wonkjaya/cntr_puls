<?php
echo $err;
echo form_open('');
echo form_input('new_username','');
echo form_password('new_password','');
echo form_submit('submit','Register');
echo form_close();

?>
