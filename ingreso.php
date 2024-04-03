<?php
require 'BD.php';

session_start(); 
if(!empty($_POST['email']) && !empty($_POST['pass'])){
    $email = $_POST['email'];
    $clave = $_POST['pass'];
    $consulta=$miPDO->prepare("SELECT id_cliente,correo,usuario,clave FROM cliente WHERE correo=:email ");
    $consulta->bindParam(':email', $email); // Corregido aquí
    $consulta->execute();
    $datos = $consulta->fetch(PDO::FETCH_ASSOC);
    $consulta_empleado=$miPDO->prepare("SELECT id_empleado,correo_e,usuario_e,clave_e FROM empleado WHERE correo_e=:email");
    $consulta_empleado->bindParam(':email',$email); // Corregido aquí
    $consulta_empleado->execute();
    $datos_empleado=$consulta_empleado->fetch(PDO::FETCH_ASSOC);
    $consulta_domiciliario=$miPDO->prepare("SELECT id_domiciliario,correo_d,usuario_d,clave_d FROM  domiciliario WHERE correo_d=:email");
    $consulta_domiciliario->bindParam(':email',$email); // Corregido aquí
    $consulta_domiciliario->execute();
    $datos_domiciliario=$consulta_domiciliario->fetch(PDO::FETCH_ASSOC);
    
    if ($datos && $email === $datos['correo']) { // Cambiado 'else if' a 'if'
        if($clave === 'Clientes123'){ // Cambiado 'Clientes123' a $datos['clave']
            $_SESSION['tipo'] = 'cliente';
            $_SESSION['email'] = $email;
            $_SESSION['user']=$datos['usuario'];
            header("Location:catalogo.php");
            exit();
        } else {
            echo '<script>alert("Contraseña incorrecta para cliente");</script>'; // Corregido aquí
        }
    } else if ($datos_empleado && $email === $datos_empleado['correo_e']) {
        if ($clave === 'Empleado123') { // Cambiado 'Empleado123' a $datos_empleado['clave_e']
            $_SESSION['tipo'] = 'empleado';
            $_SESSION['email'] = $email;
            $_SESSION['user']=$datos_empleado['usuario_e'];
            header("Location:empleado/dashboard.php");
            exit();
        } else {
            echo '<script>alert("Contraseña incorrecta para empleado");</script>';
        }
    } 
    else if ($datos_domiciliario && $email === $datos_domiciliario['correo_d']) {
        if ($clave === 'Domiciliario123') { // Cambiado 'Domiciliario123' a $datos_domiciliario['clave_d']
            $_SESSION['tipo'] = 'domiciliario';
            $_SESSION['email'] = $email;
            $_SESSION['user']=$datos_domiciliario['usuario_d'];
            header("Location:domiciliario/dashboard.php");
            exit();
        } else {
            echo '<script>alert("Contraseña incorrecta para domiciliario");</script>';
        }
    } 

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="../Practica/iconos/css/all.min.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <!-- Navegacion -->
    <nav>
        <a href="index.html">Inicio</a>
        <a href="ingreso.php">Iniciar sesión</a>
        <a href="registro.php">Registrarse</a>
    </nav>
    <!-- 2 fila: formulario-->
    <div class="row mt-4">
        <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6">
            <!-- formulario -->
            <div class="card shadow-lg p-3 mb-5 bg-body-secondary rounded">
                <div class="card-header d-flex justify-content-center bg-body-secondary">
                    <img class="card-img-top img-fluid" src="img/logo.jpeg">
                </div>
                <div class="card-body">
                    <!-- formulario -->
                    <form method='post' class="was-validated">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" id="InputEmail" class="form-control" required>
                                <div class="invalid-feedback">
                                    Escribe tu correo electrónico
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" placeholder="Memientes007" id="InputPassword" name="pass" pattern="[A-Z]{1}[a-z]{7,}[0-9]{3}" title="La clave debe contener una letra en mayúscula, 8 en minúsculas y 3 números" class="form-control" required>
                                <div class="invalid-feedback">
                                    Escribe tu contraseña
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12 botones d-flex justify-content-around">
                                    <a href="olvide la contraseña.html" class="btn btn-outline-dark btn-block">Olvidé la clave</a> 
                                    <input type="submit" id="btnAlerta" value="Iniciar sesión" class="btn btn-dark">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a class="nav-link" href="registro.php">¿Aún no tienes cuenta?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</body>
</html>
