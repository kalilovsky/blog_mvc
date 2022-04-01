<header>
    <nav>
        <ul>
            <li>
                <a href="index.php?controller=articlecontroller&action=index">
                    <span class="icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="titre">accueil</span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=articlecontroller&action=showAllArticles">
                    <span class="icon">
                        <i class="fas fa-concierge-bell"></i>
                    </span>
                    <span class="titre">recettes</span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=articlecontroller&action=showAbout">
                    <span class="icon">
                        <i class="fas fa-info"></i>
                    </span>
                    <span class="titre">a propos</span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=articlecontroller&action=showContactPage">
                    <span class="icon">
                        <i class="fas fa-address-book"></i>
                    </span>
                    <span class="titre">contact</span>
                </a>
            </li>
            <li id="loginArrow">
                <a href="#">
                    <span class="icon">
                        <i class="fas fa-caret-down"></i>
                        <?php if (!isset($_SESSION["mail"])) { ?>
                            <span class="titre">connexion</span>
                        <?php } else { ?>
                            <span class="titre"> <img src="ressource/img/account/<?=$_SESSION["photo"] ?>" alt="" srcset="">
                                <?= $_SESSION["pseudo"]  ?></span>
                        <?php }  ?>
                </a>
            </li>
        </ul>
    </nav>
    <div class="menuDeroulant" id="menuDeroulant">
        <?php if (!isset($_SESSION["userType"])) {
             if(isset($_SESSION["erreur"])){
                ?>
                <p style="color:red"> <?=$_SESSION["erreur"] ?> </p>
                <?php
            } ?>
            <form action="#" method="GET" class="formLogin">
                <div class="email">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="pwd">
                    <label for="pwd">Mot de passe</label>
                    <input type="password" name="pwd" placeholder="Mot de passe" required>
                    <input type="hidden" name="controller" value="userscontroller">
                </div>
                <div class="button">
                    <button name="action" value="login">Login</button>
                </div>
            </form>
            <div>
                <p><a href="index.php?controller=articlecontroller&action=showRegisterPage">Register now!</a></p>
            </div>
        <?php } elseif ($_SESSION["userType"] == "admin") { ?>
            <div>
                <p><a href="index.php?controller=articlecontroller&action=showAdminDashboard">Tableau de bord</a></p>
                <p><a href="index.php?controller=userscontroller&action=showEditUsersAdmin">Users</a></p>
                <p><a href="index.php?controller=commentcontroller&action=showeditCommentsAdmin">Comments</a></p>
                <p><a href="index.php?controller=articlecontroller&action=showEditArticlesAdmin">Articles</a></p>
                <p><a href="index.php?controller=articlecontroller&action=showAddArticlePage">Ajout Article</a></p>
                <p><a href="index.php?controller=messagecontroller&action=showEditMessagesAdmin">Messages</a></p>
            </div>
            <div>
                <p><a href="view/disconnect.php">Déconnection</a></p>
            </div>
        <?php } elseif ($_SESSION["userType"] == "author") { ?>
            <div>
                <p><a href="index.php?controller=articlecontroller&action=showAddArticlePage">Ajout Article</a></p>

                <p><a href="view/disconnect.php">Déconnection</a></p>
            </div>
        <?php } else{
            ?>
            <div>
                <p><a href="view/disconnect.php">Déconnection</a></p>
            </div>
       <?php } ?>
    </div>
    <div class="logo" id="logo">
        <div class="image">
            <img src="ressource/img/logo.png" alt="">
        </div>
        <div class="texte">
            <h1>aventures gustatives</h1>
        </div>
    </div>
</header>
<script>
    document.getElementById("loginArrow").addEventListener("click", e => {
        e.preventDefault();
        document.getElementById("menuDeroulant").classList.toggle("active");
    })
</script>