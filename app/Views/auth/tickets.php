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
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">
    <!-- Themes -->
     <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
    
</head>
<script data-cfasync="false" nonce="b2c20592-faa7-4a3d-a7f9-aa13d0dec9f1">try{(function(w,d){!function(fv,fw,fx,fy){if(fv.zaraz)console.error("zaraz is loaded twice");else{fv[fx]=fv[fx]||{};fv[fx].executed=[];fv.zaraz={deferred:[],listeners:[]};fv.zaraz._v="5858";fv.zaraz._n="b2c20592-faa7-4a3d-a7f9-aa13d0dec9f1";fv.zaraz.q=[];fv.zaraz._f=function(fz){return async function(){var fA=Array.prototype.slice.call(arguments);fv.zaraz.q.push({m:fz,a:fA})}};for(const fB of["track","set","debug"])fv.zaraz[fB]=fv.zaraz._f(fB);fv.zaraz.init=()=>{var fC=fw.getElementsByTagName(fy)[0],fD=fw.createElement(fy),fE=fw.getElementsByTagName("title")[0];fE&&(fv[fx].t=fw.getElementsByTagName("title")[0].text);fv[fx].x=Math.random();fv[fx].w=fv.screen.width;fv[fx].h=fv.screen.height;fv[fx].j=fv.innerHeight;fv[fx].e=fv.innerWidth;fv[fx].l=fv.location.href;fv[fx].r=fw.referrer;fv[fx].k=fv.screen.colorDepth;fv[fx].n=fw.characterSet;fv[fx].o=(new Date).getTimezoneOffset();if(fv.dataLayer)for(const fF of Object.entries(Object.entries(dataLayer).reduce(((fG,fH)=>({...fG[1],...fH[1]})),{})))zaraz.set(fF[0],fF[1],{scope:"page"});fv[fx].q=[];for(;fv.zaraz.q.length;){const fI=fv.zaraz.q.shift();fv[fx].q.push(fI)}fD.defer=!0;for(const fJ of[localStorage,sessionStorage])Object.keys(fJ||{}).filter((fL=>fL.startsWith("_zaraz_"))).forEach((fK=>{try{fv[fx]["z_"+fK.slice(7)]=JSON.parse(fJ.getItem(fK))}catch{fv[fx]["z_"+fK.slice(7)]=fJ.getItem(fK)}}));fD.referrerPolicy="origin";fD.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(fv[fx])));fC.parentNode.insertBefore(fD,fC)};["complete","interactive"].includes(fw.readyState)?zaraz.init():fv.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async eC=>new Promise((eD=>{if(eC){eC.e&&eC.e.forEach((eE=>{try{const eF=d.querySelector("script[nonce]"),eG=eF?.nonce||eF?.getAttribute("nonce"),eH=d.createElement("script");eG&&(eH.nonce=eG);eH.innerHTML=eE;eH.onload=()=>{d.head.removeChild(eH)};d.head.appendChild(eH)}catch(eI){console.error(`Error executing script: ${eE}\n`,eI)}}));Promise.allSettled((eC.f||[]).map((eJ=>fetch(eJ[0],eJ[1]))))}eD()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>

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
                                <img   src="<?php echo base_url('assets/dist/assets/img/user2-160x160.jpg'); ?>" class="rounded-circle shadow" alt="User Image">
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
                    <span class="brand-text">SGT</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="true">
                        <?php if ($rol === 'administrador' || $rol === 'supervisor'|| $rol === 'agente'): ?><li class="nav-item"><a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i class="nav-icon bi bi-speedometer"></i><p>Dashboard</p></a></li><?php endif; ?>
                        <?php if ($rol === 'administrador' || $rol === 'supervisor'): ?><li class="nav-item"><a href="<?php echo base_url('crear_usuario'); ?>" class="nav-link"><i class="nav-icon bi bi-person-fill"></i><p>Gestionar Usuarios</p></a></li><?php endif; ?>
                        <li class="nav-item menu-open"><a href="<?php echo base_url('tickets'); ?>" class="nav-link active"><i class="nav-icon bi bi-ticket-fill"></i><p>Tickets</p></a></li>
                        <li class="nav-item"><a href="<?php echo base_url('logout'); ?>" class="nav-link"><i class="nav-icon bi bi-box-arrow-right"></i><p>Cerrar Sesión</p></a></li>
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
                                <li class="breadcrumb-item"><a  href="<?php echo base_url('dashboard'); ?>">SGT</a></li>
                                <li class="breadcrumb-item active">Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Filtros de Búsqueda -->
                            <div class="col-md-3">
                                <a href="<?php echo base_url('crear_ticket'); ?>" class="btn btn-primary btn-block mb-2"><i class="bi bi-plus-circle"></i> Crear Ticket</a>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Herramientas</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body p-1">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item"><a href="<?php echo base_url('tickets'); ?>" class="nav-link"><i class="fas fa-inbox"></i> Bandeja <span class="badge bg-primary float-end"><?php echo count($tickets ?? []) + (isset($ticketsSinAsignar) ? count($ticketsSinAsignar) : 0); ?></span></a></li>
                                            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-envelope"></i> Mensajes</a></li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#ticket-filters-content" aria-expanded="false" aria-controls="ticket-filters-content">
                                                    <i  class="fas fa-filter"></i> Filtros
                                                </a>
                                            </li>
                                            <form method="get" action="<?php echo base_url('tickets'); ?>" class="p-2">
                                                <div class="collapse" id="ticket-filters-content">
                                                    <div class="row g-2">
                                                        <div class="col-md-4">
                                                            <label for="estado" class="form-label fw-bold text-dark">Estado</label>
                                                            <select class="form-control " id="estado" name="estado">
                                                                <option value="">Todos</option>
                                                                <option value="abierto" <?php echo isset($_GET['estado']) && $_GET['estado'] === 'abierto' ? 'selected' : ''; ?>>Abierto</option>
                                                                <option value="en_progreso" <?php echo isset($_GET['estado']) && $_GET['estado'] === 'en_progreso' ? 'selected' : ''; ?>>En Progreso</option>
                                                                <option value="esperando_cliente" <?php echo isset($_GET['estado']) && $_GET['estado'] === 'esperando_cliente' ? 'selected' : ''; ?>>Esperando Cliente</option>
                                                                <option value="cerrado" <?php echo isset($_GET['estado']) && $_GET['estado'] === 'cerrado' ? 'selected' : ''; ?>>Cerrado</option>
                                                                <option value="reabierto" <?php echo isset($_GET['estado']) && $_GET['estado'] === 'reabierto' ? 'selected' : ''; ?>>Reabierto</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="id_categoria" class="form-label fw-bold text-dark">Categoría</label>
                                                            <select class="form-control" id="id_categoria" name="id_categoria">
                                                                <option value="">Todas</option>
                                                                <?php foreach ($categorias as $categoria): ?>
                                                                <option value="<?php echo $categoria['id']; ?>" <?php echo isset($_GET['id_categoria']) && $_GET['id_categoria'] === $categoria['id'] ? 'selected' : ''; ?>><?php echo esc($categoria['nombre']); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="prioridad" class="form-label fw-bold text-dark">Prioridad</label>
                                                            <select class="form-control" id="prioridad" name="prioridad">
                                                                <option value="">Todas</option>
                                                                <option value="baja" <?php echo isset($_GET['prioridad']) && $_GET['prioridad'] === 'baja' ? 'selected' : ''; ?>>Baja</option>
                                                                <option value="media" <?php echo isset($_GET['prioridad']) && $_GET['prioridad'] === 'media' ? 'selected' : ''; ?>>Media</option>
                                                                <option value="alta" <?php echo isset($_GET['prioridad']) && $_GET['prioridad'] === 'alta' ? 'selected' : ''; ?>>Alta</option>
                                                            </select>
                                                        </div>
                                                        <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                        <div class="col-md-4">
                                                            <label for="asignado_a" class="form-label fw-bold text-dark">Agente</label>
                                                            <select class="form-control" id="asignado_a" name="asignado_a">
                                                                <option value="">Todos</option>
                                                                <?php
                                                                $usuarioModel = new \App\Models\UsuarioModel();
                                                                $agentes = $usuarioModel->where('rol', 'agente')->findAll();
                                                                foreach ($agentes as $agente): ?>
                                                                    <option value="<?php echo $agente['id']; ?>" <?php echo isset($_GET['asignado_a']) && $_GET['asignado_a'] === $agente['id'] ? 'selected' : ''; ?>><?php echo esc($agente['nombre']); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="col-11 d-flex justify-content-end gap-1 mt-2">
                                                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Filtrar</button>
                                                            <a href="<?php echo base_url('tickets'); ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Limpiar Filtros</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-trash-alt"></i> Basura</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card card-primary card-outline">
                                    <?php if ($rol === 'agente' || $rol === 'supervisor' || $rol === 'administrador'): ?>
                                        <div class="card-header">
                                            <h5 class="card-title"><?php echo $rol === 'agente' ? 'Tickets Asignados' : 'Todos los Tickets'; ?></h5>
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
                                                            <td><span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'danger' : ($ticket['estado'] === 'reabierto' ? 'info' : 'secondary'))); ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></span></td>
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
                                        
                                        <div class="card-header">
                                            <h5 class="card-title">Tickets Sin Asignar</h5>
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
                                                            <th>Creado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($ticketsSinAsignar as $ticket): ?>
                                                            <tr>
                                                                <td><?php echo substr($ticket['id'], 0, 8); ?>...</td>
                                                                <td><?php echo esc($ticket['titulo']); ?></td>
                                                                <td><?php echo esc($ticket['categoria_nombre']); ?></td>
                                                                <td><?php echo ucfirst($ticket['prioridad']); ?></td>
                                                                <td><span class="badge text-bg-<?php echo $ticket['estado'] === 'abierto' ? 'primary' : ($ticket['estado'] === 'en_progreso' ? 'warning' : ($ticket['estado'] === 'cerrado' ? 'success' : ($ticket['estado'] === 'reabierto' ? 'info' : 'secondary'))); ?>"><?php echo ucfirst(str_replace('_', ' ', $ticket['estado'])); ?></span></td>
                                                                <td><?php echo date('d/m/Y', strtotime($ticket['creado_en'])); ?></td>
                                                                <td>
                                                                    <?php if ($rol === 'agente'): ?>
                                                                        <a href="<?php echo base_url('asignar_ticket/' . $ticket['id'] . '?atender=true'); ?>" class="btn btn-sm btn-success">Atender</a>
                                                                    <?php endif; ?>
                                                                    <?php if ($rol === 'supervisor' || $rol === 'administrador'): ?>
                                                                        <form method="post" action="<?php echo base_url('asignar_ticket/' . $ticket['id']); ?>" style="display:inline;">
                                                                            <select name="agente_id" class="form-control form-control-sm d-inline-block" style="width: 150px;" required>
                                                                                <option value="">Seleccionar Agente</option>
                                                                                <?php
                                                                                $usuarioModel = new \App\Models\UsuarioModel();
                                                                                $agentes = $usuarioModel->where('rol', 'agente')->findAll();
                                                                                foreach ($agentes as $agente): ?>
                                                                                    <option value="<?php echo $agente['id']; ?>"><?php echo esc($agente['nombre']); ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <button type="submit" class="btn btn-sm btn-primary">Asignar</button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="card-header">
                                            <h5 class="card-title"><?php echo $rol === 'cliente' ? 'Mis Tickets' : 'Todos los Tickets'; ?></h5>
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
                                                            <th>Agente</th>
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
                                                           
                                                            <td><?php echo $ticket['agente_nombre'] ?: 'Sin asignar'; ?></td>
                                                         
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
                                    <?php endif; ?>
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
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
   >
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, { scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll } });
            }
        });
    </script>
</body>
</html>