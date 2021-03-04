<div id="contenu">
      <h2> Validation des fiches de frais</h2>
      
      <form action="index.php?uc=validefichefrais&action=fiche" method="post">
      <div class="corpsForm">
          <fieldset>
          <legend> Visiteurs et mois à selectionner</legend>
           <label  for = " lesvisiteurs " > Visiteur: </label>
          <select id="lesvisiteurs" name="lesvisiteurs">

                    <?php 
                    //$pdo->getLesVisiteurs();
                    foreach ( $lesVisiteurs  as  $unVisiteur ) {
                        $id  =  $unVisiteur ['id'];
                        $nom  =  $unVisiteur ['nom'];
                        $prenom  =  $unVisiteur ['prenom'];
                        if ($id  ==  $_SESSION['id']){
                            ?>
                            <option  selected  value ="<?php echo $id;?>" > <?php echo $nom . " " . $prenom ?> </option>        
                        <?php } else {
                            ?>
                            <option  value ="<?php echo $id;?>" > <?php echo $nom . " " . $prenom ?> </option >        
                            <?php
                        }
                    }
                    ?>
                
          </select>          
               
          <br><br>
                <label  for = " lstMois " > Mois: </label>
                <select id= "lstMois"  name = "lstMois" >
                    
                    
            <?php
             
                    $tableMois = $lesSixMois['id'];
                    $i = 0;
                    foreach ($tableMois as $mois) {
                        if ($mois == $lesVisiteurs['id']) {
                            
                        } else {
                            ?>
                            <option value="<?php echo $mois; ?>"><?php echo $lesSixMois['libelle'][$i]; ?></option> 
                            <?php
                        }
                        $i++;
                    } // A chaque fois qu'on passe dans le foreach le $id s'incremente, puis il affiche le numéro
                    // de la case des sixmois correspondant au numéro du $i
		   ?>      
                </select >
               
            </div>
            <div>
       
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p>
     
      </div>
      </div>
        
      </form>
