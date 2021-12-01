<h2> Gestion des professeurs </h2>

<?php
	$unControleur->setTable ("professeur");

	require_once("vue/vue_insert_professeur.php"); 

	if(isset($_POST["Valider"]))
	{
		$tab =array("nom"=>$_POST['nom'], 
				    "prenom"=>$_POST['prenom'], 
					"email"=>$_POST['email'], 
					"tel"=>$_POST['tel']
				);
		$unControleur->insert ($tab); 
	}

	if (isset($_POST['Rechercher']))
	{
		$mot = $_POST['mot']; 
		$like = array("nom", "prenom", "email", "tel");
		$lesProfesseurs = $unControleur->selectSearch($like, $mot); 
	}
	else {
		$lesProfesseurs = $unControleur->selectAll (); 
	}

	require_once ("vue/vue_les_professeurs.php");  
?>