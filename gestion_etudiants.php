<h2> Gestion des Etudiants </h2>

<?php

	$unControleur->setTable ("classe");
	$lesClasses = $unControleur->selectAll ();

	require_once("vue/vue_insert_etudiant.php"); 

	if(isset($_POST["Valider"]))
	{
		$unControleur->setTable ("etudiant");
		$tab =array("nom"=>$_POST['nom'], 
				    "prenom"=>$_POST['prenom'], 
					"email"=>$_POST['email'], 
					"tel"=>$_POST['tel'],
					"adresse"=>$_POST['adresse'], 
					"idclasse"=>$_POST['idclasse']
				);
		$unControleur->insert ($tab); 
	}

	$unControleur->setTable ("etudiants_classes");
	if (isset($_POST['Rechercher']))
	{
		$mot = $_POST['mot']; 
		$like = array("nom", "prenom", "email", "tel","adresse");
		$lesEtudiants = $unControleur->selectSearch($like, $mot); 
	}
	else {
		
		$lesEtudiants = $unControleur->selectAll (); 
	}

	require_once ("vue/vue_les_etudiants.php"); 
?>