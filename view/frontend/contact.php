
<main>
<form action="#" method="GET" class="formContact">
        <div class="email">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="message">
            <label for="message">Message</label>
            <textarea type="text" name="message" placeholder="Votre message" rows="5" required></textarea>
        </div>
        <div class="button">
            <input type="hidden" name="controller" value="messagecontroller">
            <button type="submit" name="action" value="sendMessage">Envoyer</button>
        </div>
    </form>
</main>
