<?php
include('data_base.php');

$data_base = new data_base();

$res = mysqli_query($data_base->connectBD(), $data_base->loadMess());







while($d = mysqli_fetch_assoc($res))
{
	$color = $d['name'] == $_COOKIE['checked'] ? 'blue' : 'red';
	echo  "<font color = $color>" . $d['name'] . '</font> : ' . $d['text_message']."<hr />";
}
?>