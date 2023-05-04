
<<<<<<< HEAD:php/dashboard/dashboard.php
    <div class='dashboard'>  
        <?php 
            require('nav.php');
        ?>
=======
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://kit.fontawesome.com/2812e639d2.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <header>
                <img class="logo" src="../images/logo/sneakme-logo-clair.png">             
            </header>
            <nav class="dashboard-nav-list">
            <a href="#" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
                <a href="./deconnexion.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
            </nav>
        </div>
>>>>>>> 28ee23cf1014932845dfbb018b75d3532c79b009:php/dashboard.php
        <div class='dashboard-app'>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h1>Salut Boss !</h1>
                        </div>
                        <div class='card-body'>
                            <p>Bienvenue dans ton compte administrateur.</p>
                        </div>
                    </div>
                    <div class='card'>
                        <div class='card-header'>
                            <h2>Tableau de bord</h2>
                        </div>
                        <div class='card-body'>
                            <p>Ajoute un mot clé et sa phase associée.</p>
                        </div>
                        <form action="dashboard.php" method="post">
                            <div class="mb-3">
                                <label for="mots_cles" class="form-label">Mot clé :</label>
                                <input type="text" class="form-control" name="mots_cles" id="mot_cles" aria-describedby="textHelp">
                            </div>
                            <div class="mb-3">
                                <label for="reponse" class="form-label">Phrase associée :</label>
                                <input type="text" class="form-control" name="question" id="question">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    
                    <?php
                        require('../php/config.php');
                        require('../php/ajoutKeyword.php');

                    //Ajout des mots-clés via database SQL "sneakme_database.sql"    

                    $reponses = $_POST["question"];
                    $questions = $_POST["mots_cles"];

                    if ($reponses && $questions){
                        $insertion = "INSERT INTO motscles (question, mots_cles) VALUES ('$questions', '$reponses')";

                        $result =$connexion->query($insertion);
                        if ($result == true) {
                            echo "<p>Les lignes de couleurs différentes de sneakers ont été insérées avec succès</p>";
                        } else {
                            echo "<p>Erreur lors de l'insertion des lignes</p>" . $connexion->error;
                        }
                    } 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</html>