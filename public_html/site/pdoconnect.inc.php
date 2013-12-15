<?php try{
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "egoodbye_membership";//make sure you remove whitespace
$dbuser		= "egoodbye_dude";
$dbpass		= ")TOZUEgo5C3q";
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass, array(PDO::ATTR_PERSISTENT => true));

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}?>
