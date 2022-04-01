<?php

namespace controller;

// function showAbout(){
//     //chargé la page
//     $title = 'A propos';
//     render("frontend/about",compact("title"));
    
// }

// function showContactPage(){
//     //chargé la page
//     $title = 'Contact';
//     render("frontend/contact",compact("title"));
  
// }



// function showRegisterPage(){

//     $title = "Inscription";
//     render("frontend/register",compact("title"));
    
// }

abstract class controller{
    
    protected $modelName;
    protected $model;
    public function __construct()
    {
        $realModelName = "\\model\\" . $this->modelName;
        $this->model = new $realModelName;
    }


}