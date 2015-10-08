<?php

function art($id, $hue) {
	include("art.php");
	if($id[0] == 0) { $id = hexdec($id); }
	if($hue[0] == 0) { $hue = hexdec($hue); }
	$file = "images/art/art_".$id."_".$hue.".png";
	if (!file_exists($file))
		createart($id,$hue,0);
	echo "<img src=\"$file\">";
}

function gump($id, $hue) {
	include("gumpart.php");
	if($id[0] == 0) { $id = hexdec($id); }
	if($hue[0] == 0) { $hue = hexdec($hue); }
	$file = "images/gumpart/gumpart_".$id."_".$hue.".png";
	if (!file_exists($file))
		creategumpart($id,$hue,0);
	echo "<img src=\"$file\">";
}

function fixedart($id, $hue) {
	//include("art.php");
	include("fiximg.php");
	if($id[0] == 0) { $id = hexdec($id); }
	if($hue[0] == 0) { $hue = hexdec($hue); }
	$file = "images/art/art_".$id."_".$hue.".png";
	if (!file_exists($file))
		createart($id,$hue,0);
	$file2 = "images/art/fixedart_".$id."_".$hue.".png";
	if (!file_exists($file2))
		fixart($id,$hue,0);
	echo "<img src=\"$file2\">";
}

?>