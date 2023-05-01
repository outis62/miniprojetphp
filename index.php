<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap-5.2.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/register.css">
    <title>Inscription Apprenant.e.s P04</title>
</head>

<body>
   
    <div class="body">
        <div class="veen">
            <div class="login-btn splits">
                <p>Vous avez un compte</p>
                <button class="active">Connectez-vous</button>
            </div>
            <div class="rgstr-btn splits">
                <p>Vous n'avez pas un compte</p>
                <button>Inscrivez-vous</button>
            </div>
            <div class="wrapper">
                <form id="login" tabindex="500" method="CONNECTION">
                    <h3>Connexion</h3>
                    <div class="mail">
                        <input type="text" name="nom" id="nom" required>
                        <label>Nom de famille</label>
                    </div>
                    <div class="passwd">
                        <input type="password" name="mdp" id="mdp" required>
                        <label>Mot de passe</label>
                    </div>
                    <div class="submit">
                    <input type="submit" name="submit" value="Se connecter">
                    </div>
                    <img src="images/simplon.jpg" width="80" height="80" alt="">
                </form>
                <form id="register" tabindex="502" method="POST">
                    <h3>Inscription <img src="images/simplon.jpg" width="60" height="60" alt=""></h3>
                    <div class="name">
                        <input type="text" name="nom" required>
                        <label>Nom de famille</label>
                    </div>
                    <div class="prenom">
                        <input type="text" name="prenom" required>
                        <label>Prenom</label>
                    </div>
                    <div class="uid">
                        <input type="date" name="date_naissance" required>
                        <label>Date de naisance</label>
                    </div>
                    <div class="passwd">
                        <input type="password" name="mdp" required>
                        <label>Mot de passe</label>
                    </div>
                    <div>
                    <input type="submit" name="submit" value="Enregistrer">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
	// Vérifie si le formulaire est soumis
	if(isset($_POST['submit'])){
		// Récupère les données du formulaire
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$date_naissance = $_POST['date_naissance'];
		$mdp = $_POST['mdp'];

		include ('connexionbd.php');


			// Prépare et exécute la requête SQL d'insertion
			$sql = "INSERT INTO apprenant (nom, prenom, date_naissance, mdp) VALUES (:nom, :prenom, :date_naissance, :mdp)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':nom', $nom);
			$stmt->bindParam(':prenom', $prenom);
			$stmt->bindParam(':date_naissance', $date_naissance);
			$stmt->bindParam(':mdp', $mdp);
			$stmt->execute();

			echo '<p style="color=black;">Les informations ont été enregistrées avec succès.</p>';
			

	}
	?>

    <!-- Connexion et redirection vers la liste des inscrits -->
    <?php
		// Connexion à la base de données
        include('connexionbd.php');

		// Vérification si le formulaire a été soumis
		if (isset($_CONNECTION['submit'])) {
			// Récupère les données du formulaire
			$nom = $_CONNECTION['nom'];
			$mdp = $_CONNECTION['mdp'];

			$sql = "SELECT * FROM apprenant WHERE nom='$nom' AND mdp='$mdp'";
			$requete = $conn->prepare($sql);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':mdp', $mdp);
            $requete->execute();
			if ($requete->rowCount() == 1) {
                // La requête a retourné une seule ligne de résultat
                $resultat = $requete->fetch(PDO::FETCH_ASSOC);
                echo'<p style="color=black;">Connecter avec succes!</p>';
                header('Location: inscrit.php');
                exit();
            } else {
				// Si les informations de connexion sont incorrectes, afficher un message d'erreur
				echo '<p style="color:red;">Nom ou mot de passe incorrect</p>';
			}
		}
	?>

    
     <script  src="script/jquery.3.1.1.min.js"></script>
     <script src="script/register.js"></script>
 
</body>

</html>