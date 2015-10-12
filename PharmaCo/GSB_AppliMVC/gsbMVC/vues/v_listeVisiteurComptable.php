 <div id="contenu">
      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=gererFrais&action=fraisVisiteurComptable" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Visiteur : </label>
        <select name="lstVisiteur">
            <?php
			foreach ($lesVisiteurs as $unVisiteur)
			{
                                $id = $unVisiteur['id'];
				$nom =  $unVisiteur['nom'];
				$prenom =  $unVisiteur['prenom'];?>
				<option value="<?php echo $id ?>"><?php echo  $nom."  ".$prenom ?> </option>
				<?php 
				
				
			
			}
                        
           
		   ?>    
                                <input type ="hidden" id ="mois" name ="mois" value = "<?php echo $mois ?>">    
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>