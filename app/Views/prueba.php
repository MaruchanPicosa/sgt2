<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGT - Tickets</title>
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Tickets">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css?v=3.2.0'); ?>">
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
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php if ($rol === 'administrador'): ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('registroA'); ?>" class="nav-link">
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
                    <!-- Botón Compose -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="<?php echo base_url('crear_ticket'); ?>" class="btn btn-primary">Compose</a>
                        </div>
                    </div>
                    <!-- Lista de Tickets (Bandeja de Entrada) -->
                    <div class="row">
                        <div class="col-md-3">
                            <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary btn-block mb-3">Back to Inbox</a>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Folders</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('tickets'); ?>" class="nav-link active">
                                                <i class="fas fa-inbox"></i> Inbox
                                                <span class="badge bg-primary float-right"><?php echo count($tickets); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-paper-plane"></i> Sent
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-draft"></i> Drafts
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-ban"></i> Junk
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-trash"></i> Trash
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Labels</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle text-danger"></i> Important
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle text-warning"></i> Promotions
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle text-primary"></i> Social
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Inbox</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" placeholder="Search Mail">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="mailbox-controls">
                                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                                        </div>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                                        <div class="float-right">1-<?php echo count($tickets); ?> of <?php echo count($tickets); ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php
                                                function time_ago($time) {
                                                    $now = new DateTime();
                                                    $past = new DateTime($time);
                                                    $diff = $now->getTimestamp() - $past->getTimestamp();
                                                    if ($diff < 3600) return floor($diff / 60) . ' mins ago';
                                                    if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
                                                    if ($diff < 172800) return 'Yesterday';
                                                    return floor($diff / 86400) . ' days ago';
                                                }
                                                ?>
                                                <?php foreach ($tickets as $ticket): ?>
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" value="" id="check<?php echo $ticket['id']; ?>">
                                                            <label for="check<?php echo $ticket['id']; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td class="mailbox-star"><a href="#"><i class="fas fa-star <?php echo $ticket['prioridad'] === 'alta' ? 'text-warning' : 'text-secondary'; ?>"></i></a></td>
                                                    <td class="mailbox-name"><a href="<?php echo base_url('ver_ticket/' . $ticket['id']); ?>"><?php echo esc($ticket['id_usuario']); ?></a></td>
                                                    <td class="mailbox-subject"><b><?php echo esc($ticket['titulo']); ?></b></td>
                                                    <td class="mailbox-attachment"><?php echo !empty($ticket['adjuntos']) ? '<i class="fas fa-paperclip"></i>' : ''; ?></td>
                                                    <td class="mailbox-date"><?php echo time_ago($ticket['creado_en']); ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <div class="mailbox-controls">
                                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                                        </div>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                                        <div class="float-right">1-<?php echo count($tickets); ?> of <?php echo count($tickets); ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
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
            <strong>Copyright © 2025 <a href="#">Tu Empresa</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js?v=3.2.0'); ?>"></script>
</body>
</html>