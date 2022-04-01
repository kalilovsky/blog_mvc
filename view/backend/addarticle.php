<?php
if ($_SESSION["userType"] != "admin" && $_SESSION["userType"] != "author"  ) {
    $title = "Not Authorised";
   
?>
    <div class="dashboard active" id="dashboard">
        <p>Vous n'êtes pas autoriser à voir cette page.</p>
    </div>
<?php
   
} else{
    ?>
<div class="dashboard active">
    <div class="editPopup visible zindex1" id="editPopup">
        <div class="thePopup" id="thePopup">
            
            <div class="title">
                <h2>Détails de l'article</h2>
                <p id="messageTxt" style="color:green"></p>
            </div>
            <div class="body">
                <form action="" id="editPopupForm">
                    <div class="head user">
                        <div class="leftEdit">
                            <div class="sender">
                                <label for="">Autheur :</label>
                                <label id="pseudo" for=""><?= $_SESSION["pseudo"] ?></label>
                                
                            </div>
                            <div class="email">
                                <label for="">Email :</label>
                                <label id="email" for=""><?= $_SESSION["mail"] ?></label>
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
                                <input id="title" name="title" type="text" value="" required>
                            </div>
                            <div class="smallDesc">
                                <label for="">Petite Desc : </label>
                                <input id="smallDesc" name="smallDesc" type="text" value=""required>
                            </div>
                        </div>
                        <div class="rightEdit">
                            <div class="photo">
                                <img id="photo" src="./ressource/img/article/temp/brochettes.jpg" alt="" srcset="" data-src="brochettes.jpg">
                            </div>
                            <div class="fileUpload">
                                <input class="form-control" type="file" id="formFile" name="file" required>
                            </div>
                        </div>

                    </div>
                    <div class="messageContent">
                        <textarea name="content" id="content" cols="30" rows="7" required></textarea>
                    </div>
                    <div class="editButton">
                        <button name="updateButton" id="updateButton">Update</button>

                        
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    document.getElementById("editPopupForm").addEventListener("submit",e=>{
        e.preventDefault();
        switch (e.submitter.id){
            case 'updateButton':{
                
                let formData = new FormData(document.getElementById("editPopupForm"));
                formData.append("controler", "articlecontroller");
                formData.append("action", "addArticle");
                const URL = "index.php"
                const DATA = {
                    method: "POST",
                    body : formData
                }
                fetch(URL,DATA)
                .then(data=>data.json()
                )
                .then(data=>{
                    console.log(data)
                    window.location.replace("http://localhost:3000/index.php?idArticle="+data+"&controller=articlecontroller&action=showArticle")
                })
                break;
            }
            default:
                break;
            
        }
    })

</script>
<?php } ?>