<?php

if (isset($_GET["id"])) {
	$id = $_GET["id"];
	if($id[0] == 0)
		$id = hexdec($id);
	else
		$id = intval($id);
	if (!(isset($_GET["hue"]))) {
		$hue = 0;
	} else {
		$hue = $_GET["hue"];
		if($hue[0] == 0)
			$hue = hexdec($hue);
		else
			$hue = intval($hue);
	}
	creategumpart($id,$hue,1);
	exit;
}

function creategumpart($index,$hue,$show) {
	if(file_exists("images/gumpart/gumpart_".$index."_".$hue.".png")) {
		if($show == 1) {
			Header("Content-type: image/png");
			header("Content-disposition: inline; filename=gumpart_".$index."_".$hue.".png");
			$img = imagecreatefrompng("images/gumpart/gumpart_".$index."_".$hue.".png");
			$black = imagecolorallocate($img, 0, 0, 0);
			imagecolortransparent($img, $black);
			imagepng($img);
			return;
		}
	}

	$mulpath = "./uofiles/";
	$isgump = intval(1);
	$hues = FALSE;
	$tiledata = FALSE;
	$gumpfile = FALSE;
	$gumpindex = FALSE;

	$hues = fopen("{$mulpath}hues.mul", "rb");
	if ($hues == FALSE)
	{
		die("Unable to open hues.mul - ERROR\nDATAEND!");
		exit;
	}

	$tiledata = fopen("{$mulpath}tiledata.mul", "rb");
	if ($tiledata == FALSE)
	{
		fclose($hues);
		die("Unable to open tiledata.mul - ERROR\nDATAEND!");
		exit;
	}

	$gumpfile = fopen("{$mulpath}gumpart.mul", "rb");
	if ($gumpfile == FALSE)
	{
		fclose($hues);
		fclose($tiledata);
		die("Unable to open gumpart.mul - ERROR\nDATAEND!");
		exit;
	}

	$gumpindex = fopen("{$mulpath}gumpidx.mul", "rb");
	if ($gumpindex == FALSE)
	{
		fclose($hues);
		fclose($tiledata);
		fclose($gumpfile);
		die("Unable to open gumpidx.mul - ERROR\nDATAEND!");
		exit;
	}

	if ($hue < 1 || $hue > 65535)
		$hue = 0;

	if($isgump > 0 || $index == 12 || $index == 13)
		$isgump = 1;
	else
		$isgump = 0;

	//if ($index > 0x7FFF || $index <= 0 || $hue > 65535 || $hue < 0) // 0x3FFF
	//	continue;

	if ($isgump == 1) // Male/Female Gumps or IsGump Param
		$gumpid = $index;
	else {
		$group = intval($index / 32);
		$groupidx = $index % 32;
		fseek($tiledata, 512 * 836 + 1188 * $group + 4 + $groupidx * 37, SEEK_SET);
		if (feof($tiledata))
			die();

		// Read the flags
		$flags = read_big_to_little_endian($tiledata, 4);
		if ($flags == -1)
			die();

		if ($flags & 0x404002) { //0x00400000
			fseek($tiledata, 6, SEEK_CUR);
		$gumpid = read_big_to_little_endian($tiledata, 2);
		$gumpid = ($gumpid & 0xFFFF);
		if ($gumpid > 65535 || $gumpid <= 0)
			die(); // Invalid gump ID
		}
		else
			continue; // Not wearable
	}

	LoadRawGump($gumpindex, $gumpfile, intval($gumpid), $hue, $hues, $gumprawdata);
	CreateGump($gumprawdata,$index,$hue);
	fclose($hues);
	fclose($tiledata);
	fclose($gumpfile);
	fclose($gumpindex);
	if($show == 1) {
		Header("Content-type: image/png");
		header("Content-disposition: inline; filename=gumpart_".$index."_".$hue.".png");
		$img = imagecreatefrompng("images/gumpart/gumpart_".$index."_".$hue.".png");
		$black = imagecolorallocate($img, 0, 0, 0);
		imagecolortransparent($img, $black);
		imagepng($img);
		imagedestroy($img);
	}
	return;
}

