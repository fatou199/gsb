<?php

include("vues/v_comptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

switch ($action){
    case'selectionnerfichedefrais':{
            $ListeFicheFrais=$pdo->ListeFicheValider();
            if($ListeFicheFrais==null){echo ajouterErreur("Il n'y a aucune fiche validée"); 
            // si il y a pas de fiche à validé afficher une erreur
                include("vues/v_erreurs.php");}else{
                include("vues/v_ListeFicheFrais.php");}
                           break;
    }
        
        
       case'voirFrais': {
           
            $ListeFicheFrais=$pdo->ListeFicheValider();
            include("vues/v_ListeFicheFrais.php");
            $leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;
            $idVisiteur = $_SESSION['lesvisiteurs'];
            if ($idVisiteur && $leMois) {
                $_SESSION['lesvisiteurs'] = $idVisiteur;
                $_SESSION['lstMois'] = $leMois;         
            }
            //print_r($idVisiteur);
            $leMois = $_SESSION['lstMois']; 
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                $moisASelectionner = $leMois;
                           
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
                $numAnnee =substr( $leMois,0,4);           
                $numMois =substr( $leMois,4,2);
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif =  $lesInfosFicheFrais['dateModif'];
                $dateModif =  dateAnglaisVersFrancais($dateModif);           

            include("vues/v_etatvalide.php");
            if(isset($_REQUEST['rembourser'])){
            $mois=$_SESSION['lstMois'];
            $etat='RB';
        $pdo->majEtatFicheFrais($idVisiteur,$mois,$etat);
        }
break;

            }
       
}
