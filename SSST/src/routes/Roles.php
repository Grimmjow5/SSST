<?php

namespace Almacen\Ssst\routes;

use Almacen\Ssst\controllers\RolesController;
use Flight;
use Almacen\Ssst\controllers\Login;


class Roles extends Flight{

    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);

       //vista Roles 
       $roles = new RolesController();

       parent::route('GET /Roles',[$roles,'index']);

       parent::route('POST /Roles',[$roles,'postRoles']);

       parent::route('GET /cat_roles',[$roles,'getRoles']);
     

    }
}