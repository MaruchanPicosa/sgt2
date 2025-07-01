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
                                <p><?php echo esc($nombre); ?> - <?php echo ucfirst($rol); ?><small>Miembro desde <?php echo date('M. Y'); ?></small></p>
                            </li>
                            <li class="user-footer"><a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat float-end">Cerrar Sesión</a></li>
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
                    <span class="brand-text fw-light">SGT</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="true">
                        <li class="nav-item"><a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i class="nav-icon bi bi-speedometer"></i><p>Dashboard</p></a></li>
                        <?php if ($rol === 'administrador'|| $rol === 'supervisor'): ?><li class="nav-item"><a href="<?php echo base_url('crear_usuario'); ?>" class="nav-link active"><i class="nav-icon bi bi-person-fill"></i><p>Gestionar Usuarios</p></a></li><?php endif; ?>
                        <li class="nav-item"><a href="<?php echo base_url('tickets'); ?>" class="nav-link"><i class="nav-icon bi bi-ticket-fill"></i><p>Tickets</p></a></li>
                        <li class="nav-item"><a href="<?php echo base_url('logout'); ?>" class="nav-link"><i class="nav-icon bi bi-box-arrow-right"></i><p>Cerrar Sesión</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="app-content">
            <section class="content"><br>
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6"><h3 class="mb-0">Gestor de Usuarios</h3></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">SGT</a></li>
                                    <li class="breadcrumb-item active">Usuarios</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="app-content">
                    <div class="container-fluid">
                        <!-- Lista de Usuarios -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title"></h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
                                                <h6>Crear Usuario</h6>
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
                                                        <th>Creado el</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($usuarios as $usuario): ?>
                                                    <tr>
                                                        <td><?php echo substr($usuario['id'], 0, 8); ?></td>
                                                        <td><?php echo esc($usuario['nombre']); ?></td>
                                                        <td><?php echo esc($usuario['correo']); ?></td>
                                                        <td><?php echo esc($usuario['rol']); ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($usuario['creado_en'])); ?></td>
                                                        <td>
                                                            <?php if (session()->get('rol') === 'administrador'): ?>
                                                                <a href="<?php echo base_url('editar_usuario/' . $usuario['id']); ?>" class="btn btn-sm btn-warning">Editar</a>
                                                                <a href="<?php echo base_url('eliminar_usuario/' . $usuario['id']); ?>" class="btn btn-sm btn-danger">Eliminar</a>
                                                            <?php else: ?>
                                                                <span class="text-muted">Sin permisos</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
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
                    <!-- Modal para Editar Usuario -->
                    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editarUsuarioForm" action="" method="post">
                                        <input type="hidden" name="id" id="editarUsuarioId">
                                        <div class="mb-3">
                                            <label for="editarNombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="editarNombre" name="nombre" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="editarCorreo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="editarCorreo" name="correo">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editarContrasena" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="editarContrasena" name="contrasena" disabled placeholder="No se puede cambiar">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editarRol" class="form-label">Rol</label>
                                            <select class="form-control" id="editarRol" name="rol">
                                                <option value="cliente">Cliente</option>
                                                <option value="agente">Agente</option>
                                                <option value="supervisor">Supervisor</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
        const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, { scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll } });
            }
        });

        // Manejar edición de usuario
        document.querySelectorAll('.btn-warning').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const id = row.cells[0].textContent.padEnd(36, '0'); // Completar ID a 36 caracteres
                const nombre = row.cells[1].textContent;
                const correo = row.cells[2].textContent;
                const rol = row.cells[3].textContent;

                document.getElementById('editarUsuarioId').value = id;
                document.getElementById('editarNombre').value = nombre;
                document.getElementById('editarCorreo').value = correo;
                document.getElementById('editarRol').value = rol;
                document.getElementById('editarUsuarioForm').action = '<?php echo base_url('editar_usuario'); ?>/' + id;
                new bootstrap.Modal(document.getElementById('editarUsuarioModal')).show();
            });
        });

        // Manejar eliminación de usuario
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(e) {
                if (confirm('¿Estás seguro de eliminar este usuario?')) {
                    // Obtener ID del usuario desde la fila
                    const row = this.closest('tr');
                    // Completar ID a 36 caracteres
                    const id = row.cells[0].textContent.padEnd(36, '0');
                    window.location.href = '<?php echo base_url('eliminar_usuario'); ?>/' + id;
                }
            });
        });
    </script>
</body>
</html>