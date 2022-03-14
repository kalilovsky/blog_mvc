<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ressource/styles/style.css">
    <title><?= $title; ?></title>
</head>

<body>
    <?php require_once("frontend/header.php");?>
    
    
    <?= $content; ?>
    <?php require_once("frontend/footer.php");?>
    <script src="https://kit.fontawesome.com/fca1edefcc.js" crossorigin="anonymous"></script>
</body>

</html>