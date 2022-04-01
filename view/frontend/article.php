
<main>
    <div class="theReceipt">
        <div class="details">
            <div class="accountImage">
                <img src="./ressource/img/account/<?= $results[0]["photouser"] ?>" alt="" srcset="">
            </div>
            <p>&#8226;</p>
            <p><?= $results[0]["lastname"] . " " ?><?= $results[0]["firstname"] ?> </p>
            <p>&#8226;</p>
            <p><?= $results[0]["creationdate"] ?></p>
            <p>&#8226;</p>
            <p><?= $results[0]["catname"] ?></p>
        </div>
        <div class="receipt">
            <h2><?= $results[0]["title"] ?></h2>
            <p><?= $results[0]["smalldesc"] ?></p>
        </div>
        <div class="image">
            <img src="./ressource/img/article/temp/<?= $results[0]["photoarticle"] ?>" alt="" srcset="">
        </div>

        <div class="receiptInstructions">
            <p><?= $results[0]["content"] ?></p>
        </div>
        <?php if (count($commentsResult) > 0) { ?>
            <div class="comment">
                <i class="fas fa-comment-alt"></i>
                <p class="numberComment"><?= count($commentsResult); ?> Commentaires</p>

            </div>
            <?php foreach ($commentsResult as $elem) :
                if ($elem["status"] == 1) { ?>
                    <div class="commentContent">

                        <p class="commentContentText"><?= $elem["contentcomment"] ?></p>
                        <p class="author">Rédigé par <?= $elem["sender"] . " " . $elem["firstname"] ?>, le <?= $elem["datecreated"] ?></p>
                    </div>
            <?php }
            endforeach;
        } else { ?>
            <div class="comment">
                <i class="fas fa-comment-alt"></i>
                <p class="numberComment">0 Commentaires</p>
            </div>
        <?php } ?>
    </div>
    <?php if (isset($_SESSION["mail"])) { ?>
        <form action="#" method="GET" class="formComment" id="formComment">
            <div>
                <p id="message" style="color: green;"></p>
            </div>
            <div class="pseudo">
                <label for="pseudo">Pseudo</label>
                <input id="pseudo" type="text" name="pseudo" placeholder="Pseudo" value="<?= $_SESSION["pseudo"] ?>">
            </div>
            <div class="comment">
                <label for="comment">Commentaires</label>
                <textarea id="comment" type="text" name="comment" placeholder="Commentaires" rows="5"></textarea>
            </div>
            <input type="hidden" name="idArticle" value="<?= $results[0]["idarticle"] ?>">
            <input type="hidden" name="idUser" value="<?= $_SESSION["idUser"] ?>">
            <div class="button">
                <input type="hidden" name="controller" value="commentcontroller">
                <button type="action" name="postComment">Envoyer</button>
            </div>
        </form>
    <?php } ?>
    <div class="recentReceipts">
        <?php foreach ($articles as $elem) : ?>
            <div class="receipt1">
                <div class="completeReceipt">
                    <div class="image">
                        <img src="./ressource/img/article/temp/<?= $elem["photoarticle"] ?>" alt="" srcset="">
                    </div>
                    <div class="details">
                        <div class="accountImage">
                            <img src="./ressource/img/account/<?= $elem["photouser"] ?>" alt="" srcset="">
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
            </div>
        <?php endforeach ?>
    </div>
</main>
<?php if (isset($_SESSION["mail"])) { ?>
<script>
    document.getElementById("formComment").addEventListener("submit", e => {
        e.preventDefault();
        let form = e.currentTarget;
        const url = "./controller_fetch.php";
        let formData1 = new FormData(form);
        formData1.append("submitAction", "commentSubmit");
        const options = {
            method: "post",
            body: formData1
        }
        fetch(url, options)
            .then(data => data.text())
            .then(data => {

                document.getElementById("comment").value = "";
                document.getElementById("pseudo").value = "";
                document.getElementById("message").innerHTML = "Commentaires posté en attente de validation."
            })
    })
</script>
<?php } ?>

