<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>SGT - Ver Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Ver Ticket">
    <!-- Fuentes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
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
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">Ticket #<?php echo substr($ticket['id'], 0, 8); ?>...</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">SGT</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('tickets'); ?>">Tickets</a></li>
                                <li class="breadcrumb-item active">Ver Ticket</li>
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
                    <!-- Ticket Details -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <div class="mailbox-read-info">
                                        <h5><?php echo esc($ticket['titulo']); ?></h5>
                                        <h6>De: <?php echo esc($ticket['usuario_nombre']); ?>
                                            <span class="mailbox-read-time float-right"><?php echo date('d M. Y H:i A', strtotime($ticket['creado_en'])); ?></span>
                                        </h6>
                                    </div>
                                    <div class="mailbox-controls with-border text-right">
                                        <div class="btn-group">
                                            <?php if ($rol === 'administrador' || $ticket['id_usuario'] === session()->get('user_id')): ?>
                                                <button type="button" class="btn btn-default btn-sm" id="editTicketBtn" title="Editar Ticket">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" id="deleteTicketBtn" title="Eliminar Ticket">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="mailbox-read-message" id="ticketDetails">
                                        <p><strong>Descripción:</strong></p>
                                        <p><?php echo nl2br(esc($ticket['descripcion'])); ?></p>
                                        <p><strong>Categoría:</strong> <?php echo esc($ticket['categoria_nombre']); ?></p>
                                        <p><strong>Prioridad:</strong> <?php echo ucfirst($ticket['prioridad']); ?></p>
                                        <p><strong>Estado:</strong> <?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></p>
                                        <?php if ($rol !== 'cliente'): ?>
                                        <p><strong>Agente:</strong> <?php echo $ticket['agente_nombre'] ?: 'Sin asignar'; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Formulario de Edición -->
                                    <div class="mailbox-read-message" id="editTicketForm" style="display: none;">
                                        <form action="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo esc($ticket['titulo']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo esc($ticket['descripcion']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prioridad" class="form-label">Prioridad</label>
                                                <select class="form-select" id="prioridad" name="prioridad" required>
                                                    <option value="baja" <?php echo $ticket['prioridad'] === 'baja' ? 'selected' : ''; ?>>Baja</option>
                                                    <option value="media" <?php echo $ticket['prioridad'] === 'media' ? 'selected' : ''; ?>>Media</option>
                                                    <option value="alta" <?php echo $ticket['prioridad'] === 'alta' ? 'selected' : ''; ?>>Alta</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
                                        </form>
                                    </div>
                                    <!-- Adjuntos del Ticket -->
                                    <?php if (!empty($ticket['adjuntos'])): ?>
                                    <div class="card-footer bg-white">
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                            <?php foreach ($ticket['adjuntos'] as $adjunto): ?>
                                            <li>
                                                <span class="mailbox-attachment-icon">
                                                    <?php if (in_array(pathinfo($adjunto['nombre_archivo'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])): ?>
                                                        <img src="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" alt="Vista previa" class="mailbox-attachment-img" style="max-width: 100px; max-height: 100px;" onerror="this.style.display='none';">
                                                        <?php echo '<pre>URL generada: ' . base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])) . '</pre>'; ?>
                                                    <?php elseif (in_array(pathinfo($adjunto['nombre_archivo'], PATHINFO_EXTENSION), ['pdf'])): ?>
                                                        <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" target="_blank" class="pdf-preview">
                                                            <i class="far fa-file-pdf" ></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <i class="far fa-file" style="font-size: 24px;"></i>
                                                    <?php endif; ?>
                                                </span>
                                                <div class="mailbox-attachment-info">
                                                    <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="mailbox-attachment-name" target="_blank" download="<?php echo esc($adjunto['nombre_archivo']); ?>" >
                                                        <i class="fas fa-paperclip"></i> <?php echo esc($adjunto['nombre_archivo']); ?>
                                                    </a>
                                                    <span class="mailbox-attachment-size clearfix mt-1">
                                                        <?php
                                                        $fullPath = FCPATH . 'uploads/tickets/' . basename($adjunto['ruta_archivo']);
                                                        echo '<pre>Ruta completa: ' . $fullPath . '</pre>';
                                                        $size = file_exists($fullPath) ? round(filesize($fullPath) / 1024, 2) : 0;
                                                        echo '<span>' . ($size > 0 ? $size . ' KB' : 'N/A') . '</span>';
                                                        ?>
                                                        <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="btn btn-default btn-sm float-right" target="_blank" download>
                                                            <i class="fas fa-cloud-download-alt"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                                        <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                                    </div>
                                    <?php if ($rol === 'administrador' || $ticket['id_usuario'] === session()->get('user_id')): ?>
                                        <button type="button" class="btn btn-danger" id="deleteTicketBtn"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hilo de Conversación -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Hilo de Conversación</h5>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($ticket['comentarios'] as $comentario): ?>
                                    <?php if (!$comentario['es_interno'] || in_array($rol, ['agente', 'supervisor', 'administrador'])): ?>
                                    <div class="mb-3 p-3 border rounded <?php echo $comentario['es_interno'] ? 'bg-light' : ''; ?>">
                                        <p><strong><?php echo esc($comentario['usuario_nombre']); ?></strong> <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($comentario['creado_en'])); ?></small></p>
                                        <p><?php echo nl2br(esc($comentario['comentario'])); ?></p>
                                        <?php if ($comentario['es_interno']): ?>
                                        <span class="badge text-bg-warning">Nota Interna</span>
                                        <?php endif; ?>
                                        <?php if (!empty($comentario['adjuntos']) && (!$comentario['es_interno'] || in_array($rol, ['administrador', 'supervisor', 'agente']))): ?>
                                        <p><strong>Adjuntos:</strong></p>
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                            <?php foreach ($comentario['adjuntos'] as $adjunto): ?>
                                            <li>
                                                <span class="mailbox-attachment-icon">
                                                    <?php if (in_array(pathinfo($adjunto['nombre_archivo'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])): ?>
                                                        <img src="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" alt="Vista previa" class="mailbox-attachment-img" style="max-width: 100px; max-height: 100px;" onerror="this.style.display='none';">
                                                    <?php elseif (in_array(pathinfo($adjunto['nombre_archivo'], PATHINFO_EXTENSION), ['pdf'])): ?>
                                                        <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" target="_blank" class="pdf-preview" style="text-decoration: none; color: inherit;">
                                                            <i class="far fa-file-pdf" style="font-size: 24px;"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <i class="far fa-file" style="font-size: 24px;"></i>
                                                    <?php endif; ?>
                                                </span>
                                                <div class="mailbox-attachment-info">
                                                    <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="mailbox-attachment-name" target="_blank" download style="font-size: 14px;">
                                                        <i class="fas fa-paperclip"></i> <?php echo esc($adjunto['nombre_archivo']); ?>
                                                    </a>
                                                    <span class="mailbox-attachment-size clearfix mt-1">
                                                        <?php
                                                        $fullPath = FCPATH . 'uploads/tickets/' . basename($adjunto['ruta_archivo']);
                                                        $size = file_exists($fullPath) ? round(filesize($fullPath) / 1024, 2) : 0;
                                                        echo '<span>' . ($size > 0 ? $size . ' KB' : 'N/A') . '</span>';
                                                        ?>
                                                        <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="btn btn-default btn-sm float-right" target="_blank" download>
                                                            <i class="fas fa-cloud-download-alt"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Añadir Comentario -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Añadir Comentario</h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="comentario" class="form-label">Comentario</label>
                                            <textarea class="form-control" id="comentario" name="comentario" rows="4" required></textarea>
                                        </div>
                                        <?php if (in_array($rol, ['agente', 'supervisor', 'administrador'])): ?>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="es_interno" name="es_interno" value="1">
                                            <label for="es_interno" class="form-check-label">Nota Interna (no visible para clientes)</label>
                                        </div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label for="adjuntos" class="form-label">Adjuntos (opcional, máx. 6MB, jpg, png, pdf)</label>
                                            <input type="file" class="form-control" id="adjuntos" name="adjuntos[]" multiple accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                                    </form>
                                </div>
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
        // Mostrar/Ocultar formulario de edición
        document.getElementById('editTicketBtn').addEventListener('click', function() {
            document.getElementById('ticketDetails').style.display = 'none';
            document.getElementById('editTicketForm').style.display = 'block';
        });
        document.getElementById('cancelEditBtn').addEventListener('click', function() {
            document.getElementById('ticketDetails').style.display = 'block';
            document.getElementById('editTicketForm').style.display = 'none';
        });

        // Confirmación para eliminar ticket
        document.getElementById('deleteTicketBtn').addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas eliminar este ticket? Esta acción no se puede deshacer.')) {
                window.location.href = '<?php echo base_url('eliminar_ticket/' . $ticket['id']); ?>';
            }
        });

        // Ocultar mensajes flash después de 5 segundos
        setTimeout(function() {
            let flashMessages = document.querySelectorAll('.alert');
            flashMessages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 5000);
    </script>
</body>
</html>