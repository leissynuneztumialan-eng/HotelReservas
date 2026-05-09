<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $habitacion_id = $_POST['habitacion_id'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];

    $sql_cliente = "INSERT INTO persona (dni, nombre, apellido, email) 
                    VALUES ('$dni', '$nombre', '$apellido', '$email') 
                    ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)";
    
    if (mysqli_query($conexion, $sql_cliente)) {
        $persona_id = mysqli_insert_id($conexion);
        $sql_reserva = "INSERT INTO reserva (persona_id, habitacion_id, fecha_entrada, fecha_salida) 
                        VALUES ('$persona_id', '$habitacion_id', '$entrada', '$salida')";
        if (mysqli_query($conexion, $sql_reserva)) {
            echo "<script>alert('Reserva Exitosa. ¡Te esperamos!'); window.location='index.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Reserva - Hotel Oasis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --booking-blue: #003580; --booking-yellow: #ffb700; }
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: var(--booking-blue); }
        .hero-small {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1350&q=80') center/cover;
            height: 150px;
            display: flex; align-items: center; justify-content: center; color: white;
        }
        .card-reserva { border: 4px solid var(--booking-yellow); border-radius: 8px; }
        .card-header-custom { background-color: var(--booking-blue); color: white; padding: 16px 20px; border-radius: 4px 4px 0 0; }
        .btn-reservar { background-color: var(--booking-yellow); color: #333; font-weight: bold; }
        .btn-reservar:hover { background-color: #e6a500; color: #333; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">Hotel Oasis del Sol</span>
        <a href="index.php" class="text-white text-decoration-none small">← Volver</a>
    </div>
</nav>

<div class="hero-small">
    <h2 class="fw-bold">Confirma tu reserva</h2>
</div>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-reserva bg-white shadow-sm">
                <div class="card-header-custom">
                    <h5 class="mb-0">Datos del Huésped</h5>
                </div>
                <div class="p-4">
                    <form action="reservar.php" method="POST">
                        <input type="hidden" name="habitacion_id" value="<?php echo $_GET['habitacion_id']; ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">DNI</label>
                                <input type="text" name="dni" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Entrada</label>
                                <input type="date" name="entrada" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Salida</label>
                                <input type="date" name="salida" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-reservar w-100 mt-4 py-2">Finalizar Reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>