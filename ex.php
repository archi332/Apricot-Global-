<?php
$url = 'http://' . $_SERVER['HTTP_HOST'];

$name = 'checked';
$value = null;
$expire = time() - (60 * 60 * 24);
setcookie($name, $value, $expire);
header('Location: ' . $url);