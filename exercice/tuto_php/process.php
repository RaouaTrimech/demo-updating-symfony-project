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

if(isset($_FILES['image'])&& !empty($_FILES['image']['name'])){
    $taillemax = 2097152; //2 Moctet
    $extensionsValides = array('jpg','jpeg','gif','png');
    if ($_FILES['image']['size']<=$taillemax)
    {
        $extensionUpload= strtolower(substr(strrchr($_FILES['image']['name'],'.'),1));//valider extension
        if(in_array($extensionUpload,$extensionsValides)){
            $chemin="C:\Users\raoua\OneDrive\Bureau\GL2 sem2\dev web\tp-php\exercice\tuto_php\Etudiants\images".$_SESSION['id'].'.'.$extensionUpload;
            $resultat=move_uploaded_file($_FILES['image']['tmp_name'],$chemin);
            if($resultat)
            {
                $i=$_SESSION['id'].".".$extensionUpload;
            }
            else
            {
                $erreur="erreur durant l'importation de l'image";
            }
        }
        else{
            $erreur='votre image doit etre au format adequat';
        }
    }
    else
    {
        $erreur="Votre photo de profil ne doit pas depasser 2 Moctets";
    }
}




