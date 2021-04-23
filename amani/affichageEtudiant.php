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
    $bdd=new PDO("mysql:host=localhost;dbname=bdd ","root","");
    $requete=$bdd->query("SELECT * FROM baseetudiant");
    ?>
    <h1> Liste des etudiants</h1>
    <table class="table">
        <thead>
        <tr>
            <td>
                CIN
            </td>
            <td>
                Nom
            </td>
            <td>
                Prenom
            </td>
            <td>
                Age
            </td>
            <td>
                section
            </td>
            <td>
                image
            </td>
        </tr>
        </thead>
        <?php
        while($resultat=$requete->fetch())
        {
            ?>
            <tr>
                <td>
                    <?php
                    echo $resultat['CIN']."<br>";
                    ?>
                </td>
                <td>
                    <?php
                    echo $resultat['nom']."<br>";
                    ?>
                </td>
                <td>
                    <?php
                    echo $resultat['prenom']."<br>";
                    ?>
                </td>
                <td>
                    <?php
                    echo $resultat['age']."<br>";
                    ?>
                </td>
                <td>
                    <?php
                    echo $resultat['section']."<br>";
                    ?>
                </td>
                <td>
                    <!-- verifier comment afficher une image -->
                    <?php
                    echo $resultat['image']."<br>";
                    ?>
                </td>
                <td>
                    <button type="button" class="btn btn-secondary" title="" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Popover Title">Supprimer</button>
                </td>
                <td>
                    <button type="button" class="btn btn-secondary" title="" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Popover Title">Mettre à jour</button>
                </td>

            </tr>

            <?php
        }
        ?>
    </table
    <?php
}
catch (PDOException$e){
    print "Erreur".$e->getMessage()."<br>";
}


?>

</body>
