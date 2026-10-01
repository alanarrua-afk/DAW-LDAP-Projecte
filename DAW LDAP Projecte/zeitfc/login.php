<?php

$ldap_host = "localhost";
$ldap_dn = "dc=zeitfc,dc=cat";

$user = $_POST['user'];
$pass = $_POST['pass'];

$ldapconn = ldap_connect($ldap_host);

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

    $ldaprdn = "uid=$user,ou=jugadors,$ldap_dn";

    $bind = @ldap_bind($ldapconn, $ldaprdn, $pass);

  
    if (!$bind) {

        $ldaprdn = "uid=$user,ou=entrenadors,$ldap_dn";

        $bind = @ldap_bind($ldapconn, $ldaprdn, $pass);
    }

    // Login correcte
    if ($bind) {

        header("Location: dashboard.php");

    } else {

        header("Location: error.html");

    }

} else {

    echo "Error connectant LDAP";

}

?>
