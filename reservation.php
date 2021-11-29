<?php

require("fonctions.php");

$host="localhost";
$user="root";
$password="";
$db="restaurant";

$nomErr = $emailErr = $villeErr = $adresseErr = $codepostalErr = $nbconvErr =  $dateresaErr= $telephoneErr = "";
$nom = $email = $website = $message = $prenom = $adresse = $codepostal = $ville = $telephone = $dateresa = $service = $nbconv = $midi = $soir = $disp = $numClient= "";

if(isset($_GET['sub'])){
    $nom=$_GET['nom'];
    $prenom=$_GET['prenom'];
    $email=$_GET['email'];
    $adresse=$_GET['adresse'];
    $codepostal=$_GET['codepostal'];
    $ville=$_GET['ville'];
    $telephone=$_GET['telephone'];
    $dateresa=$_GET['dateresa'];
    $midi=$_GET['service'];
    $soir=$_GET['service'];
    $nbconv=$_GET['nbconv'];

    
}

try{
    //creation de l'objet pdo
    $db=new PDO("mysql:host=$host;dbname=$db",$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));

    if(dispo($dateresa,$nbconv,$db)){
       //echo "OK";
        $numClient = ClientConnu($db, $email);
        if ($numClient == 0){
            $numClient = CreerClient($db,$nom, $prenom, $email, $adresse, $codepostal, $ville, $telephone);
        }
        echo "Numéro de Client : $numClient<br>";
        reservation($db, $numClient, $dateresa, $nbconv);
    }else{
        echo "Nous n'avons pas assez de place pour le service souhaité<br>Veuillez choisir un autre service";
    }

}catch(PDOException $e){//erreur de connexion
    print"Erreur : ".$e->getMessage();
    die();
}





?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire de contact en page unique</title>
</head>
<body>
   
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method=get>
        <div>
            <label for="nom">Votre nom</label>
            <br>
            <input type=text name="nom" value="<?php echo $nom;?>">
            <span class="error">*<?php echo $nomErr; ?></span>
        </div>
        <div>
            <label for="prenom">Votre prenom</label>
            <br>
            <input type=text name="prenom" value="<?php echo $prenom;?>">
            <span class="error">*<?php echo $nomErr; ?></span>
        </div>
        <div>
            <label for="email">Votre e-mail</label>
            <br>
            <input type=email name="email" value="<?php echo $email;?>">
            <span class="error">*<?php echo $emailErr; ?></span>
        </div>
        <div>
            <label for="adresse">Votre adresse</label>
            <br>
            <input type=text name="adresse"  value="<?php echo $adresse;?>">
            <span class="error"><?php echo $adresseErr; ?></span>
        </div>
        <div>
            <label for="codepostal">Code postal</label>
            <br>
            <input type=text name="codepostal" value="<?php echo $codepostal;?>">
            <span class="error">*<?php echo $codepostalErr; ?></span>
        </div>
        <div>
            <label for="ville">Ville</label>
            <br>
            <input type=text name="ville" value="<?php echo $ville;?>">
            <span class="error">*<?php echo $villeErr; ?></span>
        </div>
        <div>
            <label for="telephone">Telephone</label>
            <br>
            <input type=text name="telephone" value="<?php echo $telephone;?>">
            <span class="error">*<?php echo $telephoneErr; ?></span>
        </div>
        <div>
            <label for="dateresa">Date réservation</label>
            <br>
            <input type=text name="dateresa" value="<?php echo $dateresa;?>">
            <span class="error">*<?php echo $dateresaErr; ?></span>
        </div>

        <div>
        
        <label for="service">Service</label>
        <select name="service">
                <optgroup>
                        <option value="<?php echo $midi;?>">midi</option>
                        <option value="<?php echo $soir;?>">soir</option>
                </optgroup>
        </select>
        </div>

        <div>
            <label for="nbconv">Nombre de convives</label>
            <br>
            <input type=text name="nbconv" value="<?php echo $nbconv;?>">
            <span class="error">*<?php echo $nbconvErr; ?></span>
        </div> 
        <div>
            <input type=submit name="sub" value="envoyer" id="inline">
            <input type=reset name="reset" value="reset" id="inline">
        </div>
    </form>
    
    
    <?php
    
    
            
    
    

    


    ?>



</body>
</html>