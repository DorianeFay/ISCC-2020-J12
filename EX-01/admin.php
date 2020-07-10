<form action="index.php?page=4" method="post" enctype="multipart/form-data">
<input type="file" accept="image/png, image/jpg, image/jpeg" name="file" required>
<input type="text" name="title" placeholder="Titre">
<input type="text" name="desc" placeholder="Description">
<input type="submit" name="submit" value="Upload">
</form>

<?php
if (isset($_SESSION['id']) && $_SESSION['id']== TRUE) {
    echo 'admin.php';
}

if (empty($_FILES['file']))
    echo("<p>En attente de fichier</p>");
else {
    $filename = $_FILES['file']['name'];
    $filesize = $_FILES['file']['size'];
    $destination = "./";

    if (strlen(substr($filename, 0, (strrpos($filename, ".")))) < 4)
        echo("<p>Erreur dans le fichier: valeur ['name']</p>");
    elseif ($filesize > 2097152)
        echo("<p>Erreur dans le fichier: valeur ['size']</p>");
    else {
        if (!empty($_POST['title']))
            $_SESSION['title'] = $_POST['title'];
        if (!empty($_POST['desc']))
            $_SESSION['desc'] = $_POST['desc'];
        $_SESSION['image'] = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $_SESSION['image']);
        header("Location: index.php?page=1");
    }
}

function upload_file($upload) {
    if (isset($_FILES['userfile'])) {
        $name_file = $_FILES ['userfile']['name'];
        $tmp_name = $_FILES ['userfile']['tmp_name'];
        $local_image = "uploaded/";
        $upload = move_uploaded_file($tmp_name, $local_image . $name_file);

        if ($upload) {
            echo "Le fichier .$name_file. a été téléchargé"; 
        }
        else {
            echo "Le fichier n'a pas pu être téléchargé";
        }
    }
}
upload_file($upload);

function connected_to_database() {
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

function login_form($pdo) {
    try {
        if (!empty($_POST['login'])&& !empty($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $requete = $pdo -> query("SELECT login FROM utilisateurs");
            $res = $requete -> fetchAll();

            if($res){
                if ($login == $res[0]['login']) {
                    echo "Connexion au compte déjà existant";
                    $sql = "UPDATE utilisateurs SET password='$password'
                    WHERE login='$login'";
                    $pdo->exec($sql);
                    echo "Mot de passe mis à jour";
                }
                else {
                    $sql = "INSERT INTO utilisateurs (login, password, imgpath)
                    VALUES('$login' . '$password', ' ')";
                    $pdo-> exec($sql);
                    echo "Entrée ajoutée dans la table";
                }
            }
            else {
                echo "Le nouvel utilisateur n'a pas pu être ajouté";
            }
        }
    }
    catch (PDOException $e) {
        echo "Login erreur" . $e->getMessage();
    }
}
$pdo=connect_to_database();
login_form($pdo);
?> 