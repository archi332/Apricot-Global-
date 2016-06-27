<?php
$name = 'checked';
$value = null;
$expire = time() - (60 * 60 * 24);
setcookie($name, $value, $expire);
header('Location: ' . 'http://artest.loc');