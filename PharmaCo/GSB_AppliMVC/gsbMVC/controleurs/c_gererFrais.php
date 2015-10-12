<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
                    if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
                    }
                    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                    $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                    include("vues/v_listeFraisForfait.php");
                    include("vues/v_listeFraisHorsForfait.php");
		break;
	}
	case 'validerMajFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                include("vues/v_listeFraisForfait.php");
                include("vues/v_listeFraisHorsForfait.php");
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
		}
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                include("vues/v_listeFraisForfait.php");
                include("vues/v_listeFraisHorsForfait.php");
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
                $pdo->supprimerFraisHorsForfait($idFrais);
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                include("vues/v_listeFraisForfait.php");
                include("vues/v_listeFraisHorsForfait.php");
		break;
	}
        case 'listeMois':{
            $lesMois = $pdo->LesMois();
            include("vues/v_listeMoisComptable.php");
            break;
        }
        case 'listeVisiteur':{
            $mois = $_REQUEST['lstMois'];
            $lesVisiteurs = $pdo->lesVisiteurs($mois);
            include("vues/v_listeVisiteurComptable.php");
            break;
        }
        case 'fraisVisiteurComptable':{
            $mois = $_POST['mois'];
            $idVisiteur = $_REQUEST['lstVisiteur'];
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
            $ficheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
            include('vues/v_ficheFraisComptable.php');
            break;
        }
        
}


?>