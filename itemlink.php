<?php
define('IN_MYBB', 1);
require_once ("./global.php");

if(isset($_GET['id'])) $id = $_GET['id'];
unset($_GET['id']);

$sql = mysql_query("SELECT * FROM dbsphere.items WHERE DEFNAME='$id'");
while($item = mysql_fetch_array($sql)) {
fixart($item['ID'],$item['COLOR'],1);
}

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
	if(!(file_exists("images/art/art_".$id."_".$hue.".png")))
	{
		include("art.php");
		createart($id,$hue,0);
	}
	if(!(file_exists("images/art/fixedart_".$id."_".$hue.".png")))
		fixart($id,$hue,1);
	else {
		Header("Content-type: image/png");
		Header("Content-disposition: inline; filename=art_".$id."_".$hue.".png");
		$img = imagecreatefrompng("images/art/fixedart_".$id."_".$hue.".png");
		$black = imagecolorallocate($img, 0, 0, 0);
		imagecolortransparent($img, $black);
		imagepng($img);
		imagedestroy($img);
	}
	exit;
}

function fixart($id,$hue,$show) {
	if(!(file_exists("images/art/fixedart_".$id."_".$hue.".png")))
	{
		if(!(file_exists("images/art/art_".$id."_".$hue.".png")))
		{
			include("art.php");
			createart($id,$hue,0);
		}
		$imgurl = "images/art/art_".$id."_".$hue.".png";
		$img = imagecreatefrompng("$imgurl");
		$box = imageTrimBox($img);
		$img2 = imagecreatetruecolor($box['w'], $box['h']);
		imagecopy($img2, $img, 0, 0, $box['l'], $box['t'], $box['w'], $box['h']);
		imagepng($img2,'images/art/fixedart_'.$id.'_'.$hue.'.png',0,NULL);
		imagedestroy($img);
		imagedestroy($img2);
	}
	if($show == 1) {
		Header("Content-type: image/png");
		Header("Content-disposition: inline; filename=art_".$id."_".$hue.".png");
		$img = imagecreatefrompng("images/art/fixedart_".$id."_".$hue.".png");
		$black = imagecolorallocate($img, 0, 0, 0);
		imagecolortransparent($img, $black);
		imagepng($img);
		imagedestroy($img);
		return;
	}
}

function imageTrimBox($img, $hex=null) {
	if (!ctype_xdigit($hex)) { $hex = imagecolorat($img, 0,0); }
	$b_top = $b_lft = 0;
	$b_rt = $w1 = $w2 = imagesx($img);
	$b_btm = $h1 = $h2 = imagesy($img);
	do {
		//top
		for(; $b_top < $h1; ++$b_top) {
			for($x = 0; $x < $w1; ++$x) {
				if(imagecolorat($img, $x, $b_top) != $hex) {
					break 2;
				}
			}
		}
		// stop if all pixels are trimmed
		if ($b_top == $b_btm) {
			$b_top = 0;
			$code = 2;
			break 1;
		}
		// bottom
		for(; $b_btm >= 0; --$b_btm) {
			for($x = 0; $x < $w1; ++$x) {
				if(imagecolorat($img, $x, $b_btm-1) != $hex) {
					break 2;
				}
			}
		}
		// left
		for(; $b_lft < $w1; ++$b_lft) {
			for($y = $b_top; $y <= $b_btm; ++$y) {
				if(imagecolorat($img, $b_lft, $y) != $hex) {
					break 2;
				}
			}
		}
		// right
		for(; $b_rt >= 0; --$b_rt) {
			for($y = $b_top; $y <= $b_btm; ++$y) {
				if(imagecolorat($img, $b_rt-1, $y) != $hex) {
					break 2;
				}
			}
		}
		$w2 = $b_rt - $b_lft;
		$h2 = $b_btm - $b_top;
		$code = ($w2 < $w1 || $h2 < $h1) ? 1 : 0;
	} while (0);
	// result codes:
	// 0 = Trim Zero Pixels
	// 1 = Trim Some Pixels
	// 2 = Trim All Pixels
	return array(
		'#'     => $code,   // result code
		'l'     => $b_lft,  // left
		't'     => $b_top,  // top
		'r'     => $b_rt,   // right
		'b'     => $b_btm,  // bottom
		'w'     => $w2,     // new width
		'h'     => $h2,     // new height
		'w1'    => $w1,     // original width
		'h1'    => $h1,     // original height
	);
}


?>