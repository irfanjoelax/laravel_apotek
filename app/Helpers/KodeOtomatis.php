<?php

function kode_otomatis($result,$char) {

	$noUrut = (int)substr($result, 7, 7);

	$noUrut++;

	$newID  = $char. sprintf("%07s", $noUrut);

	return $newID;
}
?>