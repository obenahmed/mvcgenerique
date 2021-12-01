<?php
	session_start(); 
	require_once("controleur/config_bdd.php"); 
	require_once("controleur/controleur.class.php");
	$unControleur = new Controleur ($serveur, $bdd, $user, $mdp); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion de la scolarité </title>
</head>
<body>
<center>
	<h1> Gestion de la scolarité d'IRIS</h1>

	<?php
	if ( ! isset($_SESSION['email'])) {
		require_once("vue/vue_connexion.php"); 
	}
	if (isset($_POST['SeConnecter']))
	{
		$email = $_POST['email']; 
		$mdp = $_POST['mdp']; 
		$unControleur->setTable ("user"); 
		$where =array("email"=>$email, "mdp"=>$mdp);
		$unUser = $unControleur->selectWhere($where); 
		if (isset($unUser['email']))
		{
			$_SESSION['email'] = $unUser['email']; 
			$_SESSION['nom'] = $unUser['nom']; 
			$_SESSION['prenom'] = $unUser['prenom']; 
			$_SESSION['role'] = $unUser['role']; 
			header("Location: index.php");
		}else{
			echo "<br/> Erreur d'identifiants"; 
		}
	}
	if (isset($_SESSION['email'])) {
		echo '
	<a href="index.php?page=0">
			<img src="images/home.jpg" height="100" width="100">
	</a>
	<a href="index.php?page=1">
			<img src="images/classes.png" height="100" width="100">
	</a>
	<a href="index.php?page=2">
			<img src="images/professeurs.png" height="100" width="100">
	</a>
	<a href="index.php?page=3">
			<img src="images/etudiants.png" height="100" width="100">
	</a>
	<a href="index.php?page=4">
			<img src="images/enseignements.jpg" height="100" width="100">
	</a>
	<a href="index.php?page=5">
			<img src="images/deconnexion.jpg" height="100" width="100">
	</a>
	'; 
	}
	
	if (isset ($_GET['page'])) $page = $_GET['page']; 
		else $page = 0; 
		switch($page)
		{
			case 0 : require_once ("home.php") ; break; 
			case 1 : require_once ("gestion_classes.php") ; break; 
			case 2 : require_once ("gestion_professeurs.php") ; break; 
			case 3 : require_once ("gestion_etudiants.php") ; break; 
			case 4 : require_once ("gestion_enseignements.php") ; break; 
			case 5 : unset($_SESSION); session_destroy(); 
				header("Location: index.php");
				break; 
		}
	?>
</center>
</body>
</html>