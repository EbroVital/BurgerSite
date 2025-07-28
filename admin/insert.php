<?php 

    require 'database.php';

    $nameError = $descriptionError = $priceError = $categoryError = $ImageError = $name = $description = $price = $category = $image = "";

    if(!empty($_POST)){

        $name = checkInput($_POST['name']);
        $description = checkInput($_POST['description']);
        $price = checkInput($_POST['price']);
        $category = checkInput($_POST['category']);
        $image = checkInput($_FILES['image']['name']);
        $imagePath = '../images/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($name)){
            $nameError = "Ce champ ne peut pas être vide !";
            $isSuccess = false;
        }
        if(empty($description)){
            $descriptionError = "Ce champ ne peut pas être vide !";
            $isSuccess = false;
        }
        if(empty($price)){
            $priceError = "Ce champ ne peut pas être vide !";
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryError = "Ce champ ne peut pas être vide !";
            $isSuccess = false;
        }
        if(empty($image)){
            $imageError = "Ce champ ne peut pas être vide !";
            $isSuccess = false;
        }
        else{
            $isUploadSuccess = true;

            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
                $imageError = "Les extensions de fichier autorisées sont : .jpg, .png, .jpeg, .gif";
                $isUploadSuccess = false;
            }

            if(file_exists($imagePath)){
                $imageError = "Le fichier choisi existe déjà";
                $isUploadSuccess = false;
            }

            if($_FILES['image']['size'] > 500000){
                $imageError = "le fichier choisi est assez lourd, il ne doit pas doit pas dépasser les 500KB";
                $isUploadSuccess = false;
            }

            if($isUploadSuccess){
                if(!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){
                    $imageError = "Il y a eu une erreur lors de l'ajout du fichier";
                    $isUploadSuccess = false;
                }
            }
        }

        if($isSuccess && $isUploadSuccess){

            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) VALUES (?,?,?,?,?)");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: admin.php");
        }

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
        
            <h1><strong>Ajouter un item </strong></h1>
            <br>

            <form class="form" role="form" method="post" action="insert.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?php echo $description; ?>">
                    <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="prix">Prix: (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                    <span class="help-inline"><?php echo $priceError; ?></span>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie:</label>
                    <select name="category" id="categorie" class="form-control">

                        <?php
                        $db = Database::connect();
                        
                        foreach( $db->query("SELECT * FROM categories") as $row){
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        
                        Database::disconnect();
                        
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <div class="form-group">
                    <label for="image">Sélectionner une image:</label>
                    <input type="file" name="image" id="image">
                    <span class="help-inline"><?php echo $ImageError; ?></span>
                </div>
            
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="envoyer"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                <a href="admin.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
            </form>
            
        </div>
        
    </div>

</body>
</html>    