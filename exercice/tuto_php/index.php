<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=bdd', 'root', '');
}
catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die();
}


//ajouter etudiant

if(isset($_POST['ajouter_etudiant'])) {
    //securiser les variables
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $age = htmlspecialchars($_POST['age']);
    $section = htmlspecialchars($_POST['section']);
    //hacher un mdp
    //$mdp=sha1($_POST['mdp']):
    $CIN = htmlspecialchars($_POST['CIN']);
    $image = $_FILES['image']['name'];
    $upload="";
    /****************************/
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['CIN']) and !empty($_POST['age']) and !empty($_POST['section']) and !empty($_FILES['image']['name'])) {

        if(isset($_FILES['image'])&& !empty($_FILES['image']['name'])){
            $image = $_FILES['image']['name'];
            $taillemax = 2097152; //2 Moctet
            $extensionsValides = array('jpg','jpeg','gif','png');
            if ($_FILES['image']['size']<=$taillemax)
            {
                $extensionUpload= strtolower(substr(strrchr($image,'.'),1));//valider extension
                if(in_array($extensionUpload,$extensionsValides)){
                    $chemin="Etudiants".$image;
                    //echo $chemin;
                    //$chemin="C:\Users\raoua\OneDrive\Bureau\GL2 sem2\dev web\tp-php\exercice\tuto_php\Etudiants";
                    $resultat=move_uploaded_file($_FILES['image']['tmp_name'],$chemin);
                    if($resultat)
                    {
                        $i=$image/*.".".$extensionUpload*/;
                        $insetetud = $bdd->prepare("INSERT INTO etudiants(CIN,nom,prenom,section,age,image) VALUES (?,?,?,?,?,?)") ;
                        $insetetud->execute(array($CIN, $nom, $prenom, $section, $age, $i));
                        $erreur="l'etudiant a bien été ajouté";
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
    }
    else{
        $erreur = "tous les champs doivent etre completes";
    }
}
        /***************************/

//supprimer etudiant

if( isset($_GET['delete']))
{
    $requete = $bdd->prepare("DELETE FROM etudiants WHERE CIN=?");
    $requete->execute(array($_GET['delete']));

}
        /***************************/
//afficher liste eudiants
$req="select * from etudiants;";
$resultat=$bdd->query($req);
$res=$resultat->fetchAll(PDO::FETCH_OBJ);
//modifier etudiant


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AFFICHER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>



                <table class="table table-dark table-striped">
                    <thead>
                    <td>CIN</td> <td>nom</td> <td>prenom</td> <td>age</td> <td>section</td> <td>image</td> <td> </td> <td> </td>
                    </thead>
                    <?php foreach($res as $ligne){?>
                        <tr>
                            <td><?php echo $ligne->CIN ?></td>
                            <td><?php echo $ligne->nom ?></td>
                            <td><?php echo $ligne->prenom?></td>
                            <td><?php echo $ligne->age ?></td>
                            <td><?php echo $ligne->section ?></td>
                            <td> <img width="30" src="Etudiants<?php echo $ligne->image ?>"/> </td>

                            <td>
                                <a name="modifier" href="modifier.php?edit=<?php echo $ligne->CIN ; ?>"
                                   class="btn btn-info">Modifier</a>
                            </td>
                            <td>
                                <a href="index.php?delete=<?php echo $ligne->CIN ; ?>"
                                   class="btn btn-info"><img src=""/>Supprimer</a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>

                </table>


                    <button  align="center" type="submit" name="ajouter" class="btn btn-primary"><a href="ajouter.php" style="color: azure">Ajouter</a></button>



            <!--afficherEtudiant-->
         <!--   <td align="center"><div align="center">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NOM : </label>
                            <input type="text" class="form-control" placeholder="nom" id="nom" name="nom" value="<?php if(isset($nom)) {echo $nom;}?>" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">PRENOM : </label>
                            <input type="text" class="form-control" placeholder="prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;}?>" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">CIN : </label>
                            <input type="number" class="form-control" placeholder="CIN" id="CIN" name="CIN" value="<?php if(isset($CIN)) {echo $CIN ;}?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">AGE : </label>
                            <input type="number" class="form-control" placeholder="age" id="age" name="age" value="<?php if(isset($age)) {echo $age;}?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">SECTION : </label>
                            <input type="text" class="form-control" placeholder="section" id="section" name="section" value="<?php if(isset($section)) {echo $section;}?>" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">IMAGE : </label>
                            <input type="file" class="form-control"placeholder="image" id="image" name="image" value="<?php if(isset($image)) {echo $image;}?>">
                        </div>

                        <button type="submit" name="ajouter_etudiant" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                    if ( isset($erreur)){
                        echo $erreur;
                    }
                    ?>
                </div>
            </td>--><!--ajouterEtudiant-->

</body>
</html>