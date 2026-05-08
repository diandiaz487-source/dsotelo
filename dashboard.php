```php id="8kcm3r"
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Biblioteca Rosa 2026</title>

    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

    <style>

        body{
            background-color:#fff5f8;
        }

        .navbar-custom{
            background: linear-gradient(135deg,#ff4f9a 0%, #ff85b3 100%);
        }

        .navbar-brand{
            font-weight:700;
            font-size:1.8rem;
            color:white !important;
        }

        .sidebar{
            background: linear-gradient(180deg,#ffe0ec 0%,#ffd1e3 100%);
            min-height:100vh;
        }

        .nav-link{
            border-radius:12px;
            margin-bottom:8px;
            transition:0.3s;
            color:#c2185b;
            font-weight:600;
        }

        .nav-link:hover{
            background-color:rgba(255,105,180,0.15);
            transform:translateX(5px);
            color:#ad1457;
        }

        .nav-link.active{
            background:linear-gradient(135deg,#ff4f9a 0%,#ff85b3 100%);
            color:white !important;
        }

        .card-hover{
            border:none;
            border-radius:20px;
            transition:0.3s;
        }

        .card-hover:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 25px rgba(255,105,180,0.25);
        }

        .btn-modern{
            background:linear-gradient(135deg,#ff4f9a 0%,#ff85b3 100%);
            border:none;
            color:white;
            border-radius:30px;
            padding:10px 25px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-modern:hover{
            transform:scale(1.05);
            color:white;
            box-shadow:0 5px 15px rgba(255,105,180,0.4);
        }

        .stats-card{
            background:linear-gradient(135deg,#ff4f9a 0%,#ff85b3 100%);
            color:white;
            border:none;
            border-radius:20px;
        }

        .stats-card .card-body{
            padding:2rem;
        }

        .title-dashboard{
            color:#d81b60;
            font-weight:700;
        }

        .card{
            border-radius:20px !important;
        }

        .shadow-sm{
            box-shadow:0 4px 12px rgba(255,105,180,0.15) !important;
        }

        @media(max-width:767px){

            .sidebar{
                position:fixed;
                top:0;
                left:-100%;
                width:280px;
                z-index:1050;
                transition:left 0.3s ease;
            }

            .sidebar.show{
                left:0;
            }

            .sidebar-backdrop{
                position:fixed;
                top:0;
                left:0;
                width:100%;
                height:100%;
                background:rgba(0,0,0,0.5);
                z-index:1040;
                display:none;
            }

            .sidebar-backdrop.show{
                display:block;
            }

        }

    </style>

    <script src="./wwwroot/js/jquery-4.0.0.min.js"></script>
    <script src="./wwwroot/js/script.js"></script>
    <script src="./wwwroot/js/dashboard.js"></script>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">

        <div class="container-fluid">

            <button class="btn btn-outline-light d-lg-none me-2" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand" href="#">
                <i class="bi bi-book-half me-2"></i>
                Biblioteca Rosa 2026
            </a>

            <div class="d-flex align-items-center">

                <span class="text-white me-3">
                    <i class="bi bi-person-circle me-1"></i>
                    diandiaz12@gmail.com
                </span>

                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Salir
                </a>

            </div>

        </div>

    </nav>

    <!-- BACKDROP -->

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->

    <aside class="sidebar d-flex flex-column p-3 position-fixed" id="sidebar">

        <h5 class="fw-bold text-danger mb-4">
            <i class="bi bi-grid-3x3-gap me-2"></i>
            Menú Principal
        </h5>

        <nav class="nav nav-pills flex-column flex-grow-1">

            <a class="nav-link active" href="dashboard.php">
                <i class="bi bi-house-door-fill me-2"></i>
                Dashboard
            </a>

            <a class="nav-link" href="autores.php">
                <i class="bi bi-people-fill me-2"></i>
                Autores
            </a>

            <a class="nav-link" href="libros.php">
                <i class="bi bi-book-fill me-2"></i>
                Libros
            </a>

            <a class="nav-link" href="prestamos.php">
                <i class="bi bi-journal-bookmark-fill me-2"></i>
                Préstamos
            </a>

        </nav>

    </aside>

    <!-- CONTENIDO -->

    <main class="flex-grow-1 p-4" id="mainContent" style="margin-left:280px;">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h1 class="h2 title-dashboard mb-1">
                        Panel de Control
                    </h1>

                    <p class="text-muted mb-0">
                        Gestiona tu biblioteca digital con facilidad
                    </p>

                </div>

            </div>

            <!-- TARJETAS -->

            <div class="row g-4 mb-5">

                <div class="col-md-6 col-lg-4">

                    <div class="card card-hover h-100 shadow-sm">

                        <div class="card-body text-center p-4">

                            <div class="bg-danger bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width:60px;height:60px;">

                                <i class="bi bi-people-fill text-white fs-4"></i>

                            </div>

                            <h5 class="fw-bold">
                                Gestión de Autores
                            </h5>

                            <p class="text-muted">
                                Administra autores fácilmente.
                            </p>

                            <a href="autores.php" class="btn btn-modern">
                                Acceder
                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4">

                    <div class="card card-hover h-100 shadow-sm">

                        <div class="card-body text-center p-4">

                            <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width:60px;height:60px;">

                                <i class="bi bi-book-fill text-white fs-4"></i>

                            </div>

                            <h5 class="fw-bold">
                                Catálogo de Libros
                            </h5>

                            <p class="text-muted">
                                Gestiona libros y disponibilidad.
                            </p>

                            <a href="libros.php" class="btn btn-modern">
                                Acceder
                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4">

                    <div class="card card-hover h-100 shadow-sm">

                        <div class="card-body text-center p-4">

                            <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width:60px;height:60px;">

                                <i class="bi bi-journal-bookmark-fill text-white fs-4"></i>

                            </div>

                            <h5 class="fw-bold">
                                Sistema de Préstamos
                            </h5>

                            <p class="text-muted">
                                Controla préstamos y devoluciones.
                            </p>

                            <a href="prestamos.php" class="btn btn-modern">
                                Acceder
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ESTADISTICAS -->

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold text-danger">
                        <i class="bi bi-bar-chart-line me-2"></i>
                        Estadísticas del Sistema
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row text-center g-4">

                        <div class="col-md-4">

                            <div class="stats-card">

                                <div class="card-body">

                                    <i class="bi bi-people-fill fs-1 mb-3 opacity-75"></i>

                                    <h2 id="totalAuthors">
                                        3
                                    </h2>

                                    <p>
                                        Total Autores
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="stats-card">

                                <div class="card-body">

                                    <i class="bi bi-book-fill fs-1 mb-3 opacity-75"></i>

                                    <h2 id="totalBooks">
                                        3
                                    </h2>

                                    <p>
                                        Total Libros
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="stats-card">

                                <div class="card-body">

                                    <i class="bi bi-journal-bookmark-fill fs-1 mb-3 opacity-75"></i>

                                    <h2 id="activeLoans">
                                        0
                                    </h2>

                                    <p>
                                        Préstamos Activos
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

    <script>

        document.getElementById('sidebarToggle').addEventListener('click', function(){

            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarBackdrop').classList.toggle('show');

        });

        document.getElementById('sidebarBackdrop').addEventListener('click', function(){

            document.getElementById('sidebar').classList.remove('show');
            this.classList.remove('show');

        });

    </script>

    <script src="./wwwroot/js/bootstrap.bundle.min.js"></script>

</body>

</html>
```
