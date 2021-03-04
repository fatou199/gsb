<?php
include("vues/v_comptable.php");
$action = $_REQUEST['action'];
//$idVisiteur = $_SESSION['idVisiteur'];

switch ($action) {
    case 'selectionnervisiteur': {
            $lesVisiteurs = $pdo->getLesVisiteurs(); // recupere les visiteurs
            $lesSixMois = getLesSixDerniersMois(); // recupere les six derniers mois
            include("vues/v_listeVisiteur.php");

            break;
        }
    case 'fiche': {
            
            $lesVisiteurs = $pdo-> getLesVisiteurs();
            $lesSixMois = getLesSixDerniersMois();
            $idVisiteur =isset($_REQUEST['lesvisiteurs']) ? $_REQUEST['lesvisiteurs'] : null; //vérifier si la variable est définie 
            $leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;// si le mois est definie il affiche le mois sinon il affiche null
            if ($idVisiteur && $leMois) {
                $_SESSION['lesvisiteurs'] = $idVisiteur;
                $_SESSION['lstMois'] = $leMois;
                
            }
            if(isset($_REQUEST['montantValide'])){ 
            $mois=$_SESSION['lstMois'];
            $idVisiteur=$_SESSION['lesvisiteurs'];
            print_r($mois);
            print_r($idVisiteur);
            $pdo->calculerMontantvalide($idVisiteur,$mois); //utilisation  de la requete de la fonction
            $etat="VA";
            $pdo->majEtatFicheFrais($idVisiteur,$mois,$etat); // modifie etat fiche frais
            }
            //$lesSixMois = getLesSixDerniersMois();
            $moisASelectionner = $leMois;
            //print_r($leMois);
            include("vues/v_listeVisiteur.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfaits($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
            $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteur, $mois);
            
            if(is_array($lesInfosFicheFrais)){ //si tableau lesInfosFicheFrais afficher ci dessous
            
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_etatFraisComp.php");
            
            
            }
            else{ // sinon afficher l'erreur
            ajouterErreur("Pas de fiche de frais pour ce visiteur ce mois-ci.");
            include("vues/v_erreurs.php");
        }
        break;
    }
        
    case 'modification': {
            ajouterValider("Informations mises à jour"); //
            require("vues/v_valider.php");
            
            $lesVisiteurs = $pdo-> getLesVisiteurs();
            $lesSixMois = getLesSixDerniersMois();
            $idVisiteur =isset($_REQUEST['lesvisiteurs']) ? $_REQUEST['lesvisiteurs'] : null;
            $leMois = isset($_REQUEST['lstMois']) ? $_REQUEST['lstMois'] : null;
            if ($idVisiteur && $leMois) {
                $_SESSION['lesvisiteurs'] =$idVisiteur;
                $_SESSION['lstMois'] = $leMois;
                
            }
            
            $leMois = $_SESSION['lstMois'];
            $idVisiteur = $_SESSION['lesvisiteurs'];
            $lesFrais = $_REQUEST['lesFrais'];
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
            
            include("vues/v_listeVisiteur.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfaits($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);  // cette partie permet d'actualiser la page
            $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteur, $mois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $nbJustificatif =isset($_REQUEST['nbJustificatifs']);
            $pdo->upjustif($idVisiteur, $leMois, $nbJustificatif);
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_etatFraisComp.php");
            break;
            
            }
        
        
        
    case 'ActionMajFraisHorsForfait': {
            $id = $_REQUEST['id'];
           $mois = $_SESSION["lstMois"];
                $idVisiteur = $_SESSION["idVisiteur"];
            if ($_REQUEST['name'] == "Supprimer") { //si name = supprimer faire la requete de la fonction refuser frais 
                $pdo->refuserfrais($id);
            } else {
                

                $numAnnee = substr($mois, 0, 4);
                $plusUnMois = substr($mois, 4, 2);
                if ($plusUnMois < 12) {  
                    $plusUnMois += 01;
                    $nouvMois = $numAnnee . $plusUnMois;
                } else {
                    $plusUnMois = '01';
                    $numAnnee += 1;
                    $nouvMois = $numAnnee . $plusUnMois;
                    
                }
                if($plusUnMois>0 && $plusUnMois<10 ){
                    $zero='0';
                    $nouvMois = $numAnnee .$zero. $plusUnMois;
                    
                }

                $pdo->reporter($idVisiteur, $mois, $id, $nouvMois);
            }
            echo'<META http-EQUIV="Refresh" CONTENT="1; url=index.php?uc=validefichefrais&action=fiche">';
            break;
        }
}

