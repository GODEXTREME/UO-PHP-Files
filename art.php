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
	if($_SERVER['SCRIPT_NAME'] == '/art.php')
		createart($id,$hue,1);
	else
		createart($id,$hue,0);
	return;
}

function createart($id,$hue,$show) {
	if(file_exists("images/art/art_".$id."_".$hue.".png")) {
		if($show == 1) {
			Header("Content-type: image/png");
			Header("Content-disposition: inline; filename=art_".$id."_".$hue.".png");
			$img = imagecreatefrompng("images/art/art_".$id."_".$hue.".png");
			$black = imagecolorallocate($img, 0, 0, 0);
			imagecolortransparent($img, $black);
			imagepng($img);
			return;
		}
		//return;
	}

	$oldhue = $hue;
	$mulpath = "./uofiles/";
	$hue = hex($hue);
	$id = hex($id);
	$id += 0x4000;
	$hues = FALSE;
	$tiledata = FALSE;
	$gumpindex = FALSE;
	$gumpfile = FALSE;

	//open files for reading
	//**********************
	if ($hue < 1 || $hue > 65535) {
		//If invalid or missing hue, unset hue and don't read hues.mul and tiledata.mul
		$hue = 0;
	} else {
		//If valid hue, read hues.mul and tiledata.mul
		$hues = fopen("{$mulpath}hues.mul", "rb");
		if ($hues == FALSE)
			$hue = 0;
		$tiledata = fopen("{$mulpath}tiledata.mul", "rb");
		if ($tiledata == FALSE)
			$hue = 0;
		else {
			$index = $id-0x4000;
			$group = intval($index / 32);
			$groupidx = $index % 32;
			fseek($tiledata, 512 * 836 + 1188 * $group + 4 + $groupidx * 37, SEEK_SET);
			$tileflag = read_byte($tiledata, 4);
			if ($tileflag & 0x00040000)
				$partialhue = 1;
			else
				$partialhue = 0;
			fclose($tiledata);
		}
	}

	//Read artidx.mul
	$gumpindex = fopen("{$mulpath}artidx.mul", "rb");
	if ($gumpindex == FALSE) {
		unavailable_pic();
		exit;
	} else {
		fseek($gumpindex, $id * 12, SEEK_SET);
		$lookup = read_byte($gumpindex, 4);
		$size = read_byte($gumpindex, 4);
		fclose($gumpindex);
	}

	//Read art.mul
	$gumpfile = fopen("{$mulpath}art.mul", "rb");
	if ($gumpfile == FALSE) {
		unavailable_pic();
		exit;
	} else {
		fseek($gumpfile, $lookup, SEEK_SET);
		$flag = read_byte($gumpfile, 4);
		$width = read_byte($gumpfile, 2);
		$height = read_byte($gumpfile, 2);

		//create base image
		//**********************
		$im = imagecreatetruecolor($width, $height);
		$almostblack = imagecolorallocate($im,0,0,0);
		imagefill($im,0,0,$almostblack); 
		$black = imagecolorallocate($im, 0, 0, 0);
		imagecolortransparent($im, $black);
		imagealphablending($im, true);
		imageSaveAlpha($im, true);

		//Read pixels
		//**********************
		for($i=0; $i < $height; $i++)
			$offset[$i] = read_byte($gumpfile, 2);
		$datastart = ftell($gumpfile);
		$x = 0;
		$y = 0;

		//Display without hues
		//**********************
		if ($hue <= 0) {	
			while ( $y < $height ) {
				$xOffset = read_byte($gumpfile, 2);
				$xRun = read_byte($gumpfile, 2);
				if ( ($xRun + $xOffset) > 2048 )
					break;
				else {
					if ( ( $xRun + $xOffset ) != 0 ) {
						$x += $xOffset;
						for($Run = 0; $Run < $xRun; $Run++) {
							$color[$Run] = read_byte($gumpfile, 2);
							$r = (($color[$Run] >> 10)*8);
							$g = ((($color[$Run] >> 5) & 0x1F)*8);
							$b = (($color[$Run] & 0x1F)*8);
							if (imagecolorexact($im, $r, $g, $b) == -1) {
								$col = imageColorAllocate($im, $r, $g, $b);
								imagesetpixel($im, $x, $y, $col);
							} else {
								$found = imagecolorexact($im, $r, $g, $b);
								imagesetpixel($im, $x, $y, $found);
							}
							$x++;
						}
					} else {
						$x = 0;
						$y++;
						if(isset($offset[$y]))
							fseek($gumpfile, $offset[$y] * 2 + $datastart, SEEK_SET);
					}
				}
			}
		}
		//Display with hues
		//**********************
		else {
			$hue = $hue - 1;
			$orighue = $hue;
			if ($hue > 0x8000)
				$hue = $hue - 0x8000;
			if ($hue > 3001)
				$hue = 1;
			$colors = intval($hue / 8) * 4;
			$colors = 4 + $hue * 88 + $colors;
			fseek($hues, $colors, SEEK_SET);
			for ($i = 0; $i < 32; $i++) {
				$color32[$i] = read_byte($hues, 2);
				$color32[$i] |= 0x8000;
			}
			while ( $y < $height ) {
				$xOffset = read_byte($gumpfile, 2);
				$xRun = read_byte($gumpfile, 2);
				if ( ($xRun + $xOffset) > 2048 )
					break;
				else {
					if ( ( $xRun + $xOffset ) != 0 ) {
						$x += $xOffset;
						for($Run = 0; $Run < $xRun; $Run++) {
							$color[$Run] = read_byte($gumpfile, 2);
							$r = ($color[$Run] >> 10);
							$g = (($color[$Run] >> 5) & 0x1F);
							$b = ($color[$Run] & 0x1F);
							if (($partialhue == 1) && ($r == $g && $r == $b)) {
								$newr = (($color32[$r] >> 10))*8;
								$newg = (($color32[$r] >> 5) & 0x1F)*8;
								$newb = ($color32[$r] & 0x1F)*8;
							} else if ($partialhue == 1) {
								$newr = $r * 8;
								$newg = $g * 8;
								$newb = $b * 8;
							} else {
								$newr = (($color32[$r] >> 10))*8;
								$newg = (($color32[$r] >> 5) & 0x1F)*8;
								$newb = ($color32[$r] & 0x1F)*8;
							}
							if (imagecolorexact($im, $newr, $newg, $newb) == -1) {
								$col = imageColorAllocate($im, $newr, $newg, $newb);
								imagesetpixel($im, $x, $y, $col);
							} else {
								$found = imagecolorexact($im, $newr, $newg, $newb);
								imagesetpixel($im, $x, $y, $found);
							}
							$x++;
						}
					} else {
						$x = 0;
						$y++;
						if(isset($offset[$y]))
							fseek($gumpfile, $offset[$y] * 2 + $datastart, SEEK_SET);
					}
				}
			}
			fclose($hues);
		}
	}
	fclose($gumpfile);
	$index = $id-0x4000;
	if(hexdec($oldhue) > 0)
		$hue = $hue + 1;
	imagepng($im,"images/art/art_".$index."_".$hue.".png",0,NULL);
	imagedestroy($im);
	if($show == 1) {
		Header("Content-type: image/png");
		Header("Content-disposition: inline; filename=art_".$id."_".$hue.".png");
		$img = imagecreatefrompng("images/art/art_".$index."_".$hue.".png");
		$black = imagecolorallocate($img, 0, 0, 0);
		imagecolortransparent($img, $black);
		imagepng($img);
		imagedestroy($img);
	}
	return;
}

function read_byte($file, $length) {
	if (($val = fread($file, $length)) == FALSE)
		return -1;

	switch($length)
	{
		case 4: $val = unpack('l', $val); break;
		case 2: $val = unpack('s', $val); break;
		case 1: $val = unpack('c', $val); break;
		default: $val = unpack('l*', $val);
		return $val;
	}
	return ($val[1]);
}

function  unavailable_pic() {
	$im = imagecreatetruecolor(44, 47);
	$black = imageColorAllocate($im, 0, 0, 0);
	$red = imageColorAllocate($im, 255, 0, 0);
	imagefill($im, $black);
	imagettftext($im, 8, 315, 0, 7, $red, 'arial.ttf', 'Unavailable');
	imagepng($im);
	imagedestroy($im);
}

function  hex($number) {
	if (strlen($number) > 1) {
		if (substr($number, 0, 1) == 0)
			$number = str_pad(substr($number, 1), strlen($number)+2, "0x", STR_PAD_LEFT);
	}
	return ($number);
}

?>