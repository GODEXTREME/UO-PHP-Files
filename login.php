<?php
define('IN_MYBB', 1);
require_once ("./global.php");
echo $headerinclude;

echo $header;

$conexao['user'] = "root";

$conexao['pass'] = "";

$conexao['root'] = "localhost";

$conexao['name'] = "dbsphere";
//*** Executando a conexão

$conexao['conexao'] = mysql_connect($conexao['root'],$conexao['user'],$conexao['pass'])or die();

mysql_select_db($conexao['name'],$conexao['conexao']);


if(!isset($_POST['valida'])) { $_POST['valida'] = 0; }
if ($_POST['valida'] == 1) {
 include("seguranca.php");
 // Verifica se um formulário foi enviado
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($usuario, $senha) == true)
  {
   /* echo "deu";
   exit; */
   header("Location: ./account");
  } else
   expulsaVisitante();
 }
} else {
 echo "
 <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
 <html xmlns='http://www.w3.org/1999/xhtml'>
 <head>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
 <title>Painel do Administrador - BNCTV.com.br</title>
 <link href='_css/login.css' rel='stylesheet' media='all' />
 </head>
 <body>
 <form method='post' action=''>
 <label>Email</label><br />
 <input type='text' name='usuario' maxlength='50' autocomplete='on'/><br />
 <label>Senha</label><br />
 <input type='password' name='senha' maxlength='50' />
 <input type='hidden' name='valida' id='valida' value='1'><br />
 <input type='submit' value='Entrar' />
 </form>
 <br />
 </body>
 </html>";
}


mysql_select_db("forum",$conexao['conexao']);


// your php file contents

echo $footer;
?>