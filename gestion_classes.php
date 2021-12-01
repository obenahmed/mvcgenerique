<h2> Gestion des classes </h2>

<?php
	if (isset($_SESSION['email']) and $_SESSION['role'] =="admin")
	{
		$unControleur->setTable ("classe");
		$laClasse = null; 
		if (isset($_GET['action']) and isset($_GET['idclasse']))
		{
			$action = $_GET['action']; 
			$idclasse = $_GET['idclasse']; 
			switch ($action)
			{
				case "sup" : 
					$where = array("idclasse"=>$idclasse); 
					$unControleur->delete ($where); 
					break; 
				case "edit" : 
					$where = array("idclasse"=>$idclasse);
					$laClasse = $unControleur->selectWhere ($where); 

					break;
			}
		}

		require_once("vue/vue_insert_classe.php"); 
		if(isset($_POST["Modifier"]))
		{
			$tab =array("nom"=>$_POST['nom'], 
					    "salle"=>$_POST['salle'], 
						"diplome"=>$_POST['diplome']);
			$where = array("idclasse"=>$_GET['idclasse']);

			$unControleur->update ($tab, $where); 
			header("Location: index.php?page=1");
		}

		if(isset($_POST["Valider"]))
		{
			$tab =array("nom"=>$_POST['nom'], 
					    "salle"=>$_POST['salle'], 
						"diplome"=>$_POST['diplome']);
			$unControleur->insert ($tab); 
		}
	} //fin if isset 

	$unControleur->setTable ("classe");
	if (isset($_POST['Rechercher']))
	{
		$mot = $_POST['mot']; 
		$like = array("nom", "salle", "diplome");
		$lesClasses = $unControleur->selectSearch($like, $mot); 
	}
	else {
		$lesClasses = $unControleur->selectAll (); 
	}

	require_once ("vue/vue_les_classes.php"); 
?>