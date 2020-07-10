<!DOCTYPE html>
<html>
    <head>
        <title>mini-site-routing</title>
    </head>

    <body>
        <nav>
            <a href ="http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=1">Accueil</a>
            <a href="http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=2">Page 2</a>
            <a href ="http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=3">Page 3</a>
            <a href ="http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=connexion">Connexion</a>
            <a href="http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/admin.php">Admin</a>
        </nav>
    <?php 
    
        if ($_GET['page'] == 1) {
            echo '<h1>Accueil !</h1>';
        }
        if ($_GET['page'] == 2) {
            echo '<h1>Page 2 !</h1>';
        }
        if ($_GET['page'] == 3) {
            echo '<h1>Page 3 !</h1>';
        }
        if ($_GET['page'] == 'connexion') {
            echo '<h1>Connexion</h1>';
            include("connexion.php");
        }
        session_start();
        if(isset($_SESSION['id'])){
            echo '<p>Login : ' .$_SESSION['id'] . '</p>';
            if($_COOKIE['id']){
                $_SESSION['id']=$_COOKIE['id'];
            }
            else {
                echo "<p>Cliquez ici pour vous identifier : <a href='http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=connexion > </a></p>";
            }
        }
    
    ?>

    </body>
    </html>
