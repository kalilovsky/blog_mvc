<?php
if ($_SESSION["userType"] != "admin") {
    $title = "Not Authorised";
    ob_start();
?>
    <div class="dashboard active" id="dashboard">
        <p>Vous n'êtes pas autoriser à voir cette page.</p>
    </div>
<?php
    $content = ob_get_clean();
    require_once("./view/template.php");
    exit();
}
$title = "Tableau de bord";
ob_start(); ?>
<div class="dashboard active" id="dashboard">
    <div class="cards">
        <div class="resume">
            <a href="index.php?page=editUsersAdmin"></a>
            <div class="chiffre">
                <div class="qt"><?= $countUsers; ?></div>
                <div class="denom">Utilisateurs enregistrés</div>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="resume">
            <a href="index.php?page=editCommentsAdmin"></a>
            <div class="chiffre">
                <div class="qt"><?= count($allComments)  ?></div>
                <div class="denom">Commentaires non approuvés</div>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
        </div>
        <div class="resume">
            <a href="index.php?page=editArticlesAdmin"></a>
            <div class="chiffre">
                <div class="qt"><?= count($allArticles) ?></div>
                <div class="denom">Articles postés</div>
            </div>
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
        <div class="resume">
            <a href="index.php?page=editMessagesAdmin"></a>
            <div class="chiffre">
                <div class="qt"><?= count(array_filter($allMessages,function($val){
                    return $val["status"]==0;
                })) ?></div>
                <div class="denom">Messages non lus</div>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>
    <div class="detail">
        <div class="recentActivity">
            <div class="textUp">
                <div class="texte">
                    Commentaires en Attente
                </div>

            </div>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Article</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allComments as $elem) : ?>
                        <tr>
                            <td><?= $elem["pseudo"] ?></td>
                            <td><?= $elem["title"] ?></td>
                            <td><?= $elem["datecreated"]  ?></td>
                            <td><?= $elem["status"]  ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>
        <div class="recentUser">
            <div class="resume">
                <div class="chiffre">
                    <div class="qt">Message non lus</div>
                </div>

            </div>
            <?php foreach ($allMessages as $elem) : 
                if (!$elem["status"]){?>
                
                <div class="user">
                    <!-- <div class="photo">
                    <img src="./ressources/account_default.png" alt="" srcset="">
                </div> -->
                    <div class="userInfo">
                        <div class="pseudo">
                            <?= $elem["senderemail"] ?>
                        </div>
                        <div class="mail">
                            <?= substr($elem["content"], 0, 20) . "[...]"  ?>
                        </div>
                    </div>
                </div>
            <?php }
             endforeach  ?>


        </div>
    </div>
</div>
<script>
    document.getElementById("logo").classList.add("hidden");
</script>
<?php $content = ob_get_clean();
require_once("./view/template.php");
?>