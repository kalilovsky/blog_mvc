<?php
if ($_SESSION["userType"] != "admin") {
    $title = "Not Authorised";
    
?>
    <div class="dashboard active" id="dashboard">
        <p>Vous n'êtes pas autoriser à voir cette page.</p>
    </div>
<?php
    
} else {
    $statusText = ["Non Approved", "Approved"]
?>
<div class="dashboard active" id="dashboard">
    <div class="cards editcom">
        <div class="resume">
            <div class="chiffre">
                <div id="waitingComments" class="qt"><?= count((array_filter($allComments, function ($key, $val) {
                                    return $key["status"] == 0;
                                }, ARRAY_FILTER_USE_BOTH)))  ?></div>
                <div class="denom">Commentaires non approuvés</div>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
        </div>
        <div class="resume">
            <div class="chiffre">
                <div id="aprovedComments" class="qt"><?= count((array_filter($allComments, function ($key, $val) {
                                    return $key["status"] == 1;
                                }, ARRAY_FILTER_USE_BOTH)))  ?></div>
                <div class="denom">Commentaires approuvés</div>
            </div>
            <!-- print_r((array_map(fn($val)=>$val["status"]==1, $allComments -->
            <div class="icon">
                <i class="fas fa-comments"></i>
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
                        <th>idComment</th>
                        <th>User</th>
                        <th>Article</th>
                        <th>Date</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allComments as $elem) : ?>
                        <tr class="editContent<?= $elem["status"] == 0 ? (" unread") : "" ?>" data-id="<?= $elem["idcomment"] ?>">
                            <td><?= $elem["idcomment"] ?></td>
                            <td><?= $elem["pseudo"] ?></td>
                            <td><?= $elem["title"] ?></td>
                            <td><?= $elem["datecreated"]  ?></td>
                            <td id="<?= $elem["idcomment"] ?>"><?= $statusText[$elem["status"]]  ?></td>

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
                <h2>Détails du commentaire</h2>
            </div>
            <div class="body">
                <form action="" id="editPopupForm">

                    <div class="head">
                        <div class="sender">
                            <label for="">Pseudo :</label>
                            <input type="hidden" id="idComment" name="idComment">
                            <label id="pseudo" for="">khalil</label>
                        </div>
                        <div class="date">
                            <label for="">Email :</label>
                            <label id="email" for="">kalilov@hotmail.com</label>
                        </div>
                        <div class="article">
                            <label for="">Titre :</label>
                            <label id="title" for="">Je m'en fous du titre</label>
                        </div>
                        <div class="article">
                            <label for="">Status :</label>
                            <select name="status" id="status" data-status="">
                                <option value="0">En Attente</option>
                                <option value="1">Approuvé</option>
                            </select>
                        </div>
                    </div>
                    <div class="messageContent">
                        <textarea name="messageContent" id="messageContent" cols="30" rows="10" readonly></textarea>
                    </div>
                    <div class="editButton">
                        <button class="editButtonCls" name="updateButton" id="updateButton">Update</button>

                        <button class="editButtonCls" name="deleteButton" id="deleteButton">Supprimer</button>
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
            formData.append("action","getComment");
            formData.append("controller","commentcontroller");
            formData.append("idComment",e.dataset.id);
            
            const dataToSend = {
                method: "POST",
                body : formData
            }
            fetch(url,dataToSend)
            .then(data=>data.json())
            .then(data=>{
                
                document.getElementById("idComment").value = data[0].idcomment;
                document.getElementById("pseudo").innerHTML = data[0].pseudo;
                document.getElementById("email").innerHTML = data[0].email;
                document.getElementById("title").innerHTML = data[0].title;
                document.getElementById("status").value = data[0].status;
                document.getElementById("status").dataset.status = data[0].status;
                document.getElementById("messageContent").value = data[0].contentcomment;
                document.getElementById("editPopup").classList.toggle("visible");
            });

        })
    })
    document.getElementById("popUpCloseBtn").addEventListener("click", event => {
        document.getElementById("editPopup").classList.toggle("visible");
    })
    window.onclick = function(e) {
        if (e.target == document.getElementById("editPopup")) {
            document.getElementById("editPopup").classList.remove("visible");
        }
    }
    

   //update and delete Comment
    document.getElementById("editPopupForm").addEventListener("submit",e=>{
            switch (e.submitter.id){
                 //update status
                case "updateButton":
                    e.preventDefault();
                    let formData = new FormData(e.currentTarget);
                    formData.append("action","updateComment");
                    formData.append("controller","commentcontroller");
                    const url = "index.php"
                    const options = {
                        method : "post",
                        body : formData
                    }
                    fetch(url,options)
                    .then(data=>data.json())
                    .then(data=>{
                        let statusText = ["Non Approved","Approved"];
                        let selectedStatus = statusText[document.getElementById("status").value];
                        let originalStatus = document.getElementById("status").dataset.status;
                        
                        if(originalStatus!=selectedStatus){
                            // console.log(String(data.id));
                           
                            if(selectedStatus==statusText[0]){
                                document.getElementById("aprovedComments").innerHTML = ~~document.getElementById("aprovedComments").innerHTML-1;
                                document.getElementById("waitingComments").innerHTML = ~~document.getElementById("waitingComments").innerHTML+1;
                                document.getElementById(data).innerHTML = selectedStatus;
                                document.getElementById("status").dataset.status = selectedStatus;
                                document.getElementById(String(data)).parentElement.classList.toggle("unread")
                            }else{
                                document.getElementById("aprovedComments").innerHTML = ~~document.getElementById("aprovedComments").innerHTML+1;
                                document.getElementById("waitingComments").innerHTML = ~~document.getElementById("waitingComments").innerHTML-1;
                                document.getElementById(data).innerHTML = selectedStatus;
                                document.getElementById("status").dataset.status = selectedStatus;
                                document.getElementById(String(data)).parentElement.classList.toggle("unread")

                            }
                            document.getElementById("editPopup").classList.toggle("visible");
                        }
                    })
                    break;
                case "deleteButton":
                    //delete comment
                    e.preventDefault();
                    let formData1 = new FormData(e.currentTarget);
                    formData1.append("action","deleteComment");
                    formData1.append("controller","commentcontroller");
                    const url1 = "index.php"
                    const options1 = {
                        method : "post",
                        body : formData1
                    }
                    fetch(url1,options1).then(data=>data.json()).then(data=>{
                        let originalStatus = document.getElementById("status").dataset.status;
                        document.getElementById(data.idComment).parentElement.remove();
                        if (originalStatus == 0){
                            document.getElementById("waitingComments").innerHTML = ~~document.getElementById("waitingComments").innerHTML-1;
                              
                        }else{
                            document.getElementById("aprovedComments").innerHTML = ~~document.getElementById("aprovedComments").innerHTML-1;
                        }
                        document.getElementById("editPopup").classList.toggle("visible");
                    })
                    break;
            }
        })



</script>
<?php }
?>