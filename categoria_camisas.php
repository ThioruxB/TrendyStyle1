<?php
require 'BD.php';

// Función para convertir el precio a pesos colombianos
function precio_colombiano($precio) {
    return 'COP ' . number_format($precio, 3, ',', '.');
}

// Obtiene la categoría de la URL
$categoria = $_GET['categoria'];

// Consulta para obtener productos de la categoría seleccionada
$consulta = $miPDO->prepare("SELECT * FROM producto WHERE clasificacion = ?");
$consulta->execute([$categoria]);
$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylecatalogo.css">
    <link rel="stylesheet" href="iconos/css/all.css">
    <title>Camisas</title>
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
        <a href="index.html">Inicio</a>
        <a href="catalogo.php">Catalogo/Categorias</a>
        <a href="ingreso.php">Salir</a>
        <button class="btn anav" onclick="Totalpage1()" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
            <i class="fa-solid fa-bag-shopping fa-2xl" style="color: #E3E3E3;"></i>
        </button>
    </nav>
    <!--MODAL CARRITO-->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Tu carrito</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <h2>Productos</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th colspan='2'>Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody id="cartItems"></tbody>
                            <tr>
                                <td>TOTAL</td>
                                <td id="cartTotal"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"><a class="nav-link" href="pago.php">Pagar</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Catalogo -->
    <main class="catalogos">
        <div class="foto">
            <?php foreach ($datos as $row) : ?>
            <div>
                <img src="<?php echo $row['img_producto']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p><?php echo precio_colombiano($row['precio']); ?></p>
                <div class="boton">
                    <button onclick="AñadirAlCarrito('<?php echo $row['nombre']; ?>', <?php echo $row['precio']; ?>, '<?php echo $row['img_producto']; ?>')"> 
                        <img src="img/carrito.png" alt="carrito">
                    </button>
                    <button><img src="img/corazon.png" alt="corazon"></button>
                    <button><img src="img/estrella.png" alt="estrella"></button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    let carrito = [];

    function AñadirAlCarrito(nombre, precio, imagen) {
        const productoExistente = carrito.find(item => item.nombre === nombre);

        if (productoExistente) {
            productoExistente.cantidad++;
            productoExistente.subtotal = productoExistente.cantidad * precio;
        } else {
            carrito.push({ nombre: nombre, precio: precio, cantidad: 1, subtotal: precio, imagen: imagen });
        }

        // Llama a la función de la alerta
        AñadidoCarrito();

        actualizarCarrito();
    }

    function actualizarCarrito() {
        let total = 0;
        const cartItems = document.getElementById('cartItems');
        cartItems.innerHTML = ''; // Limpiar contenido anterior del carrito

        carrito.forEach((item, index) => {
            total += item.subtotal;

            cartItems.innerHTML += `
                <tr>
                    <th scope="row">${index + 1}</th>
                    <td class="profoto">
                        <img src="${item.imagen}" alt="${item.nombre}">
                    </td>
                    
                    <td class="table-price">$${item.subtotal.toFixed(3)}</td>
                    <td class="d-flex justify-content-center align-items-center">
                        <button onclick="disminuirCantidad(${index})" class="rounded-circle"><i class="fa-solid fa-minus "></i></button>
                        <span>${item.cantidad}</span>
                        <button onclick="aumentarCantidad(${index})" class="rounded-circle"><i class="fa-solid fa-plus fa-flip-both "></i></button>
                    </td>
                </tr>
            `;
        });

        const cartTotal = document.getElementById('cartTotal');
        cartTotal.textContent = `$${total.toFixed(3)}`;
    }

    function disminuirCantidad(index) {
        const producto = carrito[index];
        producto.cantidad--;
        producto.subtotal = producto.cantidad * producto.precio;

        if (producto.cantidad === 0) {
            carrito.splice(index, 1);
        }

        actualizarCarrito();
    }

    function aumentarCantidad(index) {
        const producto = carrito[index];
        producto.cantidad++;
        producto.subtotal = producto.cantidad * producto.precio;

        actualizarCarrito();
    }

    function Totalpage1() {
        actualizarCarrito();
        $('#exampleModalToggle').modal('show');
    }

    // Función para mostrar la alerta
    function AñadidoCarrito() {
        Swal.fire({
            title: "Producto añadido al carrito",
            icon: "success"
        });
    }
</script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</body>
</html>
