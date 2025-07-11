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
    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
    <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
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
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
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
                            <img src="<?php echo base_url('assets/dist/assets/img/user2-160x160.jpg'); ?>" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline"><?php echo esc($nombre); ?> (<?php echo ucfirst($rol); ?>)</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="<?php echo base_url('assets/dist/assets/img/user2-160x160.jpg'); ?>" class="rounded-circle shadow" alt="User Image">
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
                    <img src="<?php echo base_url('assets/dist/assets/img/standex.png'); ?>" alt="SGT Logo" class="brand-image ">
                    <span class="brand-text ">SGT</span>
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
                        <?php if ($rol === 'supervisor' || $rol === 'administrador'|| $rol === 'agente'): ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-thumbs-up"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total de Tickets</span>
                                    <span class="info-box-number"><?php echo $totalTickets; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-primary shadow-sm">
                                    <i class="bi bi-ticket-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets Abiertos</span>
                                    <span class="info-box-number"><?php echo $ticketsAbiertos; ?></span>
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
                                    <span class="info-box-number"><?php echo $ticketsEnProgreso; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-danger shadow-sm">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tickets Cerrados</span>
                                    <span class="info-box-number"><?php echo $ticketsCerrados; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tickets Table -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Tabla de Tickets </h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="ticketsTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Creado por</th>
                                                <th>Título</th>
                                                <th>Estado</th>
                                                <th>Prioridad</th>
                                                <th>Agente a Cargo</th>
                                                <th>Categoría</th>
                                                <th>Creado</th>
                                                <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                <th>Acciones</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tickets as $ticket): ?>
                                            <tr>
                                                <td><?php echo $ticket['id']; ?></td>
                                                <td><?php echo esc($ticket['usuario_nombre']); ?></td>
                                                <td><?php echo esc($ticket['titulo']); ?></td>
                                                <td>
                                                    <span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'danger' : ($ticket['estado'] === 'reabierto' ? 'info' : ($ticket['estado'] === 'esperando_cliente' ? 'secondary' : 'light')))); ?>">
                                                        <?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo ucfirst($ticket['prioridad']); ?></td>
                                                <td><?php echo $ticket['agente_nombre'] ?: 'No asignado'; ?></td>
                                                <td><?php echo esc($ticket['categoria_nombre']) ?: 'Sin categoría'; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($ticket['creado_en'])); ?></td>
                                                <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                <td><a href="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" class="btn btn-sm btn-primary">Ver</a></td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Creado por</th>
                                                <th>Título</th>
                                                <th>Estado</th>
                                                <th>Prioridad</th>
                                                <th>Agente a Cargo</th>
                                                <th>Categoría</th>
                                                <th>Creado</th>
                                                <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                <th>Acciones</th>
                                                <?php endif; ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <canvas id="ticketsChart" height="100"></canvas>
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
   <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS & Plugins -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<!-- Otros scripts existentes (OverlayScrollbars, Bootstrap, Chart.js, AdminLTE) -->
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
                        labels: <?php echo json_encode(array_column($categorias, 'nombre')); ?>,
                        datasets: [{
                            label: 'Total',
                            data: <?php echo json_encode(array_column($categorias, 'totalTickets')); ?>,
                             backgroundColor: [
                                'rgba(60, 178, 127, 0.2)',
                                
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                               
                            ],
                            borderWidth: 2 
                        },
                        {
                            label:'Abiertos',
                            data: <?php echo json_encode(array_column($categorias, 'ticketsAbiertos')); ?>,
                             backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                
                                
                            ],
                            borderWidth: 2 
                            
                        },
                         {
                            label: 'En Progreso',
                            data: <?php echo json_encode(array_column($categorias, 'ticketsEnProgreso')); ?>,
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.2)',
                                
                            ],
                            borderColor: [
                                'rgba(255, 206, 86, 1)',
                                
                            ],
                            borderWidth: 2  
                        },
                        {
                            label: 'Cerrados',
                            data: <?php echo json_encode(array_column($categorias, 'ticketsCerrados')); ?>,
                             backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                
                            ],
                            borderWidth: 2 
                        },
                        {
                            label: 'Reabiertos',
                            data: <?php echo json_encode(array_column($categorias, 'ticketsReabiertos')); ?>,
                             backgroundColor: [
                                'rgba(153, 102, 255, 0.2)',
                                
                            ],
                            borderColor: [
                                'rgba(153, 102, 255, 1)',
                                
                            ],
                            borderWidth: 2 
                        }
                    ],   
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            }
                
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                
                                title: {
                                    display: true,
                                    text: 'Número de Tickets'
                                }
                            }
                        }
                    }
                });
            }

        // Inicializar DataTable para la tabla de tickets
        $('#ticketsTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "dom": 'Bfrtip', // Asegura que 'B' esté presente para los botones
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" // Idioma español
            }
        }).buttons().container().appendTo('#ticketsTable_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>