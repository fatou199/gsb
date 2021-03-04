<div id="contenu"> 
      <h2>Suivi des fiches de frais</h2>

<div class="corpsForm">
    <form action="index.php?uc=suivifrais&action=voirFrais" method="post">
         <fieldset>
              <legend>Fiches des visiteurs et mois à selectionner</legend>
              
              <p>

                <label for="lstFiche" accesskey="n">Visiteur : </label>
                <select id="lstFiche" name="lstFiche">
                    <?php
                      foreach ($ListeFicheFrais as $uneFiche) {
                         echo  "<option value=". $uneFiche['id'] . ">" . $uneFiche['mois'] ." - ". $uneFiche['nom'] . " " . $uneFiche['prenom'] . "</option>";
                    }
                    ?>   
                   

                </select>
            </p>
        
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                
            </p> 

        </div>
         </fieldset>
</form>
    </div>
