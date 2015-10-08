<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;
echo "<title>Monarchy UO - Skill Database</title>";

$skillnames = array("","Alchemy","Anatomy","AnimalLore","Taming","Archery","ArmsLore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","DetectingHidden","Enticement","EvaluatingIntel","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","ItemId","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","RemoveTrap","MagicResistance","Snooping","SpiritSpeak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","TasteId","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");
$skillnamesfixed = array("","Alchemy","Anatomy","Animal Lore","Animal Taming","Archery","Arms Lore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","Detecting Hidden","Discordance","Evaluating Intelligence","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","Item Identification","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","Remove Trap","Resisting Spells","Snooping","Spirit Speak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","Taste Identification","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");

if(isset($_GET['id'])) $id = $_GET['id'];

$path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

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
		<a class='crumb' href='http://www.monarchyuo.com/skill/all/' original-title=''> SKILL </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/skill/$id/' original-title='' style='text-transform: capitalize;'> $id </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	</span>
</fieldset>
";

if($id == "all" OR !isset($id)) {
echo "
<br>
<div align='center'>
 <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7;table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
  <tbody>
   <tr>
    <td colspan='6'><center><h2>Skill Database - Grandmaster Count</h2></center></td>
   </tr>
   <tr>
    <td>
     <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7;table-layout: inherit; width: 100%; border-color:#ccc;' cellpadding='2'>
      <tbody>";
       for($i=1;$i<=48;$i++) {
        $sql = mysql_query("SELECT * FROM dbsphere.characters_skills WHERE skill_id=$i AND skill_value>=1000");
        $skillvalue[$i] = mysql_num_rows($sql);
/*         $result = mysql_fetch_row($sql);
        $skillname[$i] = $skillnames[$i]; */
        //echo "$skillname[$i] $skillvalue[$i]<br>";
       }
       $i = 0;
       while($i < 48) {
        $i ++;
        if($i == 25) {
         echo "
      </tbody>
     </table>
    </td>
    <td>
	 <table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7;table-layout: inherit; width: 100%; border-color:#ccc;' cellpadding='2'>
      <tbody>";
        }
       echo "
       <tr>
        <td style='width: 75%; text-align: center;'><a href='$path/skill/$skillnames[$i]'> $skillnamesfixed[$i]</a></td>
        <td style='width: 25%;' align='center'>$skillvalue[$i]</td>
       </tr>";
       }
       echo "
      </tbody>
     </table>
    </td>
   </tr>
  </tbody>
 </table>
</div>";
} elseif ($id <> "" AND $id <> "all") {
$skill = $skillnamesfixed[array_search("$id",$skillnames)];
echo "
<div align='center'>
<table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
<tbody>
   <tr>
    <td colspan='6'><center><h2>$skill</h2></center></td>
   </tr>
<tr>
<th style='width:10%; text-align:center; vertical-align:middle; height:32px;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; '>Picture</div>
</th>
<th style='width:25%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Item Name</div>
</th>
<th style='width:10%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Shard</div>
</th>
<th style='width:15%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Skill Required</div>
</th>
<th style='width:25%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Resources Required</div>
</th>
<th style='width:15%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Effect</div>
</th>
</tr>
<br>
";
$sql = mysql_query("SELECT * FROM dbsphere.items WHERE SKILLMAKE LIKE '%$id%' ORDER BY NAME ASC");
while($item = mysql_fetch_array($sql)) {
echo "

<tr>
 <td style='text-align:center; vertical-align:middle;'>
  <img title='$item[NAME]' src='$path/fiximg.php?id=$item[ID]&hue=$item[COLOR]' style='max-height: 28px;'>
 </td>
 <td style='text-align:center; vertical-align:middle;'>
  <div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>
   <a href='$path/item/$item[DEFNAME]'>$item[NAME]</a>
  </div>
 </td>
 <td style='text-align:center; vertical-align:middle;'>
  <div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[SHARD]
  </div>
 </td>
<td style='text-align:center; vertical-align:middle;'>
 <div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[SKILLMAKE]</div>
</td>
<td style='text-align:left; vertical-align:middle;'>
 <div style='font-family: Georgia; font-size: 14px;'>";
if(!empty($item['RESOURCES'])){
$material = explode(",",$item['RESOURCES']);
$i = 0;
$cnt = count($material);
echo "<table style='border-collapse:collapse; border-style:hidden; width:100%;'><tbody>
";
while($i<$cnt){
$mat = explode(" ",$material[$i]);
$amount = $mat[0];
$itemid = $mat[1];
$sql3 = mysql_query("SELECT * FROM dbsphere.items WHERE DEFNAME='$itemid'");
$item2 = mysql_fetch_array($sql3);
if($item2['NAME'] <> "") {
echo "<tr>
       <td style='width:15%; text-align:center; border-style:hidden; height: 32px'>
        <a href='$path/item/$item2[DEFNAME]'><img src='$path/fiximg.php?id=$item2[ID]&hue=$item2[COLOR]' title='$item2[NAME]' style='vertical-align: middle; max-height: 28px;'></a>
       </td>
       <td style='width:85%; text-align:right; vertical-align:middle; border-style:hidden; text-transform: capitalize;'><a href='$path/item/$item2[DEFNAME]'>$amount $item2[NAME]</a></td>
      </tr>";
} else
echo "<tr>  <td style='width:15%; text-align:center; border-style:hidden;'>&nbsp;</td>
<td style='width:85%; text-align:right; vertical-align:middle; border-style:hidden; height: 32px'>$amount $itemid</td>
  </tr>";
$i++;
}
echo "</tbody></table>";
}
echo"</div>
</td>
<td style='text-align:center; vertical-align:middle;'><div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[EFFECT]</div></td>
</tr>";
}
echo "
</tbody>
</table>
</div>";
if($id == "Taming") {
echo "
<div align='center'><br>
<table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
<tbody>
   <tr>
    <td colspan='3' style='text-transform: capitalize;'><center><h2>Tamable Creatures</h2></center></td>
   </tr>
<tr>
 <th style='width:30%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Picture</div>
 </th>
 <th style='width:40%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; '>NPC Name</div>
 </th>
 <th style='width:30%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; '>Animal Taming</div>
 </th>
</tr>";
$sql = mysql_query("SELECT * FROM dbsphere.npcs WHERE TAMING <> '0' ORDER BY NAME ASC");
while($npc = mysql_fetch_array($sql)) {
echo "
<tr>
<td style='text-align:center; vertical-align:middle; height: 32px;'>
<a href='$path/npc/$npc[DEFNAME]'><img original-title='$npc[NAME]' src='$path/fiximg.php?id=$npc[ICON]&hue=$npc[COLOR]' style='max-height: 28px;'></a>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal; text-transform: capitalize;'><a href='$path/npc/$npc[DEFNAME]' target='_self'>$npc[NAME]</a></div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$npc[TAMING]</div>
</td>
</tr>";
}
echo "
</tbody>
</table>";
}

}

echo $footer;
?>