<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;
$email = $mybb->user['email'];
if(!isset($email)) header('Location: ./');

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
		<a class='crumb' href='http://www.monarchyuo.com/account/' original-title=''> Game Account </a>
		<span class='arrow' original-title=''>
			<span original-title=''></span>
		</span>
	 </span>
	</span>
</fieldset>
";
echo "<br>";

$consulta = mysql_query("SELECT * FROM mybb_users WHERE email='$email' LIMIT 1");
$linha = mysql_fetch_array($consulta);
$uid = $linha['uid'];
$consulta2 = mysql_query("SELECT * FROM mybb_awaitingactivation WHERE uid='$uid' LIMIT 1");
$linha = mysql_fetch_array($consulta2);
echo "$linha[aid]";


if(isset($linha["aid"])) {
	echo "Voce precisa ativar sua conta do fórum para criar contas ingame!";
}
else {
 if(!isset($_POST["validar"])){ $_POST["validar"] = 1; }
  else {
  if($_POST["validar"] == 1) {
  $account = $_POST["account"];
   $password = $_POST["password"];
   $status = 0;
   $created = date("Y-m-d").' '.date("H:i:s");
   $lastlogin = date("Y-m-d").' '.date("H:i:s");
   $lastip = $_SERVER["REMOTE_ADDR"];
   $consulta = mysql_query("SELECT * FROM dbsphere.gameaccounts WHERE account='$account'");
   $resultado = mysql_num_rows($consulta);
   if($resultado >= 1)
    echo "<br/>Game Account já cadastrado, tente outro!<br/><br/>";
   else {
    $consulta = mysql_query("SELECT * FROM dbsphere.gameaccounts WHERE email = '$email'");
    $resultado = mysql_num_rows($consulta);
    if($resultado >= 6)
     echo "<br/>Só é permitido 6 contas por jogador!<br/><br/>";
    else {
     mysql_query("INSERT INTO dbsphere.gameaccounts (email,account,password,status,created,lastlogin,lastip) VALUES ('$email','$account','$password','0','$created','$lastlogin','$lastip')");
     echo "<br/>Cadastro de Game Account efetuado com sucesso!<br/><br/>";
     echo "<br/>Email: ".$email;
     echo "<br/>Game Account: ".$account;
     echo "<br/>Password: ".$password;
     echo "<br/>Created: ".$created;
     echo "<br/>Last Login: ".$lastlogin;
     echo "<br/>Last IP: ".$lastip."<br/><br/>";
     echo "<br/>Sua conta será criada em no máximo 1 (um) minuto!<br/><br/>";
    }
   }
  }
 }
 $consulta = mysql_query("SELECT * FROM dbsphere.siteaccounts WHERE email='$email' LIMIT 1");
 $linha = mysql_fetch_array($consulta);
 if($linha["priv"] == 7)
  echo "<div align='center'>Voce é um Admin</div><br>";
 $consulta = mysql_query("SELECT * FROM dbsphere.gameaccounts WHERE email='$email' LIMIT 3");
 $resultado = mysql_num_rows($consulta);
 if($resultado >= 1) {
  while($linha = mysql_fetch_array($consulta))
   /* echo "Conta: <a href='verconta.php?account=$linha[account]'>$linha[account]<br><br></a>"; */
   echo "Conta: $linha[account]<br><br>";
 } else
  echo "Voce ainda nao tem account game.";
 if($resultado < 6) {
  echo "
  <div align='center'>
   <form name='cadastro' id='cadastro' method='POST' action='http://www.monarchyuo.com/account'>
    <input type='hidden' name='validar' value='1'>
    <table width='200' border='1' cellpadding='0' cellspacing='0'>
     <tr>
      <td width='60'>Game Account:</td>
      <td width='134'><input type='text' name='account' id='account'></td>
     </tr>
     <tr>
      <td>Password:</td>
      <td><input type='text' name='password' id='password'></td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td><input type='submit' name='submit' id='submit' value='Cadastrar Game Account'></td>
     </tr>
    </table>
   </form>
  </div>";
 }
}

echo $footer;
?>