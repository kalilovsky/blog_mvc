<?php $title = 'Acceuil'; ?>

<?php ob_start(); ?>
<main>
    <?php foreach($results as $elem):?>
    <div class="completeReceipt" id="pageReceipt">
        <div class="image">
        <img src="./ressource/img/article/temp/<?= $elem['photoarticle']?>" alt="" srcset="">
        </div>
        <div class="details">
            <div class="accountImage">
            <img src="./ressource/img/account/<?= $elem['photouser']?>"  alt="" srcset="">
            </div>
            <p>&#8226;</p>
                        <p><?= $elem["lastname"]." " ?><?= $elem["firstname"] ?> </p>
                        <p>&#8226;</p>
                        <p><?= $elem["creationdate"] ?></p>
                        <p>&#8226;</p>
                        <p><?= $elem["catname"] ?></p>
        </div>
        <div class="receipt">
        <h2><?= $elem["title"] ?></h2>
                        <p><?= substr($elem["smalldesc"],0,50)."[...]" ?></p>
        </div>
        <form action="#" method="post" class="formDetail">
                        <input type="hidden" name="idArticle" value=<?= $elem["idarticle"] ?>>
                        <button name="submitAction" value="moreDetail">Voir plus</button>
                    </form>
        <div class="comment">
            <i class="fas fa-comment-alt"></i>
            <p><?= $elem["countComment"] ?> Commentaires</p>
        </div>
    </div>
    <?php endforeach ?>
</main>
<?php $content = ob_get_clean(); ?>
<?php require_once("./view/template.php");