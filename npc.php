<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;
echo "<title>Monarchy UO - NPC Database</title>";

/* $skillnames = array("","Alchemy","Anatomy","AnimalLore","Taming","Archery","ArmsLore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","DetectingHidden","Enticement","EvaluatingIntel","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","ItemId","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","RemoveTrap","MagicResistance","Snooping","SpiritSpeak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","TasteId","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");
$skillnamesfixed = array("","Alchemy","Anatomy","Animal Lore","Animal Taming","Archery","Arms Lore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","Detecting Hidden","Discordance","Evaluating Intelligence","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","Item Identification","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","Remove Trap","Resisting Spells","Snooping","Spirit Speak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","Taste Identification","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing"); */

if(isset($_GET['id'])) $id = $_GET['id'];
if(isset($_GET['sort'])) $sort = $_GET['sort'];
unset($_GET['id']);
unset($_GET['sort']);

/* require_once ("./fiximg.php"); */

$path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

if($id == "all" OR $id == "") {
if(!isset($sort))
$sort = "NAME <> ''";
else {
$sort2 = $sort;
$len = strlen($sort);
if(($sort == "all") OR ($len == 1))
$sort = "NAME LIKE '$sort%'";
else
$sort = "CATEGORY LIKE '%$sort%'";
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
		<a class='crumb' href='http://www.monarchyuo.com/npc/all/' original-title=''> NPC </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/npc/all/' original-title=''> All </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>";
	 if(isset($sort2)) {
	 echo "
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/npc/all/$sort2/' original-title=''> $sort2 </a>
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
    <td colspan='5'><center><h2>NPC Database</h2></center></td>
   </tr>
<tr>
<td colspan='5' style='width:100%; text-align:center; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px;'>
<a href='$path/npc/all/'>ALL</a>&nbsp;
<a href='$path/npc/all/A'>A</a>&nbsp;
<a href='$path/npc/all/B'>B</a>&nbsp;
<a href='$path/npc/all/C'>C</a>&nbsp;
<a href='$path/npc/all/D'>D</a>&nbsp;
<a href='$path/npc/all/E'>E</a>&nbsp;
<a href='$path/npc/all/F'>F</a>&nbsp;
<a href='$path/npc/all/G'>G</a>&nbsp;
<a href='$path/npc/all/H'>H</a>&nbsp;
<a href='$path/npc/all/I'>I</a>&nbsp;
<a href='$path/npc/all/J'>J</a>&nbsp;
<a href='$path/npc/all/K'>K</a>&nbsp;
<a href='$path/npc/all/L'>L</a>&nbsp;
<a href='$path/npc/all/M'>M</a>&nbsp;
<a href='$path/npc/all/N'>N</a>&nbsp;
<a href='$path/npc/all/O'>O</a>&nbsp;
<a href='$path/npc/all/P'>P</a>&nbsp;
<a href='$path/npc/all/Q'>Q</a>&nbsp;
<a href='$path/npc/all/R'>R</a>&nbsp;
<a href='$path/npc/all/S'>S</a>&nbsp;
<a href='$path/npc/all/T'>T</a>&nbsp;
<a href='$path/npc/all/U'>U</a>&nbsp;
<a href='$path/npc/all/V'>V</a>&nbsp;
<a href='$path/npc/all/W'>W</a>&nbsp;
<a href='$path/npc/all/X'>X</a>&nbsp;
<a href='$path/npc/all/Y'>Y</a>&nbsp;
<a href='$path/npc/all/Z'>Z</a>
 </div>
</td>
</tr>
<tr>
<th style='width:20%; vertical-align:middle; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Picture</div>
</th>
<th style='width:60%; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Item Name</div>
</th>
<th style='width:20% text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Count</div>
</th>
</tr>";
$sql = mysql_query("SELECT * FROM dbsphere.npcs WHERE $sort ORDER BY NAME ASC");
while($npc = mysql_fetch_array($sql)) {
echo "
<tr>
<td style='text-align:center; vertical-align:middle; height: 32px;'>
<a href='$path/npc/$npc[DEFNAME]'><img title='$npc[ID] - $npc[NAME]' src='$path/images/anims/$npc[ID].bmp' style='max-height: 28px;'></a>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal; text-transform: capitalize;'><a href='$path/npc/$npc[DEFNAME]'>$npc[NAME]</a></div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$npc[AMOUNT]</div>
</td>
</tr>";
}
echo "
</tbody>
</table>";

echo "</div>";

}
//ENF OF ITEM/ALL
// BEGIN OF ITEM/ID
if(($id <> "") AND ($sort == "") AND ($id <> "all")) {
$npc = $id;
$sql = mysql_query("SELECT * FROM dbsphere.npcs WHERE DEFNAME='$id'");
$result = mysql_fetch_array($sql);
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
		<a class='crumb' href='http://www.monarchyuo.com/npc/all/' original-title=''> NPC </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/npc/$result[DEFNAME]/' original-title='' style='text-transform: capitalize;'> $result[NAME] </a>
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
    <td colspan='10' style='text-transform: capitalize;'><center><h2>$result[NAME]</h2></center></td>
   </tr>
   <tr>
    <td colspan='10'><center><img src='$path/images/anims/$result[ID].bmp'></center></td>
   </tr>
<tr>
 <th colspan='10' style='font-size: 16px; text-align:center; vertical-align:middle; height: 32px;'>Status</th>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Strenght</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[STR]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Hitpoints</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[HITS]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Dexterity</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[DEX]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Stamina</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[STAM]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Intelligence</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[INTEL]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Mana</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[MANA]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Damage</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[DAM]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Armor Rating</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[ARMOR]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Karma</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[KARMA]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Fame</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[FAME]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Alignment</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[ALIGNMENT]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Food</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[FOOD]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Barding Difficult</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[BARDINGDIFF]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Slayer</td>
 <td colspan='3' width='164px' style='text-align:center; vertical-align:middle; height: 32px;'>$result[SLAYER]</td>
</tr>
<tr>
 <th colspan='10' style='font-size: 16px; text-align:center; vertical-align:middle; height: 32px;'>Loot</th>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Gold</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[LOOT_GOLD]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Special</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[LOOT_SPECIAL]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Magic</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[LOOT_MAGIC]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Cut Up</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 14px;'>";
if(!empty($result['LOOT_CUTUP'])){
$material = explode(",",$result['LOOT_CUTUP']);
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
</tr>
<tr>
 <th colspan='10' style='font-size: 16px; text-align:center; vertical-align:middle; height: 32px;'>Skills</th>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Anatomy/'>Anatomy</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[ANATOMY]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Poisoning/'>Poisoning</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[POISONING]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/EvaluatingIntel/'>Evaluating Intelligence</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[EVALUATINGINTEL]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/MagicResistance/'>Resising Spells</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[MAGICRESISTANCE]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Magery/'>Magery</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[MAGERY]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Tactics/'>Tactics</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[TACTICS]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Meditation/'>Meditation</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[MEDITATION]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Wrestling/'>Wrestling</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[WRESTLING]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Special</td>
 <td colspan='3' style='text-align:center; vertical-align:middle; height: 32px;'>$result[SKILL_SPECIAL]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'><a href='$path/skill/Taming/'>Animal Taming</a></td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[TAMING]</td>
</tr>
<tr>
 <th colspan='10' style='font-size: 16px; text-align:center; vertical-align:middle; height: 32px;'>Resistances</th>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Cold Resistance</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[RESCOLD]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Fire Resistance</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[RESFIRE]</td>
</tr>
<tr>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Energy Resistance</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[RESENERGY]</td>
 <td colspan='2' style='width: 164px; text-align:center; vertical-align:middle; height: 32px;'>Poison Resistance</td>
 <td colspan='3' style='width: 246px; text-align:center; vertical-align:middle; height: 32px;'>$result[RESPOISON]</td>
</tr>
  
</tbody>
</table>
</div>
";

echo "
<div align='center'><br>
<table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
<tbody>
   <tr>
    <td colspan='3' style='text-transform: capitalize;'><center><h2>NPC Statistics</h2></center></td>
   </tr>
<tr>
 <th style='width:30%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Picture</div>
 </th>
 <th style='width:40%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; '>NPC Name</div>
 </th>
 <th style='width:30%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; '>Count</div>
 </th>
</tr>";
$sql = mysql_query("SELECT * FROM dbsphere.npcs WHERE ID = $result[ID] ORDER BY NAME ASC");
while($npc = mysql_fetch_array($sql)) {
echo "
<tr>
<td style='text-align:center; vertical-align:middle; height: 32px;'>
<a href='$path/npc/$npc[DEFNAME]'><img original-title='$npc[NAME]' src='$path/fiximg.php?id=$npc[ICON]&hue=$npc[COLOR]' style='max-height: 28px;'></a>
</td>
<td style='text-align:left; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal; text-transform: capitalize;'><a href='$path/npc/$npc[DEFNAME]' target='_self'>$npc[NAME]</a></div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$npc[AMOUNT]</div>
</td>
</tr>";
}
echo "
</tbody>
</table>";

}

echo $footer;
?>