
 <div class="form-style-5">
<form method="post" action="index.php?uc=commercial&action=modifCommercial">
<fieldset>
        <legend align="center">Choisir le commercial à modifier</legend><br>
<select class="select" name="idCommercial">
<?php

foreach ($lesCommerciaux as $unCommercial){
    ?>

    <option <?php if(isset($_POST['idCommercial']) && $commerciauxDao->getIdCommercial($unCommercial) == $_POST["idCommercial"]){echo 'selected';} ?>
    value=" <?php echo $commerciauxDao->getIdCommercial($unCommercial) ?>"> <?php echo $unCommercial->getNom()." ".$unCommercial->getPrenom() ?></option>';

                                            <?php
                                            }
                                            ?> 
</select>
<input type="submit" value="valider" name="valider">
</form>
 <br>