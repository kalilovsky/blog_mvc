<?php
if ($_SESSION["userType"] != "admin") {
    $title = "Not Authorised";
    
?>
    <div class="dashboard active" id="dashboard">
        <p>Vous n'êtes pas autoriser à voir cette page.</p>
    </div>
<?php
    
} else{

 ?>
<div class="dashboard active" id="dashboard">
    <div class="cards edit">
        <div class="resume">

            <div class="chiffre">
                <div class="qt"><?= count($allArticles); ?></div>
                <div class="denom">Articles postés</div>
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
                    Liste des Articles
                </div>
                <button>
                    <a href="index.php?controller=articlecontroller&action=showaddArticlepage">New Article</a>
                </button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>idarticle</th>
                        <th>Titre</th>
                        <th>Catègorie</th>
                        <th>Auteur</th>
                        <th>Creation Date</th>
                        <th>Update Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allArticles as $elem) : ?>
                        <tr class="editContent" data-id="<?= $elem["idarticle"] ?>" id="<?= $elem["idarticle"] ?>">
                            <td><?= $elem["idarticle"] ?></td>
                            <td><?= $elem["title"] ?></td>
                            <td><?= $elem["catname"] ?></td>
                            <td><?= $elem["pseudo"]  ?></td>
                            <td><?= $elem["creationdate"]  ?></td>
                            <td><?= $elem["updatedate"]  ?></td>
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
                <h2>Détails de l'article</h2>
            </div>
            <div class="body">
                <form action="" id="editPopupForm">
                    <div class="head user">
                        <div class="leftEdit">
                            <div class="sender">
                                <label for="">Autheur :</label>
                                <label id="pseudo" for=""></label>
                                <input id="idArticle" type="hidden" name="idArticle">
                            </div>
                            <div class="email">
                                <label for="">Email :</label>
                                <label id="email" for="">kalilov@hotmail.com</label>
                            </div>
                            <div class="date">
                                <label for="">Date le :</label>
                                <label id="creationDate" for="">12/12/2022</label>
                            </div>
                            <div class="category">
                                <label for="">Categorie</label>

                                <select name="idCategory" id="idCategory">
                                    <option value="1">Plat</option>
                                    <option value="2">Pâtisserie</option>
                                    <option value="3">Apéritif</option>
                                    <option value="6">Entrée</option>
                                    <option value="7">Dessert</option>
                                    <option value="8">Petit déjeuner</option>

                                </select>
                            </div>
                            <div class="articleTitle">
                                <label for="">Titre : </label>
                                <input id="title" name="title" type="text" value="test">
                            </div>
                            <div class="smallDesc">
                                <label for="">Petite Desc : </label>
                                <input id="smallDesc" name="smallDesc" type="text" value="test1234">
                            </div>
                        </div>
                        <div class="rightEdit">
                            <div class="photo">
                                <img id="photo" src="./ressource/img/article/temp/brochettes.jpg" alt="" srcset="" data-src="brochettes.jpg">
                            </div>
                            <div class="fileUpload">
                                <input class="form-control" type="file" id="formFile" name="file">
                            </div>
                        </div>

                    </div>
                    <div class="messageContent">
                        <textarea name="content" id="content" cols="30" rows="7"></textarea>
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
            const url = "index.php";
            
            let formData = new FormData();
            formData.append("controler", "articlecontroller");
            formData.append("action", "getArticle");
            formData.append("idArticle", e.dataset.id);
            const dataToSend = {
                method: "POST",
                body: formData
            }
            fetch(url, dataToSend)
                .then(data => data.json())
                .then(data => {
                    console.log(data);
                    document.getElementById("pseudo").innerHTML = data[0].pseudo;
                    document.getElementById("email").innerHTML = data[0].email;
                    document.getElementById("creationDate").innerHTML = data[0].creationdate;
                    document.getElementById("title").value = data[0].title;
                    document.getElementById("smallDesc").value = data[0].smalldesc;
                    document.getElementById("photo").src = document.getElementById("photo").src.replace(document.getElementById("photo").dataset.src, '');
                    document.getElementById("photo").src += data[0].photoarticle;
                    document.getElementById("photo").dataset.src = data[0].photoarticle;
                    document.getElementById("content").value = data[0].content;
                    document.getElementById("idArticle").value = data[0].idarticle;
                    document.getElementById("idCategory").value = data[0].idcategory;
                    document.getElementById("editPopup").classList.toggle("visible");
                });


        })
    })
    document.getElementById("popUpCloseBtn").addEventListener("click", () => {
        document.getElementById("editPopup").classList.toggle("visible");
    })
    window.onclick = function(e) {
        if (e.target == document.getElementById("editPopup")) {
            document.getElementById("editPopup").classList.remove("visible");
        }
    }

    document.getElementById("editPopupForm").addEventListener("submit", e => {
        e.preventDefault();
        switch (e.submitter.id) {
            case "updateButton": {
                let formData = new FormData(e.target);
                formData.append("action", "updateArticle");
                formData.append("contoller", "articlecontroller");
                const url = "index.php"
                const options = {
                    method: "post",
                    body: formData
                }
                fetch(url, options)
                    .then(data => data.json())
                    .then(data => {
                        let child = document.getElementById(data[0]["idarticle"]).children;
                        child[1].innerHTML = data[0]["title"];
                        child[2].innerHTML = data[0]["catname"];
                        child[3].innerHTML = data[0]["pseudo"];
                        child[4].innerHTML = data[0]["creationdate"];
                        child[5].innerHTML = data[0]["updatedate"];
                        document.getElementById("editPopup").classList.remove("visible");
                    });
                break;
            }
            case "deleteButton": {
                let formData = new FormData(e.target);
                formData.append("action", "deleteArticle");
                formData.append("controller", "articlecontroller");
                const url = "index.php"
                const options = {
                    method: "post",
                    body: formData
                }
                fetch(url, options)
                    .then(data => data.json())
                    .then(data => {
                        document.getElementById(data).remove();
                        document.getElementById("editPopup").classList.remove("visible");
                    });
                break;
                break
            }
        }


    })
</script>
<?php 
}
?>