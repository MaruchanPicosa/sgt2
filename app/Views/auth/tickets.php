<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>SGT - Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Tickets">
    <!-- Fuentes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="true">
                        <li class="nav-item">
                            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php if ($rol === 'administrador'|| $rol === 'supervisor'): ?>
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
                        <div class="col-sm-6"><h3 class="mb-0">Tickets</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">SGT</a></li>
                                <li class="breadcrumb-item active">Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="<?php echo base_url('crear_ticket'); ?>" class="btn btn-primary">Crear Ticket</a>
                        </div>
                    </div>
                    <!-- Filtros de Búsqueda -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Filtros</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="estado" class="form-label">Estado</label>
                                                <select class="form-control" id="estado" name="estado">
                                                    <option value="">Todos</option>
                                                    <option value="abierto">Abierto</option>
                                                    <option value="en_progreso">En Progreso</option>
                                                    <option value="esperando_cliente">Esperando Cliente</option>
                                                    <option value="cerrado">Cerrado</option>
                                                    <option value="reabierto">Reabierto</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="id_categoria" class="form-label">Categoría</label>
                                                <select class="form-control" id="id_categoria" name="id_categoria">
                                                    <option value="">Todas</option>
                                                    <?php foreach ($categorias as $categoria): ?>
                                                    <option value="<?php echo $categoria['id']; ?>"><?php echo esc($categoria['nombre']); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                            <div class="col-md-3 mb-3">
                                                <label for="asignado_a" class="form-label">Agente</label>
                                                <select class="form-control" id="asignado_a" name="asignado_a">
                                                    <option value="">Todos</option>
                                                    <!-- Llenar con agentes desde la base de datos -->
                                                </select>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-md-3 mb-3">
                                                <label for="buscar" class="form-label">Buscar</label>
                                                <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Título o ID">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Lista de Tickets -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title"><?php echo $rol === 'cliente' ? 'Mis Tickets' : ($rol === 'agente'? 'Tickets Asignados' : 'Todos los Tickets'); ?></h5>
            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Categoría</th>
                                                    <th>Prioridad</th>
                                                    <th>Estado</th>
                                                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                    <th>Agente</th>
                                                    <?php endif; ?>
                                                    <th>Creado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tickets as $ticket): ?>
                                                <tr>
                                                    <td><?php echo substr($ticket['id'], 0, 8); ?>...</td>
                                                    <td><?php echo esc($ticket['titulo']); ?></td>
                                                    <td><?php echo esc($ticket['categoria_nombre']); ?></td>
                                                    <td><?php echo ucfirst($ticket['prioridad']); ?></td>
                                                    <td><span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'success' : ($ticket['estado'] === 'reabierto' ? 'info' : 'secondary'))); ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></span></td>
                                                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                    <td><?php echo $ticket['agente_nombre'] ?: 'Sin asignar'; ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo date('d/m/Y', strtotime($ticket['creado_en'])); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" class="btn btn-sm btn-primary">Ver</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--<div class="card-header">
                                    <h5 class="card-title"><?php echo $rol === 'agente' ? 'Tickets sin Asignar' :''; ?></h5>
            
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Categoría</th>
                                                    <th>Prioridad</th>
                                                    <th>Estado</th>
                                                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                    <th>Agente</th>
                                                    <?php endif; ?>
                                                    <th>Creado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tickets as $ticket): ?>
                                                <tr>
                                                    <td><?php echo substr($ticket['id'], 0, 8); ?>...</td>
                                                    <td><?php echo esc($ticket['titulo']); ?></td>
                                                    <td><?php echo esc($ticket['categoria_nombre']); ?></td>
                                                    <td><?php echo ucfirst($ticket['prioridad']); ?></td>
                                                    <td><span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'success' : ($ticket['estado'] === 'reabierto' ? 'info' : 'secondary'))); ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></span></td>
                                                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                    <td><?php echo $ticket['agente_nombre'] ?: 'Sin asignar'; ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo date('d/m/Y', strtotime($ticket['creado_en'])); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" class="btn btn-sm btn-primary">Ver</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
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
        });
    </script>
</body>
</html>