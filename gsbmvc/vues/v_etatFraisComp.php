<div class="corpsForm">
    <fieldset>
          <legend> Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : </legend>

    <p>
        Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>
    </p>
    
    <form method="POST"  action="index.php?uc=validefichefrais&action=modification">
    
    <table class="listeLegere">
        

        <caption>Eléments forfaitisés </caption>
        <tr>
            <?php
            ?>
            
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle'];
                
                ?>	
                <th> <?php echo $libelle ?></th>
                <?php
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite'];
                $idFraisForfait = $unFraisForfait['idfrais'];
                ?>
                <td class="qteForfait"><input name="lesFrais[<?php echo $idFraisForfait ?>]" size="16,5" type="number" value="<?php echo $quantite; ?>"/></td>
                <?php
            }
            ?>
        </tr>
    </table>
    <p align="right">
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
    </p> 
    </form>
    
   
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait - 
            <input type="number" id="nbJustificatifs" name="nbJustificatifs" size="10" maxlength="5"
            value="<?php echo $nbJustificatifs ?>"> justificatifs reçus </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
            <th colspan="2" style="text-align:center;">Action</th>
            
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = $unFraisHorsForfait['libelle'];
            $montant = $unFraisHorsForfait['montant'];
            $id=$unFraisHorsForfait['id'];
      
                    $refuse = 'REFUSE';
                    $pos1 = strncmp($refuse, $unFraisHorsForfait["libelle"], 6); //Comparer deux chaînes
                    ?>

        <tr
            <?php
                    if ($pos1 == 0) {
                        echo ' class="rouge"'; // 0 si les deux chaines sont egales, et puis permet d'afficher la case en rouge
                        // si il affiche un libelle REFUSE
                    }
       
                    ?>>
            
        <form method="POST"  action="index.php?uc=validefichefrais&action=ActionMajFraisHorsForfait">
            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td>  <input
                            <?php if ($pos1 == 0) {
                                echo 'disabled="disabled"'; // desactive le bouton supprimer quand pos1 est à 0
                            }
                            ?>
                        id="ok" type="submit" name="name" value="Supprimer" size="20" /></td>
                <td> <input id="ok" type="submit" name="name" value="Reporter" size="20" /></td>
                </form>
        
                
            </tr>
            
    <?php
}
?>
    </table>
    

    <p align="right">
    <form method="POST"  action="index.php?uc=validefichefrais&action=fiche">
    <input id="ok" type="submit" name="montantValide" value="Valider La Fiche" size="20" />
</form>
</fieldset>
</div>
    </p>  

</div>
</div>

