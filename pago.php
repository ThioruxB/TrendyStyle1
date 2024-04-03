<?php
require 'BD.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $direccion=$_POST['direccion'];
    $ciudad=$_POST['ciudad'];
    $barrio=$_POST['barrio'];
    $postal=$_POST['postal'];
    $pago=$miPDO->prepare("INSERT INTO `domicilio`(barrio,direccion,ciudad,codigo_postal) VALUES (:barrio,:direccion,:ciudad,:postal)");
    $pago->execute([
        'barrio'=>$barrio,
        'direccion'=>$direccion,
        'ciudad'=>$ciudad,
        'postal'=>$postal
    ]);
    if(isset($_POST['tarjeta'])){
        header('Location: tarjeta.php');
    } else if(isset($_POST['efectivo'])) {
        Efectivo();
    }
    
  
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
        <a href="ingreso.php">Salir</a>
    </nav>
    <span class="border border-info">
    <div class="container-fluid col-5 border bg-body-secondary rounded shadow-lg mg-button-10px ">
        <!-- Formulario de pago -->
        <form class="was-validated" method='post'>
            <h1 class="text-center"> PAGO</h1>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input class="form-control" name='direccion' id="direccion" placeholder="Direccion" required>
                <div class="invalid-feedback">
                    Por favor ingresa tu dirección.
                </div>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input class="form-control" name='ciudad' id="ciudad" placeholder="Ciudad" required>
                <div class="invalid-feedback">
                    Por favor ingresa tu ciudad.
                </div>
            </div>
            <div class="mb-3">
                <label for="barrio" class="form-label">Barrio</label>
                <input class="form-control" name='barrio'  id="barrio" placeholder="Barrio" pattern="[A-Z][a-z]{5,}" required>
                <div class="invalid-feedback">
                    Por favor ingresa tu barrio.
                </div>
            </div>
            <div class="mb-3">
                <label for="postal" class="form-label">Codigo postal</label>
                <input class="form-control" name='postal' id="postal" placeholder="Codigo postal" pattern="[0-9]{6}" required>
                <div class="invalid-feedback">
                    Por favor ingresa tu código postal válido.
                </div>
            </div>
            <div class="alert alert-success mensaje ocultoInputs mt-4 text-center " role="alert" style="display: none; width: 35vw;margin-left: 50px; ">
                <h3>¡DATOS INGRESADOS EXITOSAMENTE!</h3>
                Ve a un corresponsal y paga a este codigo. Una vez pago te llegara tu domicilio
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                   <button onclick="Efectivo()" id="efectivobtn" class="btn btn-dark col-12">Pago con Efectivo</button>  
                </div>
                <div class="col-md-6">
                    <input type="submit" name='tarjeta' value="Pago con Tarjeta" class="btn btn-dark col-12">
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
    <script>
        //ocultar
        function Efectivo() {
            const botonEfectivo = document.getElementById('efectivobtn');
            const oculto = document.querySelectorAll('.ocultoInputs');

            botonEfectivo.addEventListener('click', function () {
                if (this.click) {
                    oculto.forEach(element => {
                        element.style.display = 'block';
                    });
                } else {
                    oculto.forEach(element => {
                        element.style.display = 'none';
                    });
                }
            });
        }
    </script>
</body>
</html>
