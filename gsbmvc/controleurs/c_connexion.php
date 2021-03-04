<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
                        $identite = $visiteur['identite'];
			connecter($id,$nom,$prenom);
                        switch ($identite){ // distingue l'identite 
                            case 'v':{          //si il est dans 'v' il affiche la vue sommaire
                            include("vues/v_sommaire.php");
                            break;
                        }
                            case 'c':{ //si il est dans 'c' il affiche la vue comptable et bienvenue
                            include ("vues/v_comptable.php");
                            include("vues/v_bienvenue.php");
                            break;
                        }
                        }  
                
         }
	 break;
     
         }
	default :{
		include("vues/v_connexion.php");
		break;
            
	}
}
?>