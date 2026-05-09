<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Oasis del Sol | Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --booking-blue: #003580;
            --booking-yellow: #ffb700;
        }
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: var(--booking-blue); color: white; padding: 10px 0; }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
                        url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1350&q=80') center/cover;
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .hero h1 { font-size: 3.5rem; font-weight: bold; text-shadow: 2px 2px 8px rgba(0,0,0,0.7); }
        .search-container { margin-top: -30px; position: relative; z-index: 10; }
        .search-box {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            border: 4px solid var(--booking-yellow);
        }
        .card-hotel { border: 1px solid #ddd; transition: 0.3s; height: 100%; }
        .card-hotel:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-img-top { height: 200px; object-fit: cover; }
        .btn-booking { background-color: #006ce4; color: white; font-weight: bold; }
        .btn-booking:hover { background-color: #003580; color: white; }
        .precio { color: #006ce4; font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">Hotel Oasis del Sol</span>
    </div>
</nav>

<header class="hero">
    <div class="container">
        <h1>Encuentra tu próxima estancia</h1>
    </div>
</header>

<div class="container search-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="search-box">
                <form class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="small fw-bold">¿A dónde vas?</label>
                        <input type="text" class="form-control" placeholder="Hotel Oasis del Sol">
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold">Entrada</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold">Salida</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold">Tipo de habitación</label>
                        <select class="form-select">
                            <option>Todas</option>
                            <option>Simple</option>
                            <option>Doble</option>
                            <option>Suite</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="small fw-bold">Precio máx.</label>
                        <input type="number" class="form-control" placeholder="550">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary w-100 fw-bold py-2">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<main class="container my-5">
    <h3 class="fw-bold mb-4">Habitaciones disponibles</h3>
    <div class="row">
        <?php
        $fotos_online = [
            "https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500",
            "https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=500",
            "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500"
        ];
        $i = 0;

        $query = "SELECT h.id, t.nombre, t.descripcion, t.precio_noche 
                  FROM habitacion h 
                  JOIN tipo_habitacion t ON h.tipo_id = t.id 
                  WHERE h.estado = 'disponible'
                  GROUP BY t.id";
        $resultado = mysqli_query($conexion, $query);

        while($row = mysqli_fetch_assoc($resultado)) {
            $img_url = $fotos_online[$i % 3];
        ?>
        <div class="col-md-4 mb-4">
            <div class="card card-hotel">
                <img src="<?php echo $img_url; ?>" class="card-img-top" alt="Habitación">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $row['nombre']; ?></h5>
                    <p class="precio mb-1">S/ <?php echo number_format($row['precio_noche'], 2); ?> por noche</p>
                    <p class="card-text text-muted small"><?php echo $row['descripcion']; ?></p>
                    <div class="text-end">
                        <a href="reservar.php?habitacion_id=<?php echo $row['id']; ?>" class="btn btn-booking btn-sm px-3">Reservar ahora</a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $i++; 
        } 
        ?>
    </div>
</main>

<footer class="bg-white border-top py-4 mt-5 text-center text-muted small">
    © 2026 Hotel Oasis del Sol - SENATI Project
</footer>

</body>
</html>