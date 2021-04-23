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
    if(isset($_POST['nom'])AND isset($_POST['prenom'])AND isset($_POST['login']) AND isset($_POST['pwd']) AND isset($_POST['pwd2']))
    {
        if(!empty($_POST['nom']) and !empty($_POST['prenom']) and  !empty($_POST['login']) and  !empty($_POST['pwd'])and !empty($_POST['pwd2']) )
        {
            $mynom=htmlspecialchars($_POST['nom']);
            $myprenom=htmlspecialchars($_POST['prenom']);
            $mylogin=htmlspecialchars($_POST['login']);
            $mypwd=$_POST['pwd'];
            $mypwd2=$_POST['pwd2'];
            //$mdp=sha1($_POST['pwd']);
            //$mdp=sha1($_POST['pwd2']);
            //securiser le mot de passe tawa ba3ed nzideha
            if($mypwd==$mypwd2)
            {
                $requete = $bdd->prepare("SELECT * FROM utilisateur WHERE login =?");
                $requete->execute(array($mylogin));
                $existance = $requete->rowCount();
                if ($existance > 0)
                {
                    $err="Ce login existe deja";
                }
                else
                {
                    $inserermembre = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,login,mdp) VALUES(?,?,?,?)");
                    $inserermembre->execute(array($mynom, $myprenom, $mylogin, $mypwd));
                    $err = "Votre compte a bien ete crée";
                }
            }
            else
            {
                $err="les mots de passe ne se correspondent pas";
            }
        }
        else
        {
            $err="tous les champs doivent etres remplis";
        }

    }
}catch (PDOException$e){
    print "Erreur".$e->getMessage()."<br>";
}
?>
<div class="formulaire">
    <h1> Inscription Utilisateur</h1>
    <form method="POST">
        <label> Nom: </label>
        <input type="text" name="nom" placeholder="inserer votre nom">
        <br>
        <br>
        <label> Prenom: </label>
        <input type="text" name="prenom" placeholder="inserer votre prenom">
        <br>
        <br>
        <label> Login: </label>
        <input type="text" name="login" placeholder="inserer votre login">
        <br>
        <br>
        <label> Mot de Passe: </label>
        <input type="password" name="pwd" placeholder="inserer votre mot de passer">
        <br>
        <br>
        <label> Verifier Mot de Passe: </label>
        <input type="password" name="pwd2" placeholder="inserer votre mot de passer">
        <br>
        <br>
        <input type="submit" name="S'inscrire">
    </form>
    <?php
    if(isset($err))
    {
        echo $err;
    }

    ?>
</div>


</body>