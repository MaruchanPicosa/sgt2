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
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <?php if ($rol === 'administrador' || $rol === 'supervisor'|| $rol === 'agente'): ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        <?php endif; ?>
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
                    <!-- Ticket y Hilo de Conversación en dos columnas -->
                    <div class="row">
                        <!-- Columna del Ticket -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <!-- Dentro del card-body de la columna col-md-6 (Ticket) después de los párrafos de detalles -->
                                    <?php if (in_array($rol, ['agente', 'supervisor', 'administrador'])): ?>
                                        <div class="d-flex justify-content-end mt-2">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.875rem; padding: 4px 12px;">
                                                    Cambiar Estado
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <form method="post" action="<?php echo base_url('cambiar_estado/' . $ticket['id']); ?>" class="needs-validation" novalidate>
                                                        <?php
                                                        $asignado_a = $ticket['asignado_a'];
                                                        $user_id = session()->get('user_id');
                                                        $isAssignedAgent = ($rol === 'agente' && $asignado_a == $user_id) || in_array($rol, ['supervisor', 'administrador']);
                                                        if ($isAssignedAgent):
                                                            if ($ticket['estado'] === 'en_progreso'):
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="cerrado">Cerrado</button></li>';
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="esperando_cliente">Esperando Cliente</button></li>';
                                                            elseif ($ticket['estado'] === 'cerrado' && in_array($rol, ['supervisor', 'administrador'])):
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="reabierto">Reabierto</button></li>';
                                                            elseif ($ticket['estado'] === 'reabierto'):
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="cerrado">Cerrado</button></li>';
                                                            elseif ($ticket['estado'] === 'esperando_cliente'):
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="en_progreso">En Progreso</button></li>';
                                                                echo '<li><button type="submit" class="dropdown-item" name="nuevo_estado" value="cerrado">Cerrado</button></li>';
                                                            endif;
                                                        endif;
                                                        ?>
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="mailbox-read-message" id="ticketDetails">
                                        <p><strong>Descripción:</strong></p>
                                        <p><?php echo nl2br(esc($ticket['descripcion'])); ?></p>
                                        <p><strong>Categoría:</strong> <?php echo esc($ticket['categoria_nombre']); ?></p>
                                        <p><strong>Prioridad:</strong> <?php echo ucfirst($ticket['prioridad']); ?></p>
                                        <p><strong>Estado:</strong> <span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'danger' : ($ticket['estado'] === 'reabierto' ? 'info' : ($ticket['estado'] === 'esperando_cliente' ? 'secondary' : 'light')))); ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></span></p>
                                        
                                        <p><strong>Agente asignado:</strong> <?php echo $ticket['agente_nombre'] ?: 'Sin asignar'; ?></p>
                                       
                                    </div>
                                    <!-- Formulario de Edición -->
                                    <div class="mailbox-read-message" id="editTicketForm" style="display: none;">
                                        <form action="<?php echo base_url('editar_ticket/' . $ticket['id']); ?>" method="post">
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo esc($ticket['titulo']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo esc($ticket['descripcion']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categoria" class="form-label">Categoría</label>
                                                <select class="form-select" id="categoria" name="categoria" required>
                                                    <?php
                                                    $ticketModel = new \App\Models\TicketModel();
                                                    $categorias = $ticketModel->getCategorias();
                                                    foreach ($categorias as $cat) {
                                                        $selected = ($cat['id'] == $ticket['id_categoria']) ? 'selected' : '';
                                                        echo "<option value=\"{$cat['id']}\" $selected>{$cat['nombre']}</option>";
                                                    }
                                                    ?>
                                                    <option value="new">Crear nueva categoría...</option>
                                                </select>
                                                <div id="newCategoryField" style="display: none; margin-top: 10px;">
                                                    <input type="text" class="form-control" id="new_categoria" name="new_categoria" placeholder="Nombre de la nueva categoría">
                                                </div>
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
                                                                    <i class="far fa-file-pdf"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="far fa-file" style="font-size: 24px;"></i>
                                                            <?php endif; ?>
                                                        </span>
                                                        <div class="mailbox-attachment-info">
                                                            <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="mailbox-attachment-name" target="_blank" download="<?php echo esc($adjunto['nombre_archivo']); ?>">
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
                                    <?php if ($rol === 'administrador' || $ticket['id_usuario'] === session()->get('user_id')): ?>
                                        <button type="button" class="btn btn-danger" id="deleteTicketBtn"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Columna del Hilo de Conversación -->
                        <div class="col-md-6">
                            <div class="card direct-chat direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Hilo de Conversación</h3>
                                    <div class="card-tools">
                                        <span title="Nuevos Mensajes" class="badge badge-primary"><?php echo count($ticket['comentarios']); ?></span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="min-height: 500px; max-height: 500px; overflow-y: auto;">
                                    <div class="direct-chat-messages" style="height: 450px;">
                                        <?php foreach ($ticket['comentarios'] as $comentario): ?>
                                            <?php if (!$comentario['es_interno'] || in_array($rol, ['agente', 'supervisor', 'administrador'])): ?>
                                                <?php
                                                // Determinar si el mensaje es del usuario actual
                                                $isCurrentUser = session()->get('user_id') == $comentario['id_usuario'];
                                                $messageClass = $isCurrentUser ? 'direct-chat-msg right' : 'direct-chat-msg';
                                                ?>
                                                <div class="<?php echo $messageClass; ?>">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span class="direct-chat-name <?php echo $isCurrentUser ? 'float-right' : 'float-left'; ?>">
                                                            <?php echo esc($comentario['usuario_nombre']); ?>
                                                        </span>
                                                        <span class="direct-chat-timestamp <?php echo $isCurrentUser ? 'float-left' : 'float-right'; ?>">
                                                            <?php echo date('d M h:i a', strtotime($comentario['creado_en'])); ?>
                                                        </span>
                                                    </div>
                                                    <img class="direct-chat-img" src="<?php echo base_url('assets/dist/assets/img/user1-128x128.jpg'); ?>" alt="User Image">
                                                    <div class="direct-chat-text">
                                                        <?php echo nl2br(esc($comentario['comentario'])); ?>
                                                    </div>
                                                    <?php if ($comentario['es_interno']): ?>
                                                        <span class="badge text-bg-warning">Nota Interna</span>
                                                    <?php endif; ?>
                                                    <?php if (!empty($comentario['adjuntos']) && (!$comentario['es_interno'] || in_array($rol, ['administrador', 'supervisor', 'agente']))): ?>
                                                        <p>
                                                            <?php foreach ($comentario['adjuntos'] as $adjunto): ?>
                                                                <a href="<?php echo base_url('uploads/tickets/' . basename($adjunto['ruta_archivo'])); ?>" class="link-black text-sm" target="_blank" download="<?php echo esc($adjunto['nombre_archivo']); ?>">
                                                                    <i class="fas fa-link mr-1"></i> <?php echo esc($adjunto['nombre_archivo']); ?>
                                                                </a>
                                                            <?php endforeach; ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Formulario de Añadir Comentario en el footer -->
                                <div class="card-footer">
                                    <form action="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <textarea class="form-control" id="comentario" name="comentario" rows="1" placeholder="Escribe un comentario..." style="resize: none; height: 38px;" required></textarea>
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                        <?php if (in_array($rol, ['agente', 'supervisor', 'administrador'])): ?>
                                            <div class="mt-2 form-check">
                                                <input type="checkbox" class="form-check-input" id="es_interno" name="es_interno" value="1">
                                                <label for="es_interno" class="form-check-label">Nota Interna</label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mt-2">
                                            <label for="adjuntos" class="form-label" style="font-size: 0.9em;">Adjuntos (jpg, png, pdf)</label>
                                            <input type="file" class="form-control form-control-sm" id="adjuntos" name="adjuntos[]" multiple accept=".jpg,.jpeg,.png,.pdf" style="padding: 2px; font-size: 0.9em;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- jQuery -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script>
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

        document.getElementById('categoria').addEventListener('change', function() {
            var newCategoryField = document.getElementById('newCategoryField');
            if (this.value === 'new') {
                newCategoryField.style.display = 'block';
            } else {
                newCategoryField.style.display = 'none';
            }
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