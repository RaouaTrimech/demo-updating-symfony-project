<?php
   /* //sde connecter à la base de donnée
    $bdd=new PDO('mysql:localhost;dbname=bdd','root','');
*/
try {
    $bdd = new PDO('mysql:host=localhost;dbname=bdd', 'root', '');
}
catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die();
}
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
      if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['CIN']) and !empty($_POST['age']) and !empty($_POST['section']) and !empty($_FILES['image'])) {
          $insetetud = $bdd->prepare("INSERT INTO etudiants(CIN,nom,prenom,section,age,image) VALUES (?,?,?,?,?,?)") ;
          $insetetud->execute(array($CIN, $nom, $prenom, $section, $age, $image));
          $erreur="l'etudiant a bien été ajouté";
      }
      else{
              $erreur = "tous les champs doivent etre completes";
          }
    }


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>AjouterEtudiant/ModifierEtudiant</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    </head>

    <body>
    <div align="center">
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
    </body>
</html>