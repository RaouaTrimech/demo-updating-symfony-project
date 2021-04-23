<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="node_modules/bootswatch/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <title>Document</title>
</head>
<body>
<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=mabase", "root", "");
    if( isset($_POST['identifiant']) AND isset($_POST['nom'])AND isset($_POST['prenom'])AND isset($_POST['annee'])AND isset($_POST['filiere']) AND isset($_POST['classe']))
    {
        $requete = $bdd->prepare("UPDATE baseetudiant SET nom=?,prenom=?,annee=?,filiere=?,classe=? WHERE identifiant=?");
        $requete->execute(array(
            $_POST['nom'],
            $_POST['prenom'] ,
            $_POST['annee'],
            $_POST['filiere'],
            $_POST['classe'],
            $_POST['identifiant']

        ));
    }

}catch (PDOException$e){
    print "Erreur".$e->getMessage()."<br>";
}
?>

<div class="formulaire">
    <h1> Mise A Jour Etudiant</h1>
    <form method="POST" >
        <label> Identifiant: </label>
        <input type="text" name="identifiant" placeholder="inserer l'identifiant">
        <br>
        <br>
        <label> Nouveau Nom: </label>
        <input type="text" name="nom" placeholder="inserer le nom">
        <br>
        <br>
        <label> Nouveau Prenom: </label>
        <input type="text" name="prenom" placeholder="inserer le prenom">
        <br>
        <br>
        <label> Nouvelle Année: </label>
        <input type="text" name="annee" placeholder="inserer l' année d'etude">
        <br>
        <br>
        <label> Nouvelle Filiere: </label>
        <input type="text" name="filiere" placeholder="inserer la filiere">
        <br>
        <br>
        <label> Nouvelle Classe: </label>
        <input type="text" name="classe" placeholder="inserer la classe">
        <br>
        <br>
        <input type="submit" name="Valider">

</div>


</body>