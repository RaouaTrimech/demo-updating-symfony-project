<?php
   session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=bdd', 'root', '');


}
catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die();
}
if( isset($_GET['delete']))
{
    $requete = $bdd->prepare("DELETE FROM etudiants WHERE CIN=?");
    $requete->execute(array($_GET['delete']));

}
header('index.php');

