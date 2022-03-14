<?php $title = 'Insert Article'; ?>
<?php ob_start(); ?>

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
                            <label id="email" for=""></label>
                        </div>
                        <div class="date">
                            <label for="">Date le :</label>
                            <label id="creationDate" for=""></label>
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
                            <input id="title" name="title" type="text" value="">
                        </div>
                        <div class="smallDesc">
                            <label for="">Petite Desc : </label>
                            <input id="smallDesc" name="smallDesc" type="text" value="">
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

<?php $content = ob_get_clean(); ?>
<?php require_once("./view/template.php");