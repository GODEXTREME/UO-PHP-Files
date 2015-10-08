<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;
echo "<title>Monarchy UO - Player Database</title>";

$skillnames = array("","Alchemy","Anatomy","AnimalLore","Taming","Archery","ArmsLore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","DetectingHidden","Enticement","EvaluatingIntel","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","ItemId","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","RemoveTrap","MagicResistance","Snooping","SpiritSpeak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","TasteId","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");
$skillnamesfixed = array("","Alchemy","Anatomy","Animal Lore","Animal Taming","Archery","Arms Lore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","Detecting Hidden","Discordance","Evaluating Intelligence","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","Item Identification","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","Remove Trap","Resisting Spells","Snooping","Spirit Speak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","Taste Identification","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");

$path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

$result = mysql_query("SELECT COUNT(*) FROM dbsphere.status");
if ($result) {
global $totalplayers;
list($totalplayers) = mysql_fetch_row($result);
mysql_free_result($result);
}

function skillimage($skillid, $skill)
{
	global $folder;
	$skillid = $skillid-1;
	$skillimage = "/images/skills/{$skillid}.gif";
	return $skillimage;
}

if(isset($_GET['id'])) $id = $_GET['id'];
if(isset($_GET['sort'])) $sort = $_GET['sort'];
unset($_GET['id']);
unset($_GET['sort']);

if($id == "all" OR $id == "") {
if(!isset($sort))
$sort = "CHAR_NAME <> ''";
else {
$sort2 = $sort;
$len = strlen($sort);
if(($sort == "all") OR ($len == 1))
$sort = "CHAR_NAME LIKE '$sort%'";
}
}

