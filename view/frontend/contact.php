<?php $title = 'Contact';
ob_start();?>
<main>
<form action="#" method="POST" class="formContact">
        <div class="email">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="message">
            <label for="message">Message</label>
            <textarea type="text" name="message" placeholder="Votre message" rows="5" required></textarea>
        </div>
        <div class="button">
            <button type="submit" name="submitAction" value="messageSubmit">Envoyer</button>
        </div>
    </form>
</main>
<?php $content = ob_get_clean(); ?>
<?php require_once("./view/template.php");