<?php
require 'BD.php';

// Verificar si se envió un formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $tipo_doc = $_POST['t_doc'];
    $n_doc = $_POST['num_doc'];
    $primer_nombre = $_POST['pnombre'];
    $segundo_nombre = $_POST['snombre'];
    $primer_apellido = $_POST['papellido'];
    $segundo_apellido = $_POST['sapellido'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];    

    // Consulta para verificar la existencia del usuario
    $consulta_existencia = $miPDO->prepare("SELECT * FROM empleado WHERE correo_e = :email OR usuario_e = :user");
    $consulta_existencia->execute([
        'email' => $email,
        'user' => $user
    ]);

    // Verificar si el usuario ya existe
    if ($consulta_existencia->rowCount() > 0) {
        // El usuario ya existe, muestra un mensaje de error
        echo 'El usuario ya existe. Utiliza otro correo electrónico o nombre de usuario.';
    } else {
        // El usuario no existe, procede con el registro
        if ($pass === 'Empleado123') {
            // Hash de la contraseña
            $clave = password_hash($pass, PASSWORD_BCRYPT);
            // Preparar y ejecutar la consulta de inserción para empleado
            $registro_empleado = $miPDO->prepare("INSERT INTO `empleado`(t_doc, num_doc, p_nombre, s_nombre, p_apellido, s_apellido, correo_e, usuario_e, clave_e) VALUES (:t_doc, :num_doc, :pnombre, :snombre, :papellido, :sapellido, :email, :user, :pass)");
            $registro_empleado->execute([
                't_doc' => $tipo_doc,
                'num_doc' => $n_doc,
                'pnombre' => $primer_nombre,
                'snombre' => $segundo_nombre,
                'papellido' => $primer_apellido,
                'sapellido' => $segundo_apellido,
                'email' => $email,
                'user' => $user,
                'pass' => $clave
            ]);
            header('Location: ingreso.php');
        } else if ($pass === 'Domiciliario123') {
            // Hash de la contraseña
            $clave = password_hash($pass, PASSWORD_BCRYPT);
            // Preparar y ejecutar la consulta de inserción para domiciliario
            $registro_empleado = $miPDO->prepare("INSERT INTO `domiciliario`(t_doc, num_doc, p_nombre, s_nombre, p_apellido, s_apellido, correo_d, usuario_d, clave_d) VALUES (:t_doc, :num_doc, :pnombre, :snombre, :papellido, :sapellido, :email, :user, :pass)");
            $registro_empleado->execute([
                't_doc' => $tipo_doc,
                'num_doc' => $n_doc,
                'pnombre' => $primer_nombre,
                'snombre' => $segundo_nombre,
                'papellido' => $primer_apellido,
                'sapellido' => $segundo_apellido,
                'email' => $email,
                'user' => $user,
                'pass' => $clave
            ]);
            header('Location: ingreso.php');
        } else if ($pass === 'Clientes123') {
            // Llamada a la función add_user_cliente con los parámetros del formulario
            $miPDO->query("USE trendystyle1;");
            $miPDO->query("CALL add_user_cliente('$tipo_doc','$n_doc','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$email','$user','$pass')");
            header('Location: ingreso.php');
            exit;
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
    <title>Registro Usuarios</title>
</head>
<body>
    
    <!-- Navegacion -->
    
    <nav>
        <a href="index.html">Inicio</a>
        <a href="ingreso.php">Iniciar sesion</a>
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
                    <form class="was-validated" method='post'>
                        <div class="mb-3">
                            <label for="t_doc" class="form-label">Tipo de documento</label> 
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-card"></i></span>
                                <select name="t_doc" class="form-select" required>
                                    <option value="">Selecciona un tipo de documento</option>
                                    <option value="CC">C.C</option>
                                    <option value="TI">T.I</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona tu tipo de documento
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="#_doc" class="form-label">Numero de documento</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-card"></i></span>
                                <input type="tel" name='num_doc' placeholder="1031809514" pattern="[0-9]{10}" class="form-control"  required>
                                <div class="invalid-feedback">
                                    Escribe tu numero de documento
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pnombre" class="form-label">Primer nombre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="pnombre" placeholder="Pepito" pattern="[A-Z][a-z]{3,}" title="Primera letra en mayuscula" class="form-control"  required>
                                <div class="invalid-feedback">
                                    Escribe tu primer nombre
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="snombre" class="form-label">Segundo nombre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="snombre" placeholder="Alexander" pattern="[A-Z][a-z]{5,}" title="Primera letra en mayuscula" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="papellido" class="form-label">Primer apellido</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="papellido" placeholder="Grillo" pattern="[A-Z][a-z]{3,}" title="Primera letra en mayuscula"  class="form-control" required>
                                <div class="invalid-feedback">
                                    Escribe tu primer apellido
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sapellido" class="form-label">Segundo apellido</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="sapellido" placeholder="Rodriguez" pattern="[A-Z][a-z]{5,}" title="Primera letra en mayuscula" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electronico</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email"  class="form-control" class="form-control" required>
                                <div class="invalid-feedback">
                                    Escribe tu correo electronico
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-image-portrait"></i></span>
                                <input type="text" name="user" class="form-control"  required>
                                <div class="invalid-feedback">
                                    Escribe tu nombre de usuario
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Contraseña</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" placeholder="Memientes007" name="pass" pattern="[A-Z]{1}[a-z]{7,}[0-9]{3}" title="La clave debe contener una letra en mayúscula, 8 en minúsculas y 3 números"  class="form-control"  required>
                                <div class="invalid-feedback">
                                    Escribe tu contraseña
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12 botones d-flex justify-content-around">
                                    <input type="submit" value="Registrarse" class="btn btn-dark">
                                    <button class="btn btn-outline-dark btn-block"><a class="nav-link" href="ingreso.php">Iniciar sesión</a></button> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
</body>
</html>
