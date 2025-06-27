<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>SGT - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Dashboard">
    <!-- Fuentes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
    <!-- Estilos personalizados para evitar diseño "chiquito" -->
    <style>
        body {
            font-size: 16px; /* Tamaño base para evitar que se vea pequeño */
        }
        .app-wrapper {
            min-height: 100vh;
        }
        .info-box {
            font-size: 1rem; /* Asegura tamaño legible en info-boxes */
        }
        .card-title {
            font-size: 1.25rem; /* Tamaño legible para títulos de tarjetas */
        }
        .table {
            font-size: 0.9rem; /* Tamaño legible para tablas */
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-md bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">SGT</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline"><?php echo esc($nombre); ?> (<?php echo ucfirst($rol); ?>)</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?php echo esc($nombre); ?> - <?php echo ucfirst($rol); ?>
                                    <small>Miembro desde <?php echo date('M. Y'); ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat float-end">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
                    <img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png'); ?>" alt="SGT Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">SGT</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php if ($rol === 'administrador' || $rol === 'supervisor'): ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('crear_usuario'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-person-fill"></i>
                                <p>Gestionar Usuarios</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item menu-open">
                            <a href="<?php echo base_url('tickets'); ?>" class="nav-link active">
                                <i class="nav-icon bi bi-ticket-fill"></i>
                                <p>Tickets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('logout'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Cerrar Sesión</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">SGT</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Info Boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-primary shadow-sm">
                                    <i class="bi bi-ticket-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets Abiertos</span>
                                    <span class="info-box-number">15</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-success shadow-sm">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets Cerrados</span>
                                    <span class="info-box-number">42</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-danger shadow-sm">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets Urgentes</span>
                                    <span class="info-box-number">3</span>
                                </div>
                            </div>
                        </div>
                        <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-warning shadow-sm">
                                    <i class="bi bi-clock-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets en Progreso</span>
                                    <span class="info-box-number">8</span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Tickets Table -->
                    <?php if ($rol === 'agente'): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Mis Tickets Asignados</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Error en sistema</td>
                                                    <td><span class="badge text-bg-warning">En Progreso</span></td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Ver</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Solicitud de soporte</td>
                                                    <td><span class="badge text-bg-primary">Abierto</span></td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Ver</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Todos los Tickets</h5>
                                    <div class="card-tools">
                                        <a href="#" class="btn btn-sm btn-primary">Asignar Ticket</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Categoria</th>
                                                    <th>Estado</th>
                                                    <th>Agente</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Error en sistema</td>
                                                    <td>Soporte</td>
                                                    <td><span class="badge text-bg-warning">En Progreso</span></td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Ver</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Solicitud de soporte</td>
                                                    <td>Ventas</td>
                                                    <td><span class="badge text-bg-primary">Abierto</span></td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Ver</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($rol === 'administrador'): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Gestión de Usuarios</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
                                            Crear Usuario
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Correo</th>
                                                    <th>Rol</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Juan Pérez</td>
                                                    <td>juan@empresa.com</td>
                                                    <td>Administrador</td>
                                                    <td><a href="#" class="btn btn-sm btn-warning">Editar</a>
                                                    <a></a><a href="#" class="btn btn-sm btn-danger">Eliminar</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal para Crear Usuario -->
                    <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url('crear_usuario'); ?>" method="post">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="correo" name="correo" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contrasena" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Rol</label>
                                            <select class="form-control" id="rol" name="rol" required>
                                                <option value="cliente">Cliente</option>
                                                <option value="agente">Agente</option>
                                                <option value="supervisor">Supervisor</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Chart -->
                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Tickets por Categoría</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="ticketsChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </main>
        <!-- Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">SGT v1.0</div>
            <strong>Copyright © 2025 <a href="https://techmeetings.net/">TechMeetings</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        // Configurar OverlayScrollbars
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
      
            // Configurar Chart.js (solo si el gráfico está presente)
            const chartElement = document.getElementById('ticketsChart');
            if (chartElement) {
                const ctx = chartElement.getContext('2d');
                const ticketsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Soporte', 'Ventas', 'Administración'],
                        datasets: [{
                            label: 'Tickets por Categoría',
                            data: [12, 19, 8],
                            backgroundColor: ['#0d6efd', '#20c997', '#ffc107'],
                            borderColor: ['#0d6efd', '#20c997', '#ffc107'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>