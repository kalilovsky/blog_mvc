<main>
    <?php foreach ($results as $elem) : ?>
        <div class="completeReceipt" id="pageReceipt">
            <div class="image">
                <img src="./ressource/img/article/temp/<?= $elem['photoarticle'] ?>" alt="" srcset="">
            </div>
            <div class="details">
                <div class="accountImage">
                    <img src="./ressource/img/account/<?= $elem['photouser'] ?>" alt="" srcset="">
                </div>
                <p>&#8226;</p>
                <p><?= $elem["lastname"] . " " ?><?= $elem["firstname"] ?> </p>
                <p>&#8226;</p>
                <p><?= $elem["creationdate"] ?></p>
                <p>&#8226;</p>
                <p><?= $elem["catname"] ?></p>
            </div>
            <div class="receipt">
                <h2><?= $elem["title"] ?></h2>
                <p><?= substr($elem["smalldesc"], 0, 50) . "[...]" ?></p>
            </div>
            <form action="#" method="get" class="formDetail">
                <input type="hidden" name="idArticle" value=<?= $elem["idarticle"] ?>>
                <input type="hidden" name="controller" value="articlecontroller">
                <button name="action" value="showArticle">Voir plus</button>
            </form>
            <div class="comment">
                <i class="fas fa-comment-alt"></i>
                <p><?= $elem["countComment"] ?> Commentaires</p>
            </div>
        </div>
    <?php endforeach ?>
</main>