function LoadRawGump($gumpindex, $gumpfile, $index, $hue, $hues, &$gumprawdata) {
	$send_data = '';
	$color32 = array();
	fseek($gumpindex, $index * 12, SEEK_SET);
	if (feof($gumpindex))
		return; // Invalid gumpid, reached end of gumpindex.
	$lookup = read_big_to_little_endian($gumpindex, 4);
	if ($lookup == -1) {
		if ($index >= 60000)
			$index -= 10000;
		fseek($gumpindex, $index * 12, SEEK_SET);
		if (feof($gumpindex)) // Invalid gumpid, reached end of gumpindex.
			return;
		$lookup = read_big_to_little_endian($gumpindex, 4);
		if ($lookup == -1)
			return; // Gumpindex returned invalid lookup.
	}
	$gsize = read_big_to_little_endian($gumpindex, 4);
	$gextra = read_big_to_little_endian($gumpindex, 4);
	fseek($gumpindex, $index * 12, SEEK_SET);
	$gwidth = (($gextra >> 16) & 0xFFFF);
	$gheight = ($gextra & 0xFFFF);
	$send_data .= sprintf("Lookup: %d\n", $lookup);
	$send_data .= sprintf("Size: %d\n", $gsize);
	$send_data .= sprintf("Height: %d\n", $gheight);
	$send_data .= sprintf("Width: %d\n", $gwidth);
	InitializeGump($gumprawdata, $gwidth, $gheight);
	if ($gheight <= 0 || $gwidth <= 0)
		return; // Gump width or height was less than 0.
	fseek($gumpfile, $lookup, SEEK_SET);
	$heightTable = read_big_to_little_endian($gumpfile, ($gheight * 4));
	if (feof($gumpfile))
		return; // Invalid gumpid, reached end of gumpfile.
	$send_data .= sprintf("DATASTART:\n");
	if ($hue <= 0) {
		for ($y = 1; $y < $gheight; $y++) {
			fseek($gumpfile, $heightTable[$y] * 4 + $lookup, SEEK_SET);
			// Start of row
			$x = 0;
			while ($x < $gwidth) {
				$rle = read_big_to_little_endian($gumpfile, 4);  // Read the RLE data
				$length = ($rle >> 16) & 0xFFFF;  // First two bytes - how many pixels does this color cover
				$color = $rle & 0xFFFF;  // Second two bytes - what color do we apply
				// Begin RGB value decoding
				$r = (($color >> 10)*8);
				$g = (($color >> 5) & 0x1F)*8;
				$b = ($color & 0x1F)*8;
				if ($r > 0 || $g > 0 || $b > 0)
					$send_data .= sprintf("%d:%d:%d:%d:%d:%d***", $x, $y, $r, $g, $b, $length);
				$x = $x + $length;
			}
		}
	} else { // We are using the hues.mul
		$hue = $hue - 1;
		$orighue = $hue;
		if ($hue > 0x8000)
			$hue = $hue - 0x8000;
		if ($hue > 3001) // Bad hue will cause a crash
			$hue = 1;
		$colors = intval($hue / 8) * 4;
		$colors = 4 + $hue * 88 + $colors;
		fseek($hues, $colors, SEEK_SET);
		for ($i = 0; $i < 32; $i++) {
			$color32[$i] = read_big_to_little_endian($hues, 2);
			$color32[$i] |= 0x8000;
		}
		for ($y = 1; $y < $gheight; $y++) {
			fseek($gumpfile, $heightTable[$y] * 4 + $lookup, SEEK_SET);
			// Start of row
			$x = 0;
			while ($x < $gwidth) {
				$rle = read_big_to_little_endian($gumpfile, 4);  // Read the RLE data
				$length = ($rle >> 16) & 0xFFFF;  // First two bytes - how many pixels does this color cover
				$color = $rle & 0xFFFF;  // Second two bytes - what color do we apply
				// Begin RGB value decoding
				$r = (($color >> 10));
				$g = (($color >> 5) & 0x1F);
				$b = ($color & 0x1F);
				// Check if we're applying a special hue (skin hues), if so, apply only to grays
				if (($orighue > 0x8000) && ($r == $g && $r == $b)) {
					$newr = (($color32[$r] >> 10))*8;
					$newg = (($color32[$r] >> 5) & 0x1F)*8;
					$newb = ($color32[$r] & 0x1F)*8;
				} else if ($orighue > 0x8000) {
					$newr = $r * 8;
					$newg = $g * 8;
					$newb = $b * 8;
				} else {
					$newr = (($color32[$r] >> 10))*8;
					$newg = (($color32[$r] >> 5) & 0x1F)*8;
					$newb = ($color32[$r] & 0x1F)*8;
				}
				if((($r * 8) > 0) || (($g * 8) > 0) || (($b * 8) > 0))
					$send_data .= sprintf("%d:%d:%d:%d:%d:%d***", $x , $y, $newr, $newg, $newb, $length);
				$x += $length;
			}
		}
	}
	$send_data .= sprintf("DATAEND!");
	add_gump($send_data, $gumprawdata);
}

function read_big_to_little_endian($file, $length) {
	if (($val = fread($file, $length)) == FALSE)
		return -1;

	switch($length)
	{
		case 4: $val = unpack('l', $val); break;
		case 2: $val = unpack('s', $val); break;
		case 1: $val = unpack('c', $val); break;
		default: $val = unpack('l*', $val); return $val;
	}
	return ($val[1]);
}

function add_gump($read, &$img) {
	if (strpos($read, "ERROR"))
		return;

	$data = explode("DATASTART:\n", $read);
	$data = $data[1];
	$newdata = explode("***", $data);
	while (list($key, $val) = @each($newdata)) {
		if ($val == "DATAEND!")
			break;
		$val = explode(":", $val);
		$x = intval($val[0]) + 8;
		$y = intval($val[1]) + 15;
		$r = intval($val[2]);
		$g = intval($val[3]);
		$b = intval($val[4]);
		$length = intval($val[5]); // pixel color repeat length
		if ($r || $g || $b) {
			$col = imagecolorallocate($img, $r, $g, $b);
			for ($i = 0; $i < $length; $i++)
				imagesetpixel($img, $x+$i, $y, $col);
		}
	}
}

function InitializeGump(&$img, $width, $height) {
	$img = imagecreatetruecolor($width, $height);
	$almostblack = imagecolorallocate($img,0,0,0);
	imagefill($img,0,0,$almostblack); 
	$black = imagecolorallocate($img, 0, 0, 0);
	imagecolortransparent($img, $black);
	imagealphablending($img, true);
	imageSaveAlpha($img, true);
}

function CreateGump(&$img,$index,$hue) {
	imagepng($img,"images/gumpart/gumpart_".$index."_".$hue.".png",0,NULL);
	imagedestroy($img);
}

?>