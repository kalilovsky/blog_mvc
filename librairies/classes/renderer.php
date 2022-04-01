<?php
class Renderer {

public static function render($filePath, array $data =[]){
    extract($data);
    ob_start();
    require_once("view/" . $filePath . ".php");
    $content = ob_get_clean();
    require_once("view/template.php");
}
}