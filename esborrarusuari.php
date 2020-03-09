<?php

if(isset($_POST['uid'])){
$ldaphost = "ldap://172.20.18.70";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: login.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {
    
    $r = ldap_delete($ldapconn, "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).", dc=fjeclot, dc=net");
    
		if($r) {
			echo "<h1>S'ha esborrat l'usuari amb éxit</h1>";
		}
		
		else {
			echo "<h1>No s'ha pogut esborrar l'usuari</h1>";
			}
     ldap_close($ldapconn);
} 

}
}
?>


<html>
	<head>
    <meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Esborrar usuari</title>
	</head>
<body>
	<div class="alert alert-danger" role="alert">
  Esborrar usuari:
</div>
    <form action=esborrarusuari.php method=post>

		Identificador	  <input class="form-control" type=text name=uid>
		UNitat organitzativa: 	  <input class="form-control" type=text name=ou>

<input class="btn btn-outline-danger" type=submit value="Esborrar Usuari">
	</form>
	<br>
	<a href="menu.php">Tornar a inici</a>
	  </body>
</html>






