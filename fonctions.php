<?php


    
function dispo($dateresa,$nbconv,$db){

    $valid = true;

    $disp=("SELECT SUM(NbConvives) as total FROM reservation where DateHeureRepas = '$dateresa'"); //2021-12-22 12:00:00
    
    $sql = $db->query($disp);

    $sql->setFetchMode(PDO::FETCH_OBJ);// Récupérer sous forme d’objet

    $res = $sql->fetch();

    $total = $res ->total;


   if($total+$nbconv>30){
        $valid = false;
    
    }
        return $valid;
}

function reservation($db, $numClient, $dateresa, $nbconv){
    try{
        $reqCreaRes = "INSERT INTO reservation (NumClient, DateHeureRepas, NbConvives) values ('".$numClient."', '".$dateresa."', '".$nbconv."');";
        $db->exec($reqCreaRes);
        echo "Nouvelle Reservation enregistrée";
    }catch(PDOException $e) {
        echo $reqCreaRes . "<br>" . $e->getMessage();
    }
}

function ClientConnu($db, $email){
    $numC = 0;
    $reqClC = "SELECT NumClient from client WHERE Mail = '".$email."'";
    // echo $numC;
    foreach ($db->query($reqClC) as $client){
        $numC = $client['NumClient'];
    }
    return $numC;
}


function CreerClient($db,$nom, $prenom, $email, $adresse, $codepostal, $ville, $telephone){
    $reqCreaCl = "INSERT INTO client (Nom, Prenom, Adresse, CodePostal, Ville, Mail, Telephone) VALUES ('$nom', '$prenom', '$adresse', '$codepostal', '$ville', '$email', '$telephone');";
    
    try{
    $db->exec($reqCreaCl);
    $numC = $db->lastInsertId();
    echo "Nouveau Client Créé<br>";
    }catch(PDOException $e) {
        echo $reqCreaCl . "<br>" . $e->getMessage();
    }
    return $numC;
}










?>