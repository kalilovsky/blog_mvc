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
    <div class="cards edit">
        <div class="resume">

            <div class="chiffre">
                <div class="qt" id="registredUser"><?= count($users); ?></div>
                <div class="denom">Utilisateurs enregistrés</div>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>

    </div>


    <div class="detail edit">
        <div class="recentActivity">
            <div class="textUp">
                <div class="texte">
                    Commentaires en Attente
                </div>

            </div>
            <table>
                <thead>
                    <tr>
                        <th>idUser</th>
                        <th>Photo</th>
                        <th>Pseudo</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $elem) : ?>
                        <tr class="editContent" data-id="<?= $elem["idusers"] ?>" id="<?= $elem["idusers"] ?>">
                            <td><?= $elem["idusers"] ?></td>
                            <td>
                                <img id="photo<?= $elem["idusers"] ?>" src="./ressource/img/account/<?= $elem["photouser"] ?>" data-src="<?= $elem["photouser"] ?>" alt="">
                            </td>
                            <td><?= $elem["pseudo"] ?></td>
                            <td><?= $elem["firstname"]  ?></td>
                            <td><?= $elem["lastname"]  ?></td>
                            <td><?= $elem["usertype"]  ?></td>
                        </tr>
                    <?php endforeach  ?>

                </tbody>
            </table>
        </div>

    </div>
    <div class="editPopup" id="editPopup">
        <div class="thePopup" id="thePopup">
            <div class="popUpCloseBtn" id="popUpCloseBtn">&times;</div>
            <div class="title">
                <h2>Détails du compte</h2>
            </div>
            <div class="body">
                <form action="" id="editPopupForm">
                    <div class="head user">
                        <div class="leftEdit">
                            <div class="sender">
                                <label for="">Pseudo :</label>
                                <input id="pseudo" name="pseudo" type="text" value="test" required>
                                <input id="idUsers" type="hidden" name="idusers">
                            </div>
                            <div class="email">
                                <label for="">Email :</label>
                                <input id="email" name="email" type="email" value="test" required>
                            </div>
                            <div class="nom">
                                <label for="">Nom</label>
                                <input id="firstname" name="firstname" type="text" value="test" required>
                            </div>
                            <div class="prénom">
                                <label for="">Prénom</label>
                                <input id="lastname" name="lastname" type="text" value="test" required>
                            </div>
                            <div class="userType">
                                <label for="">Role</label>
                                <select id="userType" name="usertype" required>
                                    <option value="admin">Admin</option>
                                    <option value="author">Autheur</option>
                                    <option value="normal">Normal</option>

                                </select>
                            </div>
                            <div class="pwd">
                                <label for="">Pwd : </label>
                                <input id="pwd" name="pwd" type="password" value="">
                            </div>
                        </div>
                        <div class="rightEdit">
                            <div class="photo">
                                <img id="photo" src="ressource/img/account/account_default.png" alt="" srcset="" data-src="account_default.png">
                            </div>
                            <div class="fileUpload">
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                        </div>

                    </div>

                    <div class="editButton">
                        <button name="updateButton" id="updateButton">Update</button>

                        <button name="deleteButton" id="deleteButton">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("logo").classList.add("hidden");
    Array.from(document.getElementsByClassName("editContent")).forEach(e => {
        e.addEventListener("click", () => {
            const url = "./controller/controller_fetch.php";
            let formData = new FormData();
            formData.append("submitAction", "getUser");
            formData.append("idUsers", e.dataset.id);
            const dataToSend = {
                method: "POST",
                body: formData
            }
            fetch(url, dataToSend)
                .then(data => data.json())
                .then(data => {
                    document.getElementById("pseudo").value = data.pseudo;
                    document.getElementById("firstname").value = data.firstname;
                    document.getElementById("lastname").value = data.lastname;
                    document.getElementById("email").value = data.email;
                    document.getElementById("idUsers").value = data.idusers;
                    document.getElementById("userType").value = data.usertype;
                    document.getElementById("photo").src = document.getElementById("photo").src.replace(document.getElementById("photo").dataset.src, data.photouser);
                    document.getElementById("photo").dataset.src = data.photouser;
                    document.getElementById("file").value = "";
                    document.getElementById("editPopup").classList.toggle("visible");
                });

        })
    })
    document.getElementById("popUpCloseBtn").addEventListener("click", () => {
        document.getElementById("editPopup").classList.toggle("visible");
    })
    document.getElementById("editPopupForm").addEventListener("submit", e => {
        e.preventDefault();
        switch (e.submitter.id) {
            case "updateButton": {
                let formData = new FormData(e.target);
                formData.append("submitAction", "updateUser");
                const url = "/controller/controller_fetch.php"
                const options = {
                    method: "post",
                    body: formData
                }
                fetch(url, options)
                    .then(data => data.json())
                    .then(data => {
                        let child = document.getElementById(data.idusers).children;
                        let img = child[1].querySelector("img");
                        img.src = img.src.replace(img.dataset.src, data.photouser);
                        img.dataset.src = data.photouser;
                        child[2].innerHTML = data.pseudo;
                        child[3].innerHTML = data.firstname;
                        child[4].innerHTML = data.lastname;
                        child[5].innerHTML = data.usertype;
                        document.getElementById("editPopup").classList.toggle("visible");
                    })
                break;
            }
            case "deleteButton": {
                let formData = new FormData(e.target);
                formData.append("submitAction", "deleteUser");
                const url = "/controller/controller_fetch.php"
                const options = {
                    method: "post",
                    body: formData
                }
                fetch(url, options)
                    .then(data => data.json())
                    .then(data => {
                        document.getElementById(data).remove();
                        document.getElementById("registredUser").innerHTML = ~~document.getElementById("registredUser").innerHTML -1;
                        document.getElementById("editPopup").classList.toggle("visible");
                    });
                break;
            }
        }
    })
    window.onclick = function(e) {
        if (e.target == document.getElementById("editPopup")) {
            document.getElementById("editPopup").classList.remove("visible");
        }
    }
</script>
<?php $content = ob_get_clean();
require_once("./view/template.php");
?>