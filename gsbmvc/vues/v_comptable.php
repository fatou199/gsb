  <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>  
        <ul id="menuList">
			<li >
				  Comptable :<br>
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
			
                     </li>
                     
                     
                     </li>
           <li class="smenu">
              <a href="index.php?uc=validefichefrais&action=selectionnervisiteur" title="Valider fiche de frais ">Valider les fiches de frais</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=suivifrais&action=selectionnerfichedefrais" title="Suivi des fiches de frais">Suivi des fiches de frais</a>
           </li>   
        <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
         </ul>
        
    </div>
  
 