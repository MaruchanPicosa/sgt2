<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGT - Editor</title>
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Crear Ticket">
    <!-- Fuentes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
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
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">SGT</a>
                    </li>
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
                    <img src="<?php echo base_url('assets/dist/assets/img/standex.png'); ?>" alt="SGT Logo" class="brand-image">
                    <span class="brand-text">SGT</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <?php if ($rol === 'administrador' || $rol === 'supervisor'|| $rol === 'agente'): ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        <?php endif; ?>
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
                        <div class="col-sm-6"><h3 class="mb-0">Editor</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('tickets'); ?>">Tickets</a></li>
                                <li class="breadcrumb-item active">Editor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php echo base_url('tickets'); ?>" class="btn btn-primary btn-block mb-3">Regresar</a>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Herramientas</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item">
                                                <a href="<?php echo base_url('tickets'); ?>" class="nav-link">
                                                    <i class="fas fa-inbox"></i> Bandeja
                                                    <span class="badge bg-primary float-right"><?php echo count($tickets ?? []); ?></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-envelope"></i> Mensajes
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="fas fa-filter"></i> Filtros
                                                    <span class="badge bg-warning float-right">65</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-trash-alt"></i> Basura
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Prioridad</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Alta</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Media</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Baja</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Crear Nuevo Ticket</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url('crear_ticket'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prioridad" class="form-label">Prioridad</label>
                                                <select class="form-control" id="prioridad" name="prioridad" required>
                                                    <option value="baja">Baja</option>
                                                    <option value="media">Media</option>
                                                    <option value="alta">Alta</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categoria_nombre" class="form-label">Categoría</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="categoria_nombre" name="categoria_nombre" placeholder="Escribe una nueva categoría o selecciona una existente" list="categorias_list" required>
                                                    <datalist id="categorias_list">
                                                        <?php foreach ($categorias as $categoria): ?>
                                                        <option value="<?php echo esc($categoria['nombre']); ?>">
                                                        <?php endforeach; ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="adjuntos" class="form-label">Adjuntos (opcional, máx. 6MB, jpg, png, pdf)</label>
                                                <input type="file" class="form-control" id="adjuntos" name="adjuntos[]" multiple accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Crear Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer -->
            <footer class="app-footer">
                <div class="float-end d-none d-sm-inline">SGT v1.0</div>
                <strong>Copyright © 2025 <a href="https://techmeetings.net/">TechMeetings</a>.</strong> Todos los derechos reservados.
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
    <!-- Page specific script -->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, { scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll } });
            }
        });
        setTimeout(function() {
        let flashMessages = document.querySelectorAll('.alert');
        flashMessages.forEach(function(message) {
            message.style.display = 'none';
        });
    }, 5000); // 5000 ms = 5 segundos
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"94f416d79db9f052","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.6.2","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>
</body>
</html>