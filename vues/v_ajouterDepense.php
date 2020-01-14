

<div class="form-style-5">

        <form method="post" action="index.php?uc=depense&action=ajouterDepense">
        <fieldset>
        <legend align="center">Ajouter une depense</legend><br>
        <input type="number" min="0" name="montant" placeholder="Montant *" required="required">
        <input type="text" pattern="[A-Za-z]{1,20}" name="libelle" placeholder="Libelle *" required="required">
        

</fieldset>


<input type="submit" name="envoyer" value="Envoyer" />
</form>
</div>