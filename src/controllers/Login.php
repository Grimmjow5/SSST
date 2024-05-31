<?php

namespace Almacen\Ssst\controllers;
use Flight;
use Almacen\Ssst\config\ConfigDb;
class Login extends Flight{
    private $pass;
    private $nameUser;
    private $conexion;

    public function __construct(){
        $ruta =  __DIR__ ."/../public/views";
        parent::set('flight.views.path',$ruta);
        $this->conexion = new ConfigDb();

    }

    public function login(){
        //CONDICIONAL EN CASO QUE EXISTA UNA SESION
        parent::render('Login');
    }

    public function RenderHome() {

        parent::render('Home/index',['header'=> 'Home']);
    }
    
    public function setlogin(){

        if (isset($_POST['nombre_usuario']) && isset($_POST["password"])) {
            $this->nameUser = $_POST["nombre_usuario"];
            $this->pass = $_POST["password"];

            if (empty($this->nameUser) || empty($this->pass)) {
                parent::render('Login', ['mensaje'=>'2']);
                parent::stop();
            }

            $sql = "SELECT * FROM `cat_usuarios` WHERE `user`= ? AND `status`= 1;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $this->nameUser);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if (is_array($resultado) && count($resultado) > 0) {
                if (password_verify($this->pass, $resultado["pass"])) {
                    $_SESSION["id_usuario"] = $resultado["id_user"];
                    $_SESSION["nombre_usuario"] = $resultado["user_name"];
                    $_SESSION["nombre"] = $resultado["user"];
                    $_SESSION["apellidos"] = $resultado["last_name"];
                    $_SESSION["rol"] = $resultado["id_rol"]; // Guardar el rol en la sesión

                    parent::redirect('/home');
                } else {
                    parent::render('Login', ['mensaje'=>'1']);
                }
            } else {
                parent::render('Login', ['mensaje'=>'1']);
            }
        }
    }
  
    public function logout(){
      
        session_destroy();
        parent::redirect('/');

    }

}