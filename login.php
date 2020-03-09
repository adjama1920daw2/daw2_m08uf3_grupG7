<?php
session_start(); 
if(isset($_POST['pass'])&&isset($_POST['usr']))
{

$ldaphost = "ldap://172.20.18.70";
$ldappass = trim($_POST['pass']);
$ldapadmin= "cn=".trim($_POST['usr']).",dc=fjeclot,dc=net";

$ldapconn = ldap_connect($ldaphost) or die(header('Location: login.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

    
$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

 
    if ($ldapbind) {
        echo header('Location: menu.php');
    } else {
		echo "<h2>No s'ha pogut realitzar la conexió amb la base de dades LDAP</h2>";
    }

}
}
?>


<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>Login</title>
	</head>
	<body>
<h1>Login administratiu base de dades LDAP</h1>
  <div class="form-group">
	<form action=login.php method=post>
		<input class="form-control" type=text name=usr><br>
		<input class="form-control" type=password name=pass>

		<input class="btn btn-dark" value="Login" type=submit >

		</table>
	</form>
	</div>
	  </body>
</html>

