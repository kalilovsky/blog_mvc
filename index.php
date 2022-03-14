    <?php require_once("controller/controller.php");
    if(!isset($_SESSION["mail"])){
        session_start();
    }
    if (isset($_POST["submitAction"])) {
        switch ($_POST["submitAction"]) {
            case "moreDetail":
                showArticle($_POST["idArticle"]);
                break;
            case "messageSubmit":
                sendMessageToDb($_POST["email"], $_POST["message"]);
                break;
            case 'login':
                login($_POST);
                break;
            case 'register':
                register($_POST) ;
                break;
           

        }
    }

    if (!isset($_GET["page"])) {
      showHome();
    } else {
        switch ($_GET["page"]) {
            case "home":
                showHome();
                break;
            case "listArticles":
                showAllArticles();
                break;
            case "about":
                showAbout();
                break;
            case "contactPage":
                showContactPage();
                break;
            case "register":
                showRegisterPage();
                break;
            case "adminDashboard":
                showAdminDashboard();
                break;
            case "editUsersAdmin":
                showEditUsersAdmin();
                break;
            case "editCommentsAdmin":
                showEditCommentsAdmin();
                break;
            case "editArticlesAdmin":
                showEditArticlesAdmin();
                break;
            case "editMessagesAdmin":
                showEditMessagesAdmin();
                break;

        }
    }
