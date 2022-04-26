<?php
    $serverName = "localhost";
    $username = "root";
    $password = "admin";
    $nom = valid_donnees($_POST['nom']);
    $prenom = valid_donnees($_POST['prenom']);
    $mail = valid_donnees($_POST['mail']);
    $message = valid_donnees($_POST["message"], true);
    function valid_donnees($donnees, $texte = false){
        if (!$texte){
            $donnees = trim($donnees);
        }
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    try{
        $conn = new PDO("mysql:host=$serverName;dbname=jadoo;charset=utf8",$username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo 'Erreur :'.$e->getMessage();
    }
    if(!empty($prenom) && strlen($prenom) <= 30 && preg_match("/^[A-Za-z '-]+$/",$prenom)
       && !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL) 
       && !empty($nom) && strlen($nom) <= 30 && preg_match("/^[A-Za-z '-]+$/",$nom)
       && !empty($message)){
        $sth = $conn->prepare("INSERT INTO messages(Nom, Prenom, Email, Message)
                            VALUES(:nom, :prenom, :mail, :message)");
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':mail',$mail);
        $sth->bindParam(':message',$message);
        $sth->execute();
        setcookie("form", "yes", time() + 60, '/', '', false, false);
        header("Location:../page d'accueil.php#prendre_rdv");
    }
?>