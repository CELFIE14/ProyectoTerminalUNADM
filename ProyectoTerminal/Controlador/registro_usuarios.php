<?php             
    include "../Modelo/conexion.php";
    
    $validrequeridos = false;
    $requeridos = "Campos requeridos: ";
    $camposinvalidos = "Campos inválidos: "; 
    $valid = false;
    

    if(!empty($_POST["nombre"])) {
        if (!preg_match("/^[a-zA-Z[:space:]]{3,50}$/", $_POST['nombre'])){
            $valid = true;
            $camposinvalidos.="Nombre, ";
        }

    }else{
        $validrequeridos = true;
        $requeridos .="Nombre, ";
    }
    
    if(empty($_POST["catArea"])) { 
       $validrequeridos = true;
       $requeridos .="Área, ";
    }
    
    if(empty($_POST["catRol"])) { 
        $validrequeridos = true;
       $requeridos .="Rol, ";
    }
    
    if(!empty($_POST["correo"])) { 
        if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)){
            $valid = true;
            $camposinvalidos.="Correo, ";
        }
    }else{
        $validrequeridos = true;
        $requeridos .="Correo, ";
        }
    
    if(!empty($_POST["password"])) {
        if (!preg_match("/^[a-zA-Z0-9$@-]{8,20}$/", $_POST['password'])){
            $valid = true;
            $camposinvalidos.="Password, ";
        }

    }else{
        $validrequeridos = true;
        $requeridos .="Password, ";
    }
    
    if ($validrequeridos || $valid){
        $_SESSION["log_requeridos"]= $requeridos;
        $_SESSION["log_invalidos"]= $camposinvalidos;
        header("location: ../Vistas/Mod01Admin.php");
        //echo $requeridos;
        //echo $camposinvalidos;
        
    }else{
        $nombre=$_POST["nombre"];
        $area=$_POST["catArea"];
        $rol=$_POST["catRol"];
        $correo=$_POST["correo"];
        $password=$_POST["password"];
        
        $passwordFuerte = password_hash($password, PASSWORD_DEFAULT);
        $sql=$conexion->query("INSERT INTO usuario(Nombre, Id_Area, Id_rol, Correo, Contrasena)values('$nombre', '$area', '$rol', '$correo', '$passwordFuerte')");
        if($sql!= 1){
            $_SESSION["log_reg"]= "Hubo un error al registrar el usuario";
            //echo "NO";
        }else{
            //echo "SI";
            $_SESSION["log_reg"]= "Usuario registrado con éxito";
            
        }
        header("location: ../Vistas/Mod01Admin.php");
    }




?>
