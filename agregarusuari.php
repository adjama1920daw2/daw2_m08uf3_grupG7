<?php

if(isset($_POST['uid']) && ($_POST['nom']) && ($_POST['cognom']) && ($_POST['givenName']) && ($_POST['title']) && ($_POST['telephoneNumber']) && ($_POST['mobile']) && ($_POST['postalAddress']) && ($_POST['gidNumber']) && ($_POST['uidNumber']) && ($_POST['description'])){
$ldaphost = "ldap://172.20.18.70";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: menu.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {
 
    
    $info["objectclass"][0] = 'top';
    $info["objectclass"][1] = 'person';
    $info["objectclass"][2] = 'organizationalPerson';
    $info["objectclass"][3] = 'inetOrgPerson';
    $info["objectclass"][4] = 'posixAccount';
    $info["objectclass"][5] = 'shadowAccount';
    
    $info["uid"] = trim($_POST['uid']);
    $info["cn"] = $_POST['nom']." ".$_POST['cognom'];
    $info["sn"] = trim($_POST['cognom']);
	$info["givenname"] = trim($_POST['givenName']);
	$info["title"] = trim($_POST['title']);
	$info["telephonenumber"] = trim($_POST['telephoneNumber']);
	$info["mobile"] = trim($_POST['mobile']);
	$info["postaladdress"] = trim($_POST['postalAddress']);
	$info["gidnumber"] = trim($_POST['gidNumber']);
	$info["uidnumber"] = trim($_POST['uidNumber']);
	$info["homedirectory"] = trim($_POST['dirP']);
	$info["loginshell"] = trim($_POST['Shell']);
	$info["description"] = trim($_POST['description']);

	$dn = "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot,dc=net";

    $r = ldap_add($ldapconn, "$dn", $info);
    
		if($r) {
			echo "<h1>S'ha afegit l'usuari amb éxit</h1>";
			
		}
		
		else {
			echo "<h1>No s'ha pogut afegir l'usuari</h1>";

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
   
    <title>Crear Usuari</title>
	</head>
 <body>
	 <div class="alert alert-success" role="alert">
 Crear usuari:
</div>
  <div class="form-group">
    <form action='' method=post>
	   
		   
Nom del usuari:  <input class="form-control" type=text name=nom ><br>
		   	   
Cognom del usuari:  <input class="form-control" type=text name=cognom ><br>
		   
Identificador:  <input class="form-control" type=text name=uid ><br>

Unitat organitzativa:  <input class="form-control" type=text name=ou ><br>
		    
Nom en clau:  <input class="form-control" type=text name=givenName ><br>
		   	   
Titol del usuari: <input class="form-control" type=text name=title ><br>
		   	   
Telefon Fix del usuari: <input class="form-control"type=text name=telephoneNumber ><br>
		   	   
Telefon mobil del usuari: <input  class="form-control"type=text name=mobile ><br>
		   
Adreça del usuari <input class="form-control" type=text name=postalAddress ><br>
		   
Descripció:  <input class="form-control" type=text name=description ><br>
		   
Numero grup identificador usuari: <input class="form-control" type=text name=gidNumber ><br>
		      
Numero identificador usuari:  <input class="form-control" type=text name=uidNumber ><br>
		   
Directori Personal:  <input class="form-control" type=text name=dirP ><br>    

Shell:  <input class="form-control" type=text name=Shell ><br>  		   
	   
			 <input class="btn btn-dark" type=submit value="Crear">
		   

	</form>
	</div>	
  <a href="menu.php">Tornar a inici</a>
  </body>
</html>





