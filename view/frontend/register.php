
<main>
    <?php if(!isset($_SESSION["mail"])){ ?>
    <form class="formRegister" id="formRegister" method="post">
        <div id="titreAndError">
            <h2>Inscription</h2>
            <p id="errorMsg"><?php if (isset($_SESSION["erreur"])) {
                                    echo $_SESSION["erreur"];
                                } ?></p>
        </div>
        <div class="allInput">

            <div class="row">
                <div>
                    <label for="firstname">Nom</label>
                    <input type="text" name="firstname" placeholder="Nom" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <label for="pwd">Mdp</label>
                    <input id="pwd1" type="password" name="pwd" placeholder="Mot de passe" required>
                </div>
            </div>
            <div class="row">
                <div>
                    <label for="lastname">Prénom</label>
                    <input type="text" name="lastname" placeholder="Prénom" required>
                </div>
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" placeholder="Pseudo" required>
                </div>
                <div>
                    <label for="pwd2">Mdp 2</label>
                    <input id="pwd2" type="password" name="pwd2" placeholder="Mot de passe2" required>
                </div>
            </div>
        </div>


        <div class="button">
            <input type="hidden" name="controller" value="userscontroller">
            <button type="submitAction" name="action" value="register" id="registerBtn">S'Inscrire</button>
        </div>
    </form>
    <?php }else{?>
        <div class="formRegister">
        <div id="titreAndError"> 
        <h2>Utilisateur déja connecté</h2>
        <p>Changez de page pour découvrir notre Blog!!</p>
    </div>
        </div>
        <?php } ?>
</main>
<script>
    // document.getElementById("registerBtn").addEventListener("click", e => {
    //     //e.preventDefault();
    //     let pwd1 = document.getElementById("pwd1");
    //     let pwd2 = document.getElementById("pwd2");
    //     if (pwd1.value != pwd2.value) {
    //         e.preventDefault();
    //         pwd2.setCustomValidity("Mots de passe non similaires.");
    //     } else {
    //         pwd2.setCustomValidity("");

    //         // let form = new FormData(document.getElementById("formRegister"));
    //         // form.append("submitAction", "register");

    //         // let url = "index.php";
    //         // let options = {
    //         //     method: "post",
    //         //     body: form
    //         // }

    //         // fetch(url,options)
    //         // .then($data => $data.text()
    //         // .then($data=>{

    //         // }));
    //     }
    // })
</script>

