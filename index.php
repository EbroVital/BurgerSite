<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
   
     <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/style.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <title>Burger Site</title>

</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <a href="admin/login.php" class="btn btn-primary" style="margin:10px 0;">Se Connecter</a>
        </div>
    </nav>

    <div class="container site">
        <h1 class="text-logo" style="padding:70px 0;"> <span class="glyphicon glyphicon-cutlery"></span> Burger Site <span class="glyphicon glyphicon-cutlery"></span></h1>
        
        <?php
            require 'admin/database.php';
            echo '<nav>
                    <ul class="nav nav-pills">';
                $db = Database::connect();
                $statement = $db->query("SELECT * FROM categories");
                $categories = $statement->fetchAll();

                foreach($categories as $category){

                    if($category['id'] == '1')
                       echo '<li role="presentation" class="active"><a href="#' . $category['id'] . '" data-toggle="tab">'.$category['name']. '</a></li>';
                    else
                        echo '<li role="presentation"><a href="#' . $category['id'] . '" data-toggle="tab">'.$category['name']. '</a></li>';
                }
                
            echo    '</ul>
                </nav>';
            
            echo '<div class="tab-content">';    

            foreach($categories as $category){

                if($category['id'] == '1')
                    echo '<div class="tab-pane active" id="'. $category['id'] .'">';
                else
                     echo '<div class="tab-pane" id="'. $category['id'] .'">';

                echo '<div class="row">';     
                $statement = $db->prepare("SELECT * FROM items WHERE items.category = ?");
                $statement->execute(array($category['id']));

                while ($item = $statement->fetch()) {
                    
                    echo '<div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="images/' . $item['image'] .'" alt="...">
                                 <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                <div class="caption">
                                   <h4>'. $item['name'] .'</h4> 
                                   <p>'. $item['description'] .'</p>
                                    <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                                </div>
                            </div>
                          </div>';
                }
                echo '</div>
                    </div>';
            }

            Database::disconnect();
            
            echo '</div>';
        ?>

    </div>
</body>
</html>