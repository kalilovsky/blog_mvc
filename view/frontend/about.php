<?php $title = 'A propos'; ?>

<?php ob_start(); ?>
<main>
    <div class="about">
        <div class="image">
            <img src="./ressource/img/profil.jpg" alt="" srcset="">
        </div>
        <div class="text">
            <h2>Bonjour</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Provident, hic pariatur, impedit officia necessitatibus
                non repellat id dolore sint eligendi culpa animi fugiat
                commodi consequatur nisi amet enim mollitia incidunt.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Provident, hic pariatur, impedit officia necessitatibus
                non repellat id dolore sint eligendi culpa animi fugiat
                commodi consequatur nisi amet enim mollitia incidunt.</p>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>
<?php require_once("./view/template.php");