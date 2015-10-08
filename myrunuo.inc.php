<?php

// Edit your database settings:
$SQLhost = "localhost";
$SQLport = "";
$SQLuser = "root";
$SQLpass = "";
$SQLdb   = "dbsphere";

// Edit path of .mul files: gumpart.mul gumpidx.mul hues.mul tiledata.mul
$mulpath = "uofiles/";

// Edit hosts allowed to direct to the paperdoll generator or leave blank to allow any
// Example: $validhosts = "http://www.myhost.com http://myhost.com";
$validhosts = "";

// Edit to control number of lines of data per page:
$status_perpage = 30;
$players_perpage = 20;
$guilds_perpage = 20;

// *** End of configuration options ***


$skillnames = array("","Alchemy","Anatomy","AnimalLore","Taming","Archery","ArmsLore","Begging","Blacksmithing","Bowcraft","Camping","Carpentry","Cartography","Cooking","DetectingHidden","Enticement","EvaluatingIntel","Fencing","Fishing","Forensics","Healing","Herding","Hiding","Inscription","ItemId","Lockpicking","Lumberjacking","MaceFighting","Magery","Meditation","Mining","Musicianship","Parrying","Peacemaking","Poisoning","Provocation","RemoveTrap","MagicResistance","Snooping","SpiritSpeak","Stealing","Stealth","Swordsmanship","Tactics","Tailoring","TasteId","Tinkering","Tracking","Veterinary","Wrestling ","Necromancy","Focus","Chivalry","Bushido","Ninjitsu","Spellweaving","Mysticism","Imbuing","Throwing");

function sql_connect()
{
  global $SQLhost, $SQLport, $SQLdb, $SQLuser, $SQLpass;

  if ($SQLport != "")
    $link = @mysql_connect("$SQLhost:$SQLport","$SQLuser","$SQLpass");
  else
    $link = @mysql_connect("$SQLhost","$SQLuser","$SQLpass");
  if (!$link) {
    echo "Database access error ".mysql_errno().": ".mysql_error()."\n";
    die();
  }
  $result = mysql_select_db("$SQLdb");
  if (!$result) {
    echo "Error ".mysql_errno($link)." selecting database '$SQLdb': ".mysql_error($link)."\n";
    die();
  }
  return $link;
}

function sql_query($link, $query)
{
  global $SQLhost, $SQLport, $SQLdb, $SQLuser, $SQLpass;

  $result = mysql_query("$query", $link);
  if (!$result) {
    echo "Error ".mysql_errno($link).": ".mysql_error($link)."\n";
    die();
  }
  return $result;
}

function check_get(&$store, $val)
{
  $magic = get_magic_quotes_gpc();
  if (isset($_POST["$val"])) {
    if ($magic)
      $store = stripslashes($_POST["$val"]);
    else
      $store = $_POST["$val"];
  }
  else if (isset($_GET["$val"])) {
    if ($magic)
      $store = stripslashes($_GET["$val"]);
    else
      $store = $_GET["$val"];
  }
}

?>