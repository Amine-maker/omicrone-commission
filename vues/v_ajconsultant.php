<div class="container">
    <div class="form-style-5">
        <form method="post" action="index.php?uc=consultant&action=validajoutconsultant">
            <fieldset>
                <input type="text" pattern="[A-Za-z]{1,20}" name="nom" placeholder="Nom *" required="required">
                <input type="text" pattern="[A-Za-z]{1,20}" name="prenom" placeholder="Prenom *" required="required">
                <input type="text" name="adr" placeholder="Adresse *" required="required">
                <input type="text" pattern="[A-Za-z]{1,20}" name="ville" placeholder="Ville *" required="required">
                <input type="number" min="0" name="cp" placeholder="Code Postal *" required="required">
                <input type="text" pattern="[0-9]{10}" name="tel" placeholder="Numero de telephone *" required="required">
                <input type="email" name="email" placeholder="Email *" required="required">
                <input type="submit" name="envoyer" value="Ajouter" />
            </fieldset>
        </form>
    </div>
</div>