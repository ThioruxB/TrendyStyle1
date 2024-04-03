<?php
require 'BD.php';
$consulta=$miPDO->prepare("SELECT * FROM tipo_producto");
$consulta->execute();
$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylecatalogo.css">
    <link rel="stylesheet" href="../iconos/css/all.min.css">
    <title>Catalogo</title>
</head>
<body>
      <!--encabezado-->
      <header id="inicio">
        <img src="img/logo.jpeg" alt="logo">
        <h1>Trendy-Style</h1>
        <img src="img/logo.jpeg" alt="logo">
    </header>
    <!--navegacion-->
    <nav>
    <?php
    session_start(); 
    ?>
        <a href="index.html">Inicio</a>
      
        <a href="catalogo.html">Catalogo/Categorias</a>
        <a href="ingreso.html">Salir</a>
        <a href=""><i class="fa-solid fa-user-ninja fa-2xl"></i> <?php echo $_SESSION['user']; ?></a>
    </nav>
    <!--Catalogo-->
    <main class="catalogo">
        <div class="fotos">
        <?php foreach ($datos as $producto) : ?>
            <div>
                <img src="<?php echo $producto['img_tipo_p']; ?>" alt="<?php echo $producto['nombre_tipo_p']; ?>">
                <h2><?php echo $producto['nombre_tipo_p']; ?></h2>
                    <div>
                    <a class="botones" href="categoria_camisas.php?categoria=<?php echo $producto['nombre_tipo_p']; ?>">Ver más...</a>


                    </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
         <!-- pie de pagina -->
         <footer> 
            <img id="logofooter" src="img/logo.png" alt="">
            <div class="contengotodo">
                <div class="img">
                    <img src="img/contacto.png" alt="contactoicon">
                    <h2>Escribenos</h2>
                   </div>
                   <div class="texto">
                    <p>
                        bustamanteparrabryanalexander@gmail.com
                    </p>
                    <p>
                        luisandrestovarr2019@gmail.com
                    </p>
                    <p>
                        hoonluv4@gmail.com
                    </p>
                    <p>
                        sebastiangalindo@gmail.com
                    </p>
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
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</body>
</html>