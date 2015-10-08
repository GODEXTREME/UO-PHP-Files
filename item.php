<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;
echo "<title>Monarchy UO - Item Database</title>";

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
  $sort = "NAME LIKE 'a%'";
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
		<a class='crumb' href='http://www.monarchyuo.com/item/all/' original-title=''> ITEM </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/item/all/' original-title=''> All </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>";
	 if(isset($sort2)) {
	 echo "
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/item/all/$sort2/' original-title='' style='text-transform: capitalize;'> $sort2 </a>
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
<td colspan='4' style='text-align:center; vertical-align:middle; text-transform: capitalize;'><center><h2>Item Database</h2></center></td></td>
</tr>
<tr>
<td colspan='5' style='width:70%; text-align:center; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px;'>
<a href='$path/item/all/A'>A</a>&nbsp;
<a href='$path/item/all/B'>B</a>&nbsp;
<a href='$path/item/all/C'>C</a>&nbsp;
<a href='$path/item/all/D'>D</a>&nbsp;
<a href='$path/item/all/E'>E</a>&nbsp;
<a href='$path/item/all/F'>F</a>&nbsp;
<a href='$path/item/all/G'>G</a>&nbsp;
<a href='$path/item/all/H'>H</a>&nbsp;
<a href='$path/item/all/I'>I</a>&nbsp;
<a href='$path/item/all/J'>J</a>&nbsp;
<a href='$path/item/all/K'>K</a>&nbsp;
<a href='$path/item/all/L'>L</a>&nbsp;
<a href='$path/item/all/M'>M</a>&nbsp;
<a href='$path/item/all/N'>N</a>&nbsp;
<a href='$path/item/all/O'>O</a>&nbsp;
<a href='$path/item/all/P'>P</a>&nbsp;
<a href='$path/item/all/Q'>Q</a>&nbsp;
<a href='$path/item/all/R'>R</a>&nbsp;
<a href='$path/item/all/S'>S</a>&nbsp;
<a href='$path/item/all/T'>T</a>&nbsp;
<a href='$path/item/all/U'>U</a>&nbsp;
<a href='$path/item/all/V'>V</a>&nbsp;
<a href='$path/item/all/W'>W</a>&nbsp;
<a href='$path/item/all/X'>X</a>&nbsp;
<a href='$path/item/all/Y'>Y</a>&nbsp;
<a href='$path/item/all/Z'>Z</a>
 </div>
</td>
</tr>
<tr>
<td colspan='5' style='width:70%; text-align:center; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px;'>
<a href='$path/item/all/Alchemy'>Alchemy</a>&nbsp;
<a href='$path/item/all/Armor'>Armor</a>&nbsp;
<a href='$path/item/all/Clothes'>Clothes</a>&nbsp;
<a href='$path/item/all/Food'>Food</a>&nbsp;
<a href='$path/item/all/Ingots'>Ingots</a>&nbsp;
<a href='$path/item/all/Magery'>Magery</a>&nbsp;
<a href='$path/item/all/Miscellaneous'>Miscellaneous</a>&nbsp;
<a href='$path/item/all/Ores'>Ores</a>&nbsp;
<a href='$path/item/all/Rare'>Rare</a>&nbsp;
<a href='$path/item/all/Weapons'>Weapons</a>&nbsp;
<a href='$path/item/all/Woods'>Woods</a>
 </div>
</td>
</tr>
<tr>
<th style='width:20%; vertical-align:middle; height: 32px;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Picture</div>
</th>
<th style='width:55%; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Item Name</div>
</th>
<th style='width:10%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Stacks</div>
</th>
<th style='width:15%; text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Count/Value</div>
</th>
</tr>";
$sql = mysql_query("SELECT * FROM dbsphere.items WHERE $sort ORDER BY NAME ASC");
while($item = mysql_fetch_array($sql)) {
echo "
<tr>
<td style='text-align:center; vertical-align:middle; height: 32px;'>
<a href='$path/item/$item[DEFNAME]'><img title='$item[NAME]' src='$path/fiximg.php?id=$item[ID]&hue=$item[COLOR]' style='max-height: 28px;'></a>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal; text-transform: capitalize;'><a href='$path/item/$item[DEFNAME]'>$item[NAME]</a></div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[STACKS]</div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[AMOUNT]</div>
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
$item = $id;
$sql = mysql_query("SELECT * FROM dbsphere.items WHERE DEFNAME='$item'");
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
		<a class='crumb' href='http://www.monarchyuo.com/item/all/' original-title=''> ITEM </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	 <span class='crust'>
		<a class='crumb' href='http://www.monarchyuo.com/item/$result[DEFNAME]/' original-title='' style='text-transform: capitalize;'> $result[NAME] </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	</span>
</fieldset>
";
echo "
<div align='center'>
<table border='1' style='border-collapse:collapse;border:1px #FFFFFF;color:#005ea7; table-layout: inherit; width: 820px; border-color:#ccc;' cellpadding='2'>
<tbody>
<tr>
<td colspan='4' style='text-align:center; vertical-align:middle; text-transform: capitalize;'><center><h2>$result[NAME]</h2></center></td></td>
</tr>
<tr>
 <th style='width:20%; text-align:center; vertical-align:middle; height: 32px;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Picture</div>
 </th>
 <th style='width:55%; text-align:center; vertical-align:middle;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Item Name</div>
 </th>
 <th style='width:10%; text-align:center; vertical-align:middle;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Stacks</div>
 </th>
 <th style='width:15%; text-align:center; vertical-align:middle;'>
  <div style='font-family: Georgia; font-size: 16px; color:#005ea7; text-align:center;'>Count/Value</div>
 </th>
</tr>
<br>";
$sql = mysql_query("SELECT * FROM dbsphere.items WHERE ID = $result[ID] ORDER BY NAME ASC");
while($item = mysql_fetch_array($sql)) {
echo "
<tr>
<td style='text-align:center; vertical-align:middle; height: 32px;'>
<a href='$path/item/$item[DEFNAME]'><img original-title='$item[NAME]' src='$path/fiximg.php?id=$item[ID]&hue=$item[COLOR]' style='max-height: 28px;'></a>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal; text-transform: capitalize;'><a href='$path/item/$item[DEFNAME]' target='_self'>$item[NAME]</a></div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[STACKS]</div>
</td>
<td style='text-align:center; vertical-align:middle;'>
<div style='font-family: Georgia; font-size: 14px; color:#005ea7; font-weight:normal;'>$item[AMOUNT]</div>
</td>
</tr>";
}
echo "
</tbody>
</table>
<br>
<body>";
$sql = mysql_query("SELECT * FROM dbsphere.items WHERE DEFNAME='$id'");
$result = mysql_fetch_array($sql);
if(mysql_num_rows($sql) < 1 )
echo "Item not found on database. Please report to administrator.";
else {
echo "
<script type='text/javascript' src='$path/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
<script type='text/javascript'>
$(function() {
Highcharts.createElement('link', {
href: 'http://fonts.googleapis.com/css?family=Signika:400,700',
rel: 'stylesheet',
type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);
// Add the background image to the container
Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
proceed.call(this);
});
Highcharts.theme = {
colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
'#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
chart: {
backgroundColor: null,
style: { fontFamily: 'Signika, serif' }
},
title: {
style: {
color: 'black',
fontSize: '16px',
fontWeight: 'bold'
}
},
subtitle: {
style: { color: 'black' }
},
tooltip: { borderWidth: 0 },
legend: {
itemStyle: {
fontWeight: 'bold',
fontSize: '13px'
}
},
xAxis: {
labels: {
style: { color: '#6e6e70' }
}
},
yAxis: {
labels: {
style: { color: '#6e6e70' }
}
},
plotOptions: {
series: { shadow: true },
candlestick: { lineColor: '#404048' },
map: { shadow: false }
},
// Highstock specific
navigator: {
xAxis: { gridLineColor: '#D0D0D8' }
},
rangeSelector: {
buttonTheme: {
fill: 'white',
stroke: '#C0C0C8',
'stroke-width': 1,
states: {
select: { fill: '#D0D0D8' }
}
}
},
scrollbar: { trackBorderColor: '#C0C0C8' },
// General
background2: '#E0E0E8'
};
// Apply the theme
Highcharts.setOptions(Highcharts.theme);
// Create the chart
$('#container_online').highcharts('StockChart', {
rangeSelector : {
selected : 1,
inputEnabled: $('#container_online').width() > 480
},
title : { text : '$result[3]' },
series : [{
name : '$result[3]',
data : [";
$sqlb = mysql_query("SELECT * FROM dbsphere.items_history WHERE DEFNAME = '$id' ORDER BY DATE ASC");
$number = mysql_num_rows($sqlb);
$i = 1;
while ($row = mysql_fetch_array($sqlb,MYSQL_ASSOC)) {
$data = strtotime($row["date"]).'000';
if($i < $number)
echo "[$data, $row[amount]],\n";
else
echo "[$data, $row[amount]]";
$i++;
}
echo "
]
}]
});
});
</script>
<script src='$path/js/highstock.js'></script>
<script src='$path/js/modules/exporting.js'></script>
<div id='container_online' style='height: 498px; width: 818px; border: 1px solid'></div>
</body>
</div>";
}
}

echo $footer;
?>