if(($id == "online") OR ($id == "all") )
{
echo "
<fieldset class='breadcrumb' style='margin: -18 0 0 0'>
	<span class='crumbs'>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/' original-title=''> Monarchy UO Forum </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/player/all/' original-title=''> PLAYER </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/player/$id/' original-title='' style='text-transform: capitalize;'> $id </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>";
	 if(isset($sort2)) {
	 echo "
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/player/all/$sort2/' original-title=''> $sort2 </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>";
	 }
	 echo "
	</span>
</fieldset>
";
 echo "<br>
<div align='center'>
<table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
<tbody>
   <tr>
    <td colspan='7'><center><h2>Player Database</h2></center></td>
   </tr>
<tr>
<td colspan='7' style='width:70%; text-align:center; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px;'>
<a href='$path/player/online/'>Online</a>&nbsp;
<a href='$path/player/all/'>ALL</a>&nbsp;
<a href='$path/player/all/A'>A</a>&nbsp;
<a href='$path/player/all/B'>B</a>&nbsp;
<a href='$path/player/all/C'>C</a>&nbsp;
<a href='$path/player/all/D'>D</a>&nbsp;
<a href='$path/player/all/E'>E</a>&nbsp;
<a href='$path/player/all/F'>F</a>&nbsp;
<a href='$path/player/all/G'>G</a>&nbsp;
<a href='$path/player/all/H'>H</a>&nbsp;
<a href='$path/player/all/I'>I</a>&nbsp;
<a href='$path/player/all/J'>J</a>&nbsp;
<a href='$path/player/all/K'>K</a>&nbsp;
<a href='$path/player/all/L'>L</a>&nbsp;
<a href='$path/player/all/M'>M</a>&nbsp;
<a href='$path/player/all/N'>N</a>&nbsp;
<a href='$path/player/all/O'>O</a>&nbsp;
<a href='$path/player/all/P'>P</a>&nbsp;
<a href='$path/player/all/Q'>Q</a>&nbsp;
<a href='$path/player/all/R'>R</a>&nbsp;
<a href='$path/player/all/S'>S</a>&nbsp;
<a href='$path/player/all/T'>T</a>&nbsp;
<a href='$path/player/all/U'>U</a>&nbsp;
<a href='$path/player/all/V'>V</a>&nbsp;
<a href='$path/player/all/W'>W</a>&nbsp;
<a href='$path/player/all/X'>X</a>&nbsp;
<a href='$path/player/all/Y'>Y</a>&nbsp;
<a href='$path/player/all/Z'>Z</a>
 </div>
</td>
</tr>
<tr>
<th style='width:20%; height: 32px;'><div style='font-family: Georgia; font-size: 16px;'>Name</div></th>
<th style='width:25%;'><div style='font-family: Georgia; font-size: 16px;'>Title</div></th>
<th style='width:15%;'><div style='font-family: Georgia; font-size: 16px;'>Faction</div></th>
<th style='width:15%;'><div style='font-family: Georgia; font-size: 16px;'>Guild</div></th>
<th style='width:8%;'><div style='font-family: Georgia; font-size: 16px;'>Kills</div></th>
<th style='width:9%;'><div style='font-family: Georgia; font-size: 16px;'>Karma</div></th>
<th style='width:8%;'><div style='font-family: Georgia; font-size: 16px;'>Fame</div></th>
</tr>";

if($totalplayers) {
if($id == "online")
 $sql = mysql_query("SELECT status.char_id,char_karma,char_fame,char_name,char_nototitle,char_counts,char_public FROM dbsphere.status LEFT JOIN dbsphere.characters ON characters.char_id=status.char_id ORDER BY char_name ASC");
elseif($id == "all")
 $sql = mysql_query("SELECT * FROM dbsphere.characters WHERE $sort ORDER BY char_name ASC");

while ($row = mysql_fetch_array($sql)) {
$id = $row["char_id"];
$karma = $row["char_karma"];
$fame = $row["char_fame"];
$charname = $row["char_name"];
$title = $row["char_nototitle"];
$kills = $row["char_counts"];
if ($kills > 0)
$color = "FF0000";
else
$color = "0066FF";
echo "<tr>
<td style='text-align:center; height: 32px;'>
<a href='$path/player/$id/' title='$charname'>$charname</a>
</td>
<td style='text-align:center;'>$title</td>
<td style='text-align:center;'></td>
<td style='text-align:center;'></td>
<td style='text-align:center;'>$kills</td>
<td style='text-align:center;'>$karma</td>
<td style='text-align:center;'>$fame</td>
</tr>";
}
echo "</table></tbody></div>";
}
} elseif($id > 0) {
$sql = mysql_query("SELECT * FROM dbsphere.characters WHERE char_id='$id'");
$result = mysql_fetch_array($sql);
$char_name = $result['char_name'];
$char_str = $result['char_str'];
$char_dex = $result['char_dex'];
$char_int = $result['char_int'];
$char_fame = $result['char_fame'];
$char_karma = $result['char_karma'];
$char_nototitle = $result['char_nototitle'];
$char_totalconnecttime = $result['char_totalconnecttime'];
$char_age = $result['char_age'];

$char_totalconnecttime = $char_totalconnecttime * 60;

$months = 0;
$days = 0;
$hours = 0;
$mins = 0;

if($char_totalconnecttime >= 2592000){
$months = floor($char_totalconnecttime/2592000);
$char_totalconnecttime = ($char_totalconnecttime%2592000);
}
if($char_totalconnecttime >= 86400){
$days = floor($char_totalconnecttime/86400);
$char_totalconnecttime = ($char_totalconnecttime%86400);
}
if($char_totalconnecttime >= 3600){
$hours = floor($char_totalconnecttime/3600);
$char_totalconnecttime = ($char_totalconnecttime%3600);
}
if($char_totalconnecttime >= 60){
$mins = floor($char_totalconnecttime/60);
$char_totalconnecttime = ($time%60);
}

$char_totalconnecttime = $months."m ".$days."d ".$hours."h ".$mins."min";


//$char_totalconnecttime = intval($char_totalconnecttime/60/24/30)."m ".intval($char_totalconnecttime/60/24)."d ".intval(($char_totalconnecttime%720)/24)."hr";

$sql = mysql_query("SELECT * FROM dbsphere.characters WHERE char_id=$id");
$num = mysql_num_rows($sql);
$hand1_name = "";
$hand2_name = "";
$shoes_name = "";
$pants_name = "";
$shirt_name = "";
$helm_name = "";
$gloves_name = "";
$ring_name = "";
$talisman_name = "";
$collar_name = "";
$hair_name = "";
$half_apron_name = "";
$chest_name = "";
$wrist_name = "";
$light_name = "";
$beard_name = "";
$tunic_name = "";
$ears_name = "";
$arms_name = "";
$cape_name = "";
$robe_name = "";
$skirt_name = "";
$legs_name = "";
if($num > 0) {
$ok = 1;
$sql = mysql_query("SELECT * FROM dbsphere.characters_layers WHERE char_id=$id");
while($result = mysql_fetch_array($sql)) {
if($result['layer_id'] == 1) { $hand1_id = $result['item_id']; $hand1_hue = $result['item_hue']; $hand1_defname = $result['item_defname']; $hand1_name = $result['item_name']; }
if($result['layer_id'] == 2) { $hand2_id = $result['item_id']; $hand2_hue = $result['item_hue']; $hand2_defname = $result['item_defname']; $hand2_name = $result['item_name']; }
if($result['layer_id'] == 3) { $shoes_id = $result['item_id']; $shoes_hue = $result['item_hue']; $shoes_defname = $result['item_defname']; $shoes_name = $result['item_name']; }
if($result['layer_id'] == 4) { $pants_id = $result['item_id']; $pants_hue = $result['item_hue']; $pants_defname = $result['item_defname']; $pants_name = $result['item_name']; }
if($result['layer_id'] == 5) { $shirt_id = $result['item_id']; $shirt_hue = $result['item_hue']; $shirt_defname = $result['item_defname']; $shirt_name = $result['item_name']; }
if($result['layer_id'] == 6) { $helm_id = $result['item_id']; $helm_hue = $result['item_hue']; $helm_defname = $result['item_defname']; $helm_name = $result['item_name']; }
if($result['layer_id'] == 7) { $gloves_id = $result['item_id']; $gloves_hue = $result['item_hue']; $gloves_defname = $result['item_defname']; $gloves_name = $result['item_name']; }
if($result['layer_id'] == 8) { $ring_id = $result['item_id']; $ring_hue = $result['item_hue']; $ring_defname = $result['item_defname']; $ring_name = $result['item_name']; }
if($result['layer_id'] == 9) { $talisman_id = $result['item_id']; $talisman_hue = $result['item_hue']; $talisman_defname = $result['item_defname']; $talisman_name = $result['item_name']; }
if($result['layer_id'] == 10) { $collar_id = $result['item_id']; $collar_hue = $result['item_hue']; $collar_defname = $result['item_defname']; $collar_name = $result['item_name']; }
// if($result['layer_id'] == 11) { $hair_id = $result['item_id']; $hair_hue = $result['item_hue']; $hair_defname = $result['item_defname']; $hair_name = $result['item_name']; }
if($result['layer_id'] == 12) { $half_apron_id = $result['item_id']; $half_apron_hue = $result['item_hue']; $half_apron_defname = $result['item_defname']; $half_apron_name = $result['item_name']; }
if($result['layer_id'] == 13) { $chest_id = $result['item_id']; $chest_hue = $result['item_hue']; $chest_defname = $result['item_defname']; $chest_name = $result['item_name']; }
if($result['layer_id'] == 14) { $wrist_id = $result['item_id']; $wrist_hue = $result['item_hue']; $wrist_defname = $result['item_defname']; $wrist_name = $result['item_name']; }
// if($result['layer_id'] == 15) { $light_id = $result['item_id']; $light_hue = $result['item_hue']; $light_defname = $result['item_defname']; $light_name = $result['item_name']; }
// if($result['layer_id'] == 16) { $beard_id = $result['item_id']; $beard_hue = $result['item_hue']; $beard_defname = $result['item_defname']; $beard_name = $result['item_name']; }
if($result['layer_id'] == 17) { $tunic_id = $result['item_id']; $tunic_hue = $result['item_hue']; $tunic_defname = $result['item_defname']; $tunic_name = $result['item_name']; }
if($result['layer_id'] == 18) { $ears_id = $result['item_id']; $ears_hue = $result['item_hue']; $ears_defname = $result['item_defname']; $ears_name = $result['item_name']; }
if($result['layer_id'] == 19) { $arms_id = $result['item_id']; $arms_hue = $result['item_hue']; $arms_defname = $result['item_defname']; $arms_name = $result['item_name']; }
if($result['layer_id'] == 20) { $cape_id = $result['item_id']; $cape_hue = $result['item_hue']; $cape_defname = $result['item_defname']; $cape_name = $result['item_name']; }
if($result['layer_id'] == 22) { $robe_id = $result['item_id']; $robe_hue = $result['item_hue']; $robe_defname = $result['item_defname']; $robe_name = $result['item_name']; }
if($result['layer_id'] == 23) { $skirt_id = $result['item_id']; $skirt_hue = $result['item_hue']; $skirt_defname = $result['item_defname']; $skirt_name = $result['item_name']; }
if($result['layer_id'] == 24) { $legs_id = $result['item_id']; $legs_hue = $result['item_hue']; $legs_defname = $result['item_defname']; $legs_name = $result['item_name']; }
}
}
echo "
<fieldset class='breadcrumb' style='margin: -18 0 0 0'>
	<span class='crumbs'>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/' original-title=''> Monarchy UO Forum </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/player/all/' original-title=''> PLAYER </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/player/$id/' original-title=''> $char_name </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	</span>
</fieldset>
";
echo "<br>
<div align='center'>
 <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
  <tbody>
   <tr>
    <td colspan='10'><center><h2>$char_name - $char_nototitle</h2></center></td>
   </tr>
   <tr>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($tunic_defname)) echo "<a href='$path/item/$tunic_defname/'><img src='$path/fiximg.php?id=$tunic_id&hue=$tunic_hue' style='max-height: 32px'><br>$tunic_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($shirt_defname)) echo "<a href='$path/item/$shirt_defname/'><img src='$path/fiximg.php?id=$shirt_id&hue=$shirt_hue' style='max-height: 32px'><br>$shirt_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($chest_defname)) echo "<a href='$path/item/$chest_defname/'><img src='$path/fiximg.php?id=$chest_id&hue=$chest_hue' style='max-height: 32px'><br>$chest_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($ears_defname)) echo "<a href='$path/item/$ears_defname/'><img src='$path/fiximg.php?id=$ears_id&hue=$ears_hue' style='max-height: 32px'><br>$ears_name</a>";
	echo "</center></div></td>
    <td colspan='2' style='width: 184px;'><div><center>";
	if(isset($helm_defname)) echo "<a href='$path/item/$helm_defname/'><img src='$path/fiximg.php?id=$helm_id&hue=$helm_hue' style='max-height: 32px'><br>$helm_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($collar_defname)) echo "<a href='$path/item/$collar_defname/'><img src='$path/fiximg.php?id=$collar_id&hue=$collar_hue' style='max-height: 32px'><br>$collar_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($robe_defname)) echo "<a href='$path/item/$robe_defname/'><img src='$path/fiximg.php?id=$robe_id&hue=$robe_hue' style='max-height: 32px'><br>$robe_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($cape_defname)) echo "<a href='$path/item/$cape_defname/'><img src='$path/fiximg.php?id=$cape_id&hue=$cape_hue' style='max-height: 32px'><br>$cape_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($talisman_defname)) echo "<a href='$path/item/$talisman_defname/'><img src='$path/fiximg.php?id=$talisman_id&hue=$talisman_hue' style='max-height: 32px'><br>$talisman_name</a>";
	echo "</center></div></td>
   </tr>
   <tr height='290px'>
    <td colspan='3' style='width: 246px;'><div><center>";
	if(isset($hand1_defname)) echo "<a href='$path/item/$hand1_defname/'><img src='$path/fiximg.php?id=$hand1_id&hue=$hand1_hue' style='max-height: 32px'><br>$hand1_name</a>";
	echo "</center></div></td>
    <td colspan='4' style='width: 328px; background-image: radial-gradient(circle,black, transparent);'><div><center><img src='$path/paperdoll.php?id=$id'></center></div></td>
    <td colspan='3' style='width: 246px;'><div><center>";
	if(isset($hand2_defname)) echo "<a href='$path/item/$hand2_defname/'><img src='$path/fiximg.php?id=$hand2_id&hue=$hand2_hue' style='max-height: 32px'><br>$hand2_name</a>";
	echo "</center></div></td>
   </tr>
   <tr>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($skirt_defname)) echo "<a href='$path/item/$skirt_defname/'><img src='$path/fiximg.php?id=$skirt_id&hue=$skirt_hue' style='max-height: 32px'><br>$skirt_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($pants_defname)) echo "<a href='$path/item/$pants_defname/'><img src='$path/fiximg.php?id=$pants_id&hue=$pants_hue' style='max-height: 32px'><br>$pants_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($legs_defname)) echo "<a href='$path/item/$legs_defname/'><img src='$path/fiximg.php?id=$legs_id&hue=$legs_hue' style='max-height: 32px'><br>$legs_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($ring_defname)) echo "<a href='$path/item/$ring_defname/'><img src='$path/fiximg.php?id=$ring_id&hue=$ring_hue' style='max-height: 32px'><br>$ring_name</a>";
	echo "</center></div></td>
    <td colspan='2' style='width: 184px;'><div><center>";
	if(isset($shoes_defname)) echo "<a href='$path/item/$shoes_defname/'><img src='$path/fiximg.php?id=$shoes_id&hue=$shoes_hue' style='max-height: 32px'><br>$shoes_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($wrist_defname)) echo "<a href='$path/item/$wrist_defname/'><img src='$path/fiximg.php?id=$wrist_id&hue=$wrist_hue' style='max-height: 32px'><br>$wrist_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($gloves_defname)) echo "<a href='$path/item/$gloves_defname/'><img src='$path/fiximg.php?id=$gloves_id&hue=$gloves_hue' style='max-height: 32px'><br>$gloves_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($arms_defname)) echo "<a href='$path/item/$arms_defname/'><img src='$path/fiximg.php?id=$arms_id&hue=$arms_hue' style='max-height: 32px'><br>$arms_name</a>";
	echo "</center></div></td>
    <td colspan='1' style='width: 82px;'><div><center>";
	if(isset($half_apron_defname)) echo "<a href='$path/item/$half_apron_defname/'><img src='$path/fiximg.php?id=$half_apron_id&hue=$half_apron_hue' style='max-height: 32px'><br>$half_apron_name</a>";
	echo "</center></div></td>
   </tr>
   <tr>
    <td colspan='10'><center><h2>Character Details</h2></center></td>
   </tr>
   <tr>
    <td colspan='10'>
     <table style='color:#005ea7;'>
      <tbody>
       <tr>
        <td colspan='4' style='vertical-align:top; width:328px;'>
         <div style='float: left;'>Online:<br>Gametime:<br>Account Age:<br><br>Karma:<br>Fame:</div>
         <div style='float: right;'>Yes<br>$char_totalconnecttime<br>$char_age days<br><br>$char_karma<br>$char_fame</div>
        </td>
        <td colspan='4' style='vertical-align:top; width:328px;'>
         <div style='float: left;'>Strength:<br>Dexterity:<br>Intelligence:</div>
         <div style='float: right;'>$char_str<br>$char_dex<br>$char_int</div>
        </td>
        <td colspan='3' style='vertical-align:top; width:164px;'>";
