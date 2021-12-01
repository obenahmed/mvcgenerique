<h2> Gestion des Enseignements </h2>

<?php

	$unControleur->setTable ("professeur");
	$lesProfesseurs = $unControleur->selectAll ();

	$unControleur->setTable ("classe");
	$lesClasses = $unControleur->selectAll ();

	

	require_once("vue/vue_insert_enseignement.php"); 

	if(isset($_POST["Valider"]))
	{
		$unControleur->setTable ("enseignement");
		$tab =array("matiere"=>$_POST['matiere'], 
				    "coef"=>$_POST['coef'], 
					"nbheures"=>$_POST['nbheures'], 
					"idclasse"=>$_POST['idclasse'],
					"idprofesseur"=>$_POST['idprofesseur']
				);
		$unControleur->insert ($tab); 
	}

	$unControleur->setTable ("enseignements");
	if (isset($_POST['Rechercher']))
	{
		$mot = $_POST['mot']; 
		$like = array("matiere", "coef", "nbHeures");
		$lesEnseignements = $unControleur->selectSearch($like, $mot); 
	}
	else {
		$unControleur->setTable ("enseignements");
		$lesEnseignements = $unControleur->selectAll (); 
	}
  
	require_once ("vue/vue_les_enseignements.php"); 
?>