<?php

    if(isset($_POST['envoyer'])){

        if(!empty($_POST['envoyer'])){

            $nom = CleanInput($_POST['nom']);
            $password = CleanInput($_POST['password']);

            require 'database.php';
            $db = Database::connect();

            $statement = $db->prepare("SELECT name, password FROM administrateur WHERE name = ? AND password = ? ");
            $statement->bindValue("nom:", $nom);
            $statement->bindValue("password:", $password);
            $statement->execute(array($nom, $password));
            $result = $statement->fetch();
            if ($result) {
                $_SESSION['nom'] = $nom;
                $_SESSION['password'] = $password;
                header('Location: admin.php');
                exit();
            } 
            else {
                $message = "Nom ou mot de passe incorrect";
            }

            Database::disconnect();
        }
            
    } else{
        $message = "Veuillez remplir tous les champs !";
    }
 
    function CleanInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BurgerSite </title>
    <link rel="stylesheet" href="../CSS/style.css">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-logo" align="center"> <span class="glyphicon glyphicon-cutlery"></span> Burger Site <span class="glyphicon glyphicon-cutlery"></span></h3>
                <br>
                <div align="center" style="color:red;">
                    <?php echo $message; ?>
                </div>

                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label" style="color:white; font-size:20px; font-weight:bold;">Nom :</label>
                        <input type="text" class="form-control" name="nom"> 
                    </div>
                    <div class="mb-3">
                        <label for="mot de passe" class="form-label" style="color:white; font-size:20px; font-weight:bold;">Mot de passe :</label>
                        <input type="password" class="form-control" name ="password" >
                    </div>
                    <input type="submit" class="btn btn-danger" value ="Se connecter" name="envoyer" style="width:100%;">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>

