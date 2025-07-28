<?php 

    require 'database.php';

    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
    }
   
    if(!empty($_POST)){

        $id = checkInput($_POST['id']);
        
        $db = Database::connect();

        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));

        Database::disconnect();
        header("Location : admin.php");
    }


    function checkInput($data){

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <title>Burger Site</title>

</head>
<body>
    <h1 class="text-logo"> <span class="glyphicon glyphicon-cutlery"></span> Burger Site <span class="glyphicon glyphicon-cutlery"></span></h1>

    <div class="container admin">
        <div class="row">
            <h1><strong>Supprimer un item </strong></h1>
            <br>

            <form class="form" role="form" method="post" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <p class="alert alert-warning">
                    Etes-vous sûr de vouloir supprimer ?
                </p>

                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Oui</button>
                    <a href="admin.php" class="btn btn-default">Non</a>
                </div>
            </form>
            
        </div>
        
    </div>

</body>
</html>    