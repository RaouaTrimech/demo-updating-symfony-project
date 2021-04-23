<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=bdd", "root", "");

if(isset($_GET['id']) AND $_GET['id']>0)
{

    $getid=intval($_GET['id']);
    $requetee=$bdd->prepare("SELECT * FROM utilisateur WHERE id =?");
    $requetee->execute(array($getid));
    $userinfo=$requetee->fetch();


    ?>
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

<div class="formulaire" action="">
    <h1> Profile </h1>
    <div>
        <h3>  Informations </h3>
        <table class="table">
            <tr>
                <td>Nom</td>
                <td><?php echo $userinfo['nom']?></td>
            </tr>
            <tr>
                <td>Prenom</td>
                <td><?php echo $userinfo['prenom']?></td>
            </tr>
            <tr>
                <td>Login</td>
                <td><?php echo $userinfo['login']?></td>
            </tr>
        </table>
    </div>


    <h3>  Fonctionnalités</h3>
    <form action="affichageEtudiant.php">
        <input type="submit" value="afficher liste d'etudiants">
    </form>
    <form action="ajoutEtudiant.php">
        <input type="submit" value="ajouter un etudiant">
    </form>
    <form action="mettreAJourEtudiant.php">
        <input type="submit" value="mettre à jour un etudiants">
    </form>
    <form action="supprimerEtudiant.php.php">
        <input type="submit" value="supprimer un etudiants">
    </form>
    <form action="deconnectionFinale.php">
        <input type="submit" value="se deconnecter">
    </form>



</div>


</body>

    <?php
}
?>