<?php 

session_start();
echo $_POST['login'];
echo $_POST['password'];

function connect_to_database(){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $databasename = "base-site-rooting";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Vous êtes connecté";
        return($pdo);
    }
    catch (PDOException $e) {
        echo "La connexion a echouée" .$e->getMessage();
    }
    }

function login($pdo){
    try{
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login=$_POST['login'];
            $password=$_POST['password'];

            $requete=$pdo->prepare("SELECT password 
            FROM utilisateurs WHERE login= '$login'");
            $res=$requete->fetchAll();

        if ($res){
            if ($password == $res[0]['password']) {
                echo "Vous êtes connecté";
            }
            else {
                echo "Mauvais couple identifiant / mot de passe";
                echo "<a href ='http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=connexion'>Connexion</a>";
            }
        } 
        }
    }
    catch (PDOException $e){
        echo "Mauvais couple identifiant/mot de passe" .$e->getMessage();  
    }
}
$pdo = connect_to_database();
login($pdo);

$cleid = array_keys($_SESSION);
if (array_key_exists('id', $_SESSION)== true) {
    setcookie($cleid[0], $_SESSION['id']);
}

?> 