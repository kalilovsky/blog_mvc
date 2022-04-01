

<main>
    <div class="homeUser">
        <section class="firstPart">
            <h1>Bienvenue sur Aventures Gustatives !</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Quidem iure voluptates eveniet praesentium optio adipisci
                unde ipsam vitae porro? Non tempore, reprehenderit ex aut
                iste eum fugiat quo, neque fuga quidem enim vero quaerat
                vel, praesentium laboriosam! Iste sequi dolor distinctio,
                suscipit quisquam consequuntur exercitationem et velit.
                Perferendis, obcaecati. Repellat velit expedita omnis voluptate
                error non ut voluptates explicabo inventore obcaecati corporis
                quis aliquam laudantium fugiat sed animi minus exercitationem
                fuga reiciendis suscipit, incidunt placeat nam delectus sequi.
                Sit, ad?</p>
        </section>
        <section class="secondPart">
            <div class="left">
                <div class="firstText">
                    <h3>Bonjour</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Omnis voluptas numquam natus totam soluta molestiae alias,
                        voluptate quas dolorem incidunt repellendus officia?
                    </p>
                </div>
                <div class="icons">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="rating">
                    <p id="star">&#9733;</p>
                    <p id="text">
                        Elu meilleur blog culinaire
                    </p>
                </div>
                <div class="lastReceipt">
                    <p>Ma dernière recette</p>
                </div>
                <div class="receiptLeft">
                    <div class="image">
                        <img src="./ressource/img/pasta.jpg" alt="" srcset="">
                    </div>

                    <div class="receipt">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                    </div>
                    <form action="#" method="GET" class="formDetail">
                        <button>Voir plus</button>
                    </form>

                </div>
            </div>
            <div class="right">
                <?php foreach($results as $elem) :?>
                <div class="completeReceipt">
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
                    <form action="#" method="GET" class="formDetail">
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
            </div>
        </section>
    </div>
</main>
