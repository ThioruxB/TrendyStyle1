<?php
require 'BD.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $tipo_tarjeta=$_POST['tipo_t'];
    $numero_tarjeta=$_POST['n_tarjeta'];
    $cvc=$_POST['cvc'];
    $mes=$_POST['mes_expiracion'];
    $año=$_POST['anio_expiracion'];
    $tarjeta=$miPDO->prepare("INSERT INTO `tarjeta_pago` (`tipo_tarjeta`, `numero`, `codigo_cvc`, `mes_expiracion`, `año_expiracion`) VALUES (:tipo_t, :n_tarjeta, :cvc, :mes_expiracion, :anio_expiracion)");
    $tarjeta->execute([
        'tipo_t'=>$tipo_tarjeta,
        'n_tarjeta'=>$numero_tarjeta,
        'cvc'=>$cvc,
        'mes_expiracion'=>$mes,
        'anio_expiracion'=>$año
    ]);
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_pago.css">
    <title>PAGO</title>
</head>
<body>
      <!-- Encabezado -->
      <header id="inicio">
        <img src="img/logo.jpeg" alt="logo">
        <h1>Trendy-Style</h1>
        <img src="img/logo.jpeg" alt="logo">
    </header>
    <!-- Navegacion -->
    <nav>
        <a href="index.html">Inicio</a>
        <a href="catalogo.php">Catalogo/Categorias</a>
        <a href="pago.php">Escoger tipo de pago</a>
        <a href="ingreso.php">Salir</a>
    </nav>
    <span class="border border-info">
    <div class="container-fluid col-5 border bg-body-secondary rounded shadow-lg mg-button-10px ">
        <!-- Formulario de pago -->
        <form class="was-validated" method='post'>
            <h1 class="text-center"> Pago por tarjeta</h1>
            <div class="mb-3">
                <label for="direccion" class="form-label">Tipo de tarjeta</label>
                <select class="form-control" name='tipo_t'  required>
                    <option value="">Selecciona el tipo de tarjeta</option>
                    <option value="t_credito">Tarjeta de credito</option>
                    <option value="t_debito">Tarjeta de debito</option>
                </select>
                
                <div class="invalid-feedback">
                    Por favor escoge tu tipo de tarjeta.
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Numero de tarjeta</label>
                <input type="tel" class="form-control" name='n_tarjeta'  required pattern="[0-9]{14,18}"title="pon la cantidad de numeros validos" placeholder="EJ: 12345678912345">
                <div class="invalid-feedback">
                    Por favor ingresa correctamente tu numero de tarjeta.
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Codigo cvc</label>
                <input class="form-control"  type="tel" name="cvc" pattern="[0-9]{3,4}" placeholder="EJ:1234" title="pon entre 3 a 4 numeros" required>
                <div class="invalid-feedback">
                    Por favor ingresa correctamente el cvc.
                </div>
            </div>
            <div class="mb-3">
                <label for="mes_expiracion" class="form-label">Mes de expiración</label> 
                <select name="mes_expiracion" class="form-select" required>
                    <option value="">Selecciona un mes de expedicion</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <div class="invalid-feedback">
                    Selecciona un mes de expedicion
                </div>
            </div>
            <div class="mb-3">
                <label for="anio_expiracion" class="form-label">Año de expiración</label> 
                <select name="anio_expiracion" class="form-select" required>
                    <option value="">Selecciona un año de expedicion</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
                    <option value="2034">2034</option>
                    <option value="2035">2035</option>
                    <option value="2036">2036</option>
                </select>
                <div class="invalid-feedback">
                    Selecciona un año de expedicion
                </div>
            </div>
            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-md-6 ">
                   <button onclick="Pagar()" class="btn btn-dark col-12 ">Pagar</button>  
                </div>
            </div>
        </form>
    </div>
    </span>
    <!-- Footer -->
    <footer> 
        <img id="logofooter" src="img/logo.png" alt="">
        <div class="contengotodo">
            <div class="img">
                <img src="img/contacto.png" alt="contactoicon">
                <h2>Escribenos</h2>
               </div>
               <div class="texto">
                <p>bustamanteparrabryanalexander@gmail.com</p>
                <p>luisandrestovarr2019@gmail.com</p>
                <p>hoonluv4@gmail.com</p>
                <p>sebastiangalindo@gmail.com</p>
               </div>         
        </div>
        <div class="contengotodo">
            <div class="img">
                <img src="img/llamada.png" alt="">
                <h2>LLamanos</h2>
            </div>
            <div class="texto">
                <p>3015823912</p>
                <p>313 4177450</p>
                <p>315 2594007</p>
                <p>317 5158394</p>
            </div>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
