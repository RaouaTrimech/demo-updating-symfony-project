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
    $bdd = new PDO("mysql:host=localhost;dbname=bdd", "root", "");
    if( isset($_POST['identifiant']))
    {
        $requete = $bdd->prepare("DELETE etudiants WHERE identifiant=?");
        $requete->execute(array($_POST['identifiant']));
    }

}catch (PDOException$e){
    print "Erreur".$e->getMessage()."<br>";
}
?>

<div class="formulaire">
    <h1> Supprimer</h1>
    <form method="POST" >
        <label> Identifiant: </label>
        <input type="text" name="identifiant" placeholder="inserer l'identifiant">
        <br>
        <br>
        <input type="submit" name="Valider">

</div>


</body>

