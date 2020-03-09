
<?php

if(isset($_POST['cn'])){
$ldaphost = "ldap://172.20.18.70";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

$ldapconn = ldap_connect($ldaphost) or die(header('Location: menu.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {
    
    $user=trim($_POST['cn']);
    $cerca = ldap_search($ldapconn, "dc=fjeclot, dc=net","uid=".$user);
    
		if($cerca) {
			$info = ldap_get_entries($ldapconn, $cerca);
			
			if($info['count']==0){
			
			echo "<h1>No s'ha trobat cap usuari amb aquest UID</h1>";
		}else{
			for ($i=0; $i<$info["count"]; $i++)
			{
				echo "<br />";
				echo "DN del usuari: ".$info[$i]["dn"]. "<br />";
				echo "Identificador: ".$info[$i]["uid"][0]. "<br />";
				echo "Nom complert: ".$info[$i]["cn"][0]. "<br />";
				echo "Cognom: ".$info[$i]["sn"][0]. "<br />";
				echo "Nom en clau: ".$info[$i]["givenname"][0]. "<br />";
				echo "Càrrec o títol: ".$info[$i]["title"][0]. "<br />";
				echo "Telefon fixe: ".$info[$i]["telephonenumber"][0]. "<br />";
				echo "Telefon mobil: ".$info[$i]["mobile"][0]. "<br />";
				echo "Adreça: ".$info[$i]["postaladdress"][0]. "<br />";
				echo "Directori arrel ".$info[$i]["homedirectory"][0]. "<br />";
				echo "Login Shell: /bin/bash <br />";
				echo "Numero grup identificador usuari: ".$info[$i]["gidnumber"][0]. "<br />";
				echo "Numero identificador usuari: ".$info[$i]["uidnumber"][0]. "<br />";			
				echo "Descripció: ".$info[$i]["description"][0]. "<br />";
						
			} 
		}
			
		}	
		 
} 

}

}
?>


<html>
	<head>  
    <meta charset="utf-8">
    <title>Cercar usuaris</title>
	</head>
 <body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="alert alert-info" role="alert">
  Mostrar dades del usuari(UID):
</div>
    <form action="" method=post>
<input class="form-control" type=text name=cn>
	<input class="btn btn-dark" type=submit value="Mostrar">
	</form>
<br>
 <a href="menu.php">Tornar Enrrere</a> 
       </div>
  </body>
</html>
