<header>
    <nav>
        <ul>
            <li>
                <a href="index.php?page=home">
                    <span class="icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="titre">accueil</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=listArticles">
                    <span class="icon">
                        <i class="fas fa-concierge-bell"></i>
                    </span>
                    <span class="titre">recettes</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=about">
                    <span class="icon">
                        <i class="fas fa-info"></i>
                    </span>
                    <span class="titre">a propos</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=contactPage">
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
                            <span class="titre"><?= $_SESSION["pseudo"]  ?></span>
                        <?php }  ?>
                </a>
            </li>
        </ul>
    </nav>
    <div class="menuDeroulant" id="menuDeroulant">
        <?php if (!isset($_SESSION["userType"])) { ?>
            <form action="#" method="POST" class="formLogin">
                <div class="email">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="pwd">
                    <label for="pwd">Mot de passe</label>
                    <input type="password" name="pwd" placeholder="Mot de passe" required>
                </div>
                <div class="button">
                    <button name="submitAction" value="login">Login</button>
                </div>
            </form>
            <div>
                <p><a href="index.php?page=register">Register now!</a></p>
            </div>
        <?php } elseif ($_SESSION["userType"] == "admin") { ?>
            <div>
                <p><a href="index.php?page=adminDashboard">Tableau de bord</a></p>
                <p><a href="index.php?page=editUsersAdmin">Users</a></p>
                <p><a href="index.php?page=editCommentsAdmin">Comments</a></p>
                <p><a href="index.php?page=editArticlesAdmin">Articles</a></p>
                <p><a href="index.php?page=editMessagesAdmin">Messages</a></p>
            </div>
            <div>
                <p><a href="view/disconnect.php">Déconnection</a></p>
            </div>
        <?php } elseif ($_SESSION["userType"] == "normal") { ?>
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