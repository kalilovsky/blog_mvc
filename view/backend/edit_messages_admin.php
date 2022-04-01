<?php
if ($_SESSION["userType"] != "admin") {
    $title = "Not Authorised";
    
?>
    <div class="dashboard active" id="dashboard">
        <p>Vous n'êtes pas autoriser à voir cette page.</p>
    </div>
<?php
    
} else{
$statusText=["Non Lu","Lu"]
?>
<div class="dashboard active" id="dashboard">
    <div class="cards editcom">
        <div class="resume">
            <div class="chiffre">
                <div id="unreadMsg" class="qt"><?= count((array_filter($allMessages, function ($key) {
                                    return $key["status"] == 0;
                                })))  ?></div>
                <div class="denom">Messages non lus</div>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
        </div>
        <div class="resume">
            <div class="chiffre">
                <div id="readMsg" class="qt"><?= count((array_filter($allMessages, function ($key) {
                                    return $key["status"] == 1;
                                })))  ?></div>
                <div class="denom">Message lus</div>
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
                    Liste des message
                </div>

            </div>
            <table>
                <thead>
                    <tr>
                        <th>idMessage</th>
                        <th>Sender</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allMessages as $elem) : ?>
                        <tr class="editContent<?= $elem["status"] == 0 ? (" unread") : "" ?>" data-id="<?= $elem["idmessage"] ?>" data-status="<?= $elem["status"]  ?>">
                            <td><?= $elem["idmessage"] ?></td>
                            <td><?= $elem["senderemail"] ?></td>
                            <td><?= $elem["content"] ?></td>
                            <td><?= $elem["date"]  ?></td>
                            <td id="<?= $elem["idmessage"] ?>"><?= $statusText[$elem["status"]]  ?></td>


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
                <h2>Détails du message</h2>
            </div>
            <div class="body">
                <form action="" id="editPopupForm">
                    <div class="head">
                        <div class="sender">
                            <label for="">Expéditeur</label>
                            <label id="email" for="">khalil</label>
                        </div>
                        <div class="date">
                            <label for="">Date le</label>
                            <label id="date" for="">04/04/2022</label>
                        </div>
                    </div>
                    <div class="messageContent">
                        <textarea name="content" id="content" cols="30" rows="10" readonly></textarea>
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
            formData.append("action", "getMessage");
            formData.append("controller", "messagecontroller");
            formData.append("idMessage", e.dataset.id);
            formData.append("statusMessage", e.dataset.status);
            const dataToSend = {
                method: "POST",
                body: formData
            }
            document.getElementById("editPopup").classList.toggle("visible");
            fetch(url, dataToSend)
                .then(data => data.json())
                .then(data => {
                    let statusText = ["Non Lu","Lu"];
                    let statusMsgTxt = document.getElementById(data[0].idmessage).innerHTML;
                    document.getElementById("content").value  = data[0].content;
                    document.getElementById("email").innerHTML  = data[0].senderemail;
                    document.getElementById("date").innerHTML  = data[0].date;
                    console.log(data);
                    if (statusMsgTxt != statusText[data[0].status]){
                        document.getElementById(data[0].idmessage).innerHTML=statusText[data[0].status];
                        document.getElementById(data[0].idmessage).parentElement.classList.remove("unread");
                        document.getElementById("unreadMsg").innerHTML = ~~document.getElementById("unreadMsg").innerHTML -1;
                        document.getElementById("readMsg").innerHTML = ~~document.getElementById("readMsg").innerHTML +1;
                        console.log(data);
                    }
                   
                    
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
</script>
<?php }
?>