$sql = mysql_query("SELECT skill_id,skill_value FROM dbsphere.characters_skills WHERE char_id=$id ORDER BY skill_value DESC, skill_id ASC LIMIT 3");
while (list($skillid,$skill) = mysql_fetch_array($sql)) {
$skillid = intval($skillid);
$skill = intval($skill);
$name = $skillnamesfixed[$skillid];
$image = skillimage($skillid, $skill);
echo "    <div><center><a href='http://uoguide.com/$name'><img src='$path/$image' border='0' style='max-height:48px;' title='$skillnamesfixed[$skillid]'></a></center></div>";
}
echo "
        </td>
       </tr>
      </tbody>
     </table>
     <!-------------------------------------Player Skills Start---------------------------------->
    </td>
   </tr>
   <tr>
    <td colspan='10'><center><h2>Player vs Monster Statistics</h2></center></td>
   </tr>
   <tr>
    <td colspan='10'>
      <table style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 100%; border-color:#ccc;' cellpadding='2'>
       <tbody>
        <tr>
         <td colspan='5'>
          <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 100%; border-color:#ccc;' cellpadding='2'>
           <tbody>
            <tr>
             <th colspan='1' style='text-align:center;'>Picture</th>
             <th colspan='2' style='text-align:center;'>NPC Name</th>
             <th colspan='1' style='text-align:center;'>Kills</th>
             <th colspan='1' style='text-align:center;'>Percentage of Kills</th>
            </tr>
";

$sql = mysql_query("SELECT * FROM dbsphere.pvm WHERE ATTACKER=$id ORDER BY KILLS_COUNT DESC, PERCENTAGE DESC LIMIT 16");
$ok = mysql_num_rows($sql);
$num = 0;
if($ok > 0) {
$sql = mysql_query("SELECT * FROM dbsphere.pvm WHERE ATTACKER=$id ORDER BY KILLS_COUNT DESC, PERCENTAGE DESC LIMIT 16");
while ($result = mysql_fetch_array($sql)) {
$mob_id[$num] = $result['MOB_ID'];
$kills_count[$num] = $result['KILLS_COUNT'];
$percentage[$num] = $result['PERCENTAGE'];

$sql2 = mysql_query("SELECT * FROM dbsphere.npcs WHERE DEFNAME='$mob_id[$num]'");
$result2 = mysql_fetch_array($sql2);

if($num == 8)
{
echo "
            </tbody>
           </table>
          </td>
          <td colspan='5'>
           <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 100%; border-color:#ccc;' cellpadding='2'>
            <tbody>
             <tr>
              <th colspan='1' style='text-align:center;'>Picture</th>
              <th colspan='2' style='text-align:center;'>NPC Name</th>
              <th colspan='1' style='text-align:center;'>Kills</th>
              <th colspan='1' style='text-align:center;'>Percentage of Kills</th>
             </tr>";
}
echo "
             <tr>
              <td colspan='1' style='width:20%; text-align:center; height: 32px;'><a href='$path/npc/$mob_id[$num]/'><img src='$path/images/anims/$result2[ID].bmp' style='max-height:28px' title='$result2[NAME]'></a></td>
              <td colspan='2' style='width:40%; text-align:center;'><a href='$path/npc/$mob_id[$num]/'>$result2[NAME]</a></td>
              <td colspan='1' style='width:20%; text-align:center;'>$kills_count[$num]</td>
              <td colspan='1' style='width:20%; text-align:center;'>$percentage[$num]</td>
             </tr>";
$num ++;
}
echo "
            </tbody>
           </table>
          </div>
         </td>
        </tr>
       </tbody>
      </table>
     </tr>
     <tr>";
	 $sql = mysql_query("SELECT SUM(KILLS_COUNT) FROM dbsphere.pvm WHERE ATTACKER='$id'");
     $result = mysql_fetch_array($sql);
	 echo "
      <td colspan='10' align='center'>Total Kills: $result[0]</td>
     </tr>
    </tbody>
   </table>
  </div>";
}
}

echo $footer;
?>