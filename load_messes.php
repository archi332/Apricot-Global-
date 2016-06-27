<?php
include('data_base.php');

$data_base = new data_base();

$res = mysqli_query($data_base->connectBD(), $data_base->loadMess());

while($d = mysqli_fetch_assoc($res))
{
	echo $d['name'] . ' : ' . $d['text_message']."<hr />";
}
?>