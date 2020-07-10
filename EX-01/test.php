<?php 
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
    if (!isset($_POST['password']) || $_POST['password'] == "" || $_POST['login'] == "" || $_POST['password'] != "2020")
    echo ("<a href='index.php?page=3'>Mauvais couple identifiant/mot de passe</a>");

else {
    session_start();
    $_SESSION['id'] = $_POST['login'];
    setcookie('id', $_POST['login']);
    header("Location: index.php?page=1");
}
}
?>
