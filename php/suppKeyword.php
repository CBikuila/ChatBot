<!DOCTYPE html>
<html>
    <head>
        <title>Boutton supprimer SQL</title>
        <meta charset='utf-8'>
    </head>
    <body>
        <h1>Bases de données MySQL</h1>  
        <?php

            $servername = "localhost"; $email = "root"; $password = "root"; $dbname = "sneakme_database";
            
            try{
                $dbco = new PDO("mysql:localhost=$servername;snea=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                /*Supprime l'entrée avec l'id = 8 
                $user_id = 8;
                $req = $dbco->prepare("DELETE FROM users WHERE id = :user_id");
                $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $req->execute();
                */
                
                //Supprime toutes les entrées de la table 
                $user_id = 0;
                $req = $dbco->prepare("DELETE FROM motscles WHERE motscles_id >= :user_id");
                $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $req->execute();
                echo 'Données supprimées';
            }
                  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        ?>
    </body>
</html>