<?php

$host="localhost";
$user="root";
$password="";
$db="restaurant";

$nomErr = $emailErr = $villeErr = $adresseErr = $codepostalErr = $nbconvErr =  $dateresaErr= $telephoneErr = "";
$nom = $email = $website = $message = $prenom = $adresse = $codepostal = $ville = $telephone = $dateresa = $service = $nbconv = $midi = $soir = $disp = "";

try{
    //creation de l'objet pdo
    $db=new PDO("mysql:host=$host;dbname=$db",$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));

}catch(PDOException $e){//erreur de connexion
    print"Erreur : ".$e->getMessage();
    die();
}


$disp=("SELECT SUM(NbConvives) as total FROM reservation where DateHeureRepas = '$dateresa'"); //2021-12-22 12:00:00
    
    $sql = $db->query($disp);

    $sql->setFetchMode(PDO::FETCH_OBJ);// Récupérer sous forme d’objet

    $res = $sql->fetch();

    $total = $res ->total;

    echo $total ;

    $resa=("INSERT INTO `reservation`(`Code`, `Date`, `NumClient`, `DateHeureRepas`, `NbConvives`, `Confirme`) 
            VALUES (NULL,$dateresa,NULL,$dateresa,$nbconv,'1'");
    $db->query($resa);
    echo $resa;
    
function dispo($dateresa,$nbconv,$db){

    $disp=("SELECT SUM(NbConvives) as total FROM reservation where DateHeureRepas = '$dateresa'"); //2021-12-22 12:00:00
    
    $sql = $db->query($disp);

    $sql->setFetchMode(PDO::FETCH_OBJ);// Récupérer sous forme d’objet

    $res = $sql->fetch();

    $total = $res ->total;

    echo $total ;


    if($total+$nbconv>30){
        echo "Nombre max de résa pour cette date atteint";
        die();}
}

function reservation($dateresa, $nbconv, $db){
    $resa=("INSERT INTO `reservation`(`Code`, `Date`, `NumClient`, `DateHeureRepas`, `NbConvives`, `Confirme`) 
            VALUES (NULL,'2021-12-21',NULL ,$dateresa,$nbconv,'1'");
    $db->query($resa);
}

// $code_select="";
// $requete="SELECT Nom FROM client;";
// if(isset($_GET['sub'])){
// //$code_select=$_GET["code"];
// }

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


    
        // $sql= ("SELECT Nom FROM client" ); <TEST pour voir si la connexion est faite avec la bdd>
        // foreach($db->query($sql) as $row){
            
        //     echo $row['Nom']; 
            
        // }
        reservation($dateresa, $nbconv, $db);
        dispo($dateresa,$nbconv,$db);
        
            


        // $disp=("SELECT SUM(NbConvives) as total FROM reservation where DateHeureRepas = '$dateresa'"); //2021-12-22 12:00:00
        // $sql = $db->query($disp);
        //     if($sql){
        //         $sql->setFetchMode(PDO::FETCH_OBJ);// Récupérer sous forme d’objet

        //         $res = $sql->fetch();
        
        //         $total = $res ->total;
        
        //         echo $total ;
        //     }
       
       
        //add client to db//
        // $insert= ("INSERT INTO client (NumClient, Nom, Prenom, Adresse, CodePostal, Ville,  Mail, Telephone)
        // VALUES (NULL,'$nom', '$prenom','$adresse','$codepostal','$ville','$email','$telephone')" );
        // $sql=("SELECT Nom, Prenom, Mail from client;");

        
        // $db->query($insert);

        



        
    
            
 
    
    function ajout($email){
        $check=("SELECT Mail from client");
        foreach($db->query($check) as $row){
            if($email===$check){

            }
        }
    }



    




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
    
    
            
    
    // $conn = new mysqli($host,$user,$password,$db);
    // if($conn->connect_error){
    // die("Connection failed: ". $conn->connect_error);


    // $sql="INSERT INTO client (Nom, Prenom, email)
    //     values ('$nom','$prenom','$email')";


    // if($conn->query($sql) === TRUE){
    //     echo "reussi";
    //     }else{"erreur";}

    


    ?>



</body>
</html>