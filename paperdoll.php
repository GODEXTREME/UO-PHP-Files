<?php
/*
    The paperdoll generator is based on GumpReader PHP by Kinetix <webmaster@ikrontik.tk>.
    The below copyright information applies to his portions of this script.
*/

/*
* GumpReader PHP 1.1.0
* Author: Kinetix <webmaster@ikrontik.tk>
*
* This has been directly translated from my C program that does the exact same thing. So excuse the messiness.
*
* IF YOU REDISTRIBUTE THIS FILE WITHIN ANOTHER PACKAGE (such as MyUO), YOU MUST FIRST HAVE MY PERMISSION
* AND MUST GIVE ME CREDIT WHERE IT IS DUE! Do _not_ claim someone else's work for yourself.
*
* Released under The MIT License
    Copyright (c) 2004 Kinetix
    Permission is hereby granted, free of charge, to any person obtaining a copy of this
      software and associated documentation files (the "Software"), to deal in the Software
      without restriction, including without limitation the rights to use, copy, modify, merge,
      publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
      to whom the Software is furnished to do so, subject to the following conditions:
    All copyright notices and this permission notice shall be included in all copies or substantial
      portions of the Software and must remain unmodified.
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING
      BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
      NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
      DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
      OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// EQUAL TO ALL FILES ******************************* //
/* require("myrunuo.inc.php"); */
//require($dbfile);
// ************************************************** //

//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );

/* check_get($id, "id");
$id = intval($id);
if (!$id)
  die();

if (!empty($validhosts)) {
  if (isset($_SERVER["HTTP_REFERER"]))
    $ref = strtolower($_SERVER["HTTP_REFERER"]);
  else
    $ref = "";   
  $validhosts = strtolower($validhosts);
  $vhosts = explode(" ", $validhosts);
  $host = 0;
  $valid = false;
  while (isset($vhosts[$host]) && !$valid) {
  	if (substr($ref, 0, strlen($vhosts[$host])) == $vhosts[$host])
  	  $valid = true;
  	$host++;
  }
  if (!$valid)
    die();
} */

define('IN_MYBB', 1);
require_once ("./global.php");

if(!isset($_GET['id']))
{
	echo "bla";
	die();
}
$id = $_GET['id'];
unset($_GET['id']);
$mulpath = "./uofiles/";

$result = mysql_query("SELECT char_nototitle,char_female,char_bodyhue FROM dbsphere.characters WHERE char_id=$id");
if (!(list($nametitle,$charfemale,$charbodyhue) = mysql_fetch_row($result)))
  die();
mysql_free_result($result);

// Insert body into variables
if ($charfemale) {
  $indexA = "13";
  $femaleA = "1";
}
else {
  $indexA = "12";
  $femaleA = "0";
}
$hueA = $charbodyhue;
$isgumpA = "1";

$result = mysql_query("SELECT item_id,item_hue,layer_id FROM dbsphere.characters_layers WHERE char_id=$id ORDER BY  sequence ASC");// ORDER BY layer_id");
$items = array(array());
$num = $dosort = 0;
$remover = 0;
while ($row = mysql_fetch_row($result)) {
  $items[0][$num] = $row[0];
  $items[1][$num] = $row[1];
  $items[2][$num++] = $row[2];
}

for($i = 0; $i < $num; $i++) {
 //if ($items[2][$i] == 1) $hand1 = $i;
 //if ($items[2][$i] == 2) $hand2 = $i;
 if ($items[2][$i] == 3) $shoes = $i;
 if ($items[2][$i] == 4) $pants = $i;
 //if ($items[2][$i] == 5) $shirt = $i;
 if ($items[2][$i] == 6) $helm = $i;
 //if ($items[2][$i] == 7) $gloves = $i;
 //if ($items[2][$i] == 8) $ring = $i;
 //if ($items[2][$i] == 9) $talisman = $i;
 //if ($items[2][$i] == 10) $collar = $i;
 //if ($items[2][$i] == 11) $hair = $i;
 //if ($items[2][$i] == 12) $half_apron = $i;
 if ($items[2][$i] == 13) $chest = $i;
 //if ($items[2][$i] == 14) $wrist = $i;
 //if ($items[2][$i] == 16) $beard = $i;
 //if ($items[2][$i] == 17) $tunic = $i;
 //if ($items[2][$i] == 18) $ears = $i;
 if ($items[2][$i] == 19) $arms = $i;
 //if ($items[2][$i] == 20) $cape = $i;
 if ($items[2][$i] == 22) $robe = $i;
 //if ($items[2][$i] == 23) $skirt = $i;
 if ($items[2][$i] == 24) $legs = $i;
}
if(isset($robe)) {
 if(isset($arms)) {
  for ($i = $arms; $i < $num-1; $i++) {
   $items[0][$i] = $items[0][$i+1];
   $items[1][$i] = $items[1][$i+1];
   $items[2][$i] = $items[2][$i+1];
  }
  $num--;
  unset($arms);
 }
 if(isset($chest)) {
  for ($i = $chest; $i < $num-1; $i++) {
   $items[0][$i] = $items[0][$i+1];
   $items[1][$i] = $items[1][$i+1];
   $items[2][$i] = $items[2][$i+1];
  }
  $num--;
  unset($chest);
 }
}
if(isset($legs)) {
 if(isset($pants)) {
  for ($i = $pants; $i < $num-1; $i++) {
   $items[0][$i] = $items[0][$i+1];
   $items[1][$i] = $items[1][$i+1];
   $items[2][$i] = $items[2][$i+1];
  }
  $num--;
  unset($pants);
 }
 if(isset($shoes)) {
  for ($i = $shoes; $i < $num-1; $i++) {
   $items[0][$i] = $items[0][$i+1];
   $items[1][$i] = $items[1][$i+1];
   $items[2][$i] = $items[2][$i+1];
  }
  $num--;
  unset($shoes);
 }
}
unset($hand1);
unset($hand2);
unset($shoes);
unset($pants);
unset($shirt);
unset($helm);
unset($gloves);
unset($ring);
unset($talisman);
unset($collar);
unset($hair);
unset($half_apron);
unset($chest);
unset($wrist);
unset($beard);
unset($tunic);
unset($ears);
unset($arms);
unset($cape);
unset($robe);
unset($skirt);
unset($legs);

mysql_free_result($result);

// se tiver chest, ele faz esse filtro ai.. se botar em ordem, olha oq acontece HAUISHUIAHSUIHA entendi
//if ($dosort)
//  array_multisort($items[2], SORT_ASC, SORT_NUMERIC, $items[0], SORT_ASC, SORT_NUMERIC, $items[1], SORT_ASC, SORT_NUMERIC);

for ($i = 0; $i < $num; $i++) {
  // Insert items into variables
  $indexA .= ",".$items[0][$i];
  $hueA .= ",".$items[1][$i];
  if ($charfemale)
    $femaleA .= ",1";
  else
    $femaleA .= ",0";
  $isgumpA .= ",0";
}

// Paperdoll Graphic Area
$width = 182;
$height = 237;

if (strpos($indexA, ",")) {
  $indexA = explode(",", $indexA);
  $femaleA = explode(",", $femaleA);
  $hueA = explode(",", $hueA);
  $isgumpA = explode(",", $isgumpA);
}
else {
  $indexA = array($indexA);
  $femaleA = array($femaleA);
  $hueA = array($hueA);
  $isgumpA = array($isgumpA);
}

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

InitializeGump($gumprawdata, $width, $height);
for ($i = 0; $i < sizeof($indexA); $i++)
{
  $index = intval($indexA[$i]);
  $female = intval($femaleA[$i]);
  $hue = intval($hueA[$i]);
  $isgump = intval($isgumpA[$i]);

  if ($female >= 1)
    $female = 1;
  else
    $female = 0;

  if ($hue < 1 || $hue > 65535)
    $hue = 0;

  if($isgump > 0 || $index == 12 || $index == 13)
    $isgump = 1;
  else
    $isgump = 0;

  if ($index > 0x7FFF || $index <= 0 || $hue > 65535 || $hue < 0) // 0x3FFF
    continue;

  if ($isgump == 1) // Male/Female Gumps or IsGump Param
    $gumpid = $index;
  else {
    $group = intval($index / 32);
    $groupidx = $index % 32;
    fseek($tiledata, 512 * 836 + 1188 * $group + 4 + $groupidx * 37, SEEK_SET);
    if (feof($tiledata))
      continue;

    // Read the flags
    $flags = read_big_to_little_endian($tiledata, 4);
    if ($flags == -1)
      continue;

    if ($flags & 0x404002) { //0x00400000
      fseek($tiledata, 6, SEEK_CUR);
      $gumpid = read_big_to_little_endian($tiledata, 2);
      $gumpid = ($gumpid & 0xFFFF);
      if ($gumpid > 65535 || $gumpid <= 0)
        continue; // Invalid gump ID

      if ($gumpid < 10000) {
        if ($female == 1)
          $gumpid += 60000;
        else
          $gumpid += 50000;
      }
    }
    else
      continue; // Not wearable
  }
  LoadRawGump($gumpindex, $gumpfile, intval($gumpid), $hue, $hues, $gumprawdata);
}

// Separate name and skill title
$nametitle = striphtmlchars($nametitle);
if (($i = strpos($nametitle, ",")) !== FALSE) {
	$name = substr($nametitle, 0, $i);
  $title = substr($nametitle, $i + 2);
}
else {
	$name = $nametitle;
	$title = "";
}

AddText($gumprawdata, $name, $title);
CreateGump($gumprawdata);
fclose($hues);
fclose($tiledata);
fclose($gumpfile);
fclose($gumpindex);
exit;

function LoadRawGump($gumpindex, $gumpfile, $index, $hue, $hues, &$gumprawdata)
{
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
  }
  else { // We are using the hues.mul
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
        }
        else if ($orighue > 0x8000) {
          $newr = $r * 8;
          $newg = $g * 8;
          $newb = $b * 8;
        }
        else {
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

function read_big_to_little_endian($file, $length)
{
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

function add_gump($read, &$img)
{
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

function InitializeGump(&$img, $width, $height)
{
  $img = ImageCreateFrompng("images/paperdoll.png") or die("couldnt create image");
  imagealphablending($img, TRUE);
  imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0));
}

function AddText(&$img, $name, $title)
{
	$textcolor = imagecolorallocate($img, 0, 0, 0);
	$pos = (int) (131 - (strlen($name) * 3.5));
	if ($pos < 0)
	  $pos = 0;
  imagestring($img, 3, $pos, 266, $name, $textcolor); // 35, 266
	$pos = (int) (131 - (strlen($title) * 3.5));
	if ($pos < 0)
	  $pos = 0;
  imagestring($img, 3, $pos, 283, $title, $textcolor); // 35, 283
}

function CreateGump(&$img)
{
  Header("Content-type: image/png");
  imagepng($img);
  imagedestroy($img);
}

function striphtmlchars($str)
{
  $nstr = str_replace("&amp;", "&", $str);
  $nstr = str_replace("&#39;", "'", $nstr);
  return $nstr;
}

?>