<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGT - Editor</title>
    <meta name="author" content="Tu Nombre">
    <meta name="description" content="Sistema Gestor de Tickets - Crear Ticket">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
    <script data-cfasync="false" nonce="dd2aba2b-0d4f-4a7b-ba12-b170486f3488">
    try {
        (function(w, d) {
            !function(fv, fw, fx, fy) {
                if (fv.zaraz) {
                    console.error("zaraz is loaded twice");
                    return;
                }
                fv[fx] = fv[fx] || {};
                fv[fx].executed = [];
                fv.zaraz = { deferred: [], listeners: [] };
                fv.zaraz._v = "5858";
                fv.zaraz._n = "dd2aba2b-0d4f-4a7b-ba12-b170486f3488";
                fv.zaraz.q = [];
                fv.zaraz._f = function(fz) {
                    return async function() {
                        var fA = Array.prototype.slice.call(arguments);
                        fv.zaraz.q.push({ m: fz, a: fA });
                    };
                };
                for (const fB of ["track", "set", "debug"]) fv.zaraz[fB] = fv.zaraz._f(fB);
                fv.zaraz.init = () => {
                    var fC = fw.getElementsByTagName(fy)[0],
                        fD = fw.createElement(fy),
                        fE = fw.getElementsByTagName("title")[0];
                    fE && (fv[fx].t = fw.getElementsByTagName("title")[0].text);
                    fv[fx].x = Math.random();
                    fv[fx].w = fv.screen.width;
                    fv[fx].h = fv.screen.height;
                    fv[fx].j = fv.innerHeight;
                    fv[fx].e = fv.innerWidth;
                    fv[fx].l = fv.location.href;
                    fv[fx].r = fw.referrer;
                    fv[fx].k = fv.screen.colorDepth;
                    fv[fx].n = fw.characterSet;
                    fv[fx].o = (new Date).getTimezoneOffset();
                    if (typeof dataLayer !== 'undefined') {
                        for (const fF of Object.entries(Object.entries(dataLayer).reduce(((fG, fH) => ({...fG[1], ...fH[1]})), {}))) {
                            zaraz.set(fF[0], fF[1], { scope: "page" });
                        }
                    }
                    fv[fx].q = [];
                    for (; fv.zaraz.q.length;) {
                        const fI = fv.zaraz.q.shift();
                        fv[fx].q.push(fI);
                    }
                    fD.defer = true;
                    for (const fJ of [localStorage, sessionStorage]) {
                        Object.keys(fJ || {}).filter((fL => fL.startsWith("_zaraz_"))).forEach((fK => {
                            try { fv[fx]["z_" + fK.slice(7)] = JSON.parse(fJ.getItem(fK)); }
                            catch { fv[fx]["z_" + fK.slice(7)] = fJ.getItem(fK); }
                        }));
                    }
                    fD.referrerPolicy = "origin";
                    fD.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(fv[fx])));
                    fC.parentNode.insertBefore(fD, fC);
                };
                ["complete", "interactive"].includes(fw.readyState) ? zaraz.init() : fv.addEventListener("DOMContentLoaded", zaraz.init);
            }(w, d, "zarazData", "script");
            window.zaraz._p = async eC => new Promise((eD => {
                if (eC) {
                    eC.e && eC.e.forEach((eE => {
                        try {
                            const eF = d.querySelector("script[nonce]"),
                                  eG = eF?.nonce || eF?.getAttribute("nonce"),
                                  eH = d.createElement("script");
                            eG && (eH.nonce = eG);
                            eH.innerHTML = eE;
                            eH.onload = () => { d.head.removeChild(eH); };
                            d.head.appendChild(eH);
                        } catch (eI) { console.error(`Error executing script: ${eE}\n`, eI); }
                    }));
                    Promise.allSettled((eC.f || []).map((eJ => fetch(eJ[0], eJ[1])))).then(() => eD());
                } else {
                    eD();
                }
            }));
            zaraz._p({"e":["(function(w,d){})(window,document)"]});
        })(window, document);
    } catch (e) {
        console.error("Zaraz initialization error:", e);
        fetch("/cdn-cgi/zaraz/t");
    }
    </script>
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
                    <img src="<?php echo base_url('assets/dist/assets/img/standex.png'); ?>" alt="SGT Logo" class="brand-image ">
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
                        <?php if ($rol === 'administrador'|| $rol === 'supervisor'): ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('crear_usuario'); ?>" class="nav-link">
                                <i class="nav-icon bi bi-person-fill"></i>
                                <p>Gestionar Usuarios</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item menu-open">
                            <a href="<?php echo base_url('tickets'); ?>" class="nav-link">
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
        <!-- Content Wrapper -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Editor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('tickets'); ?>">Tickets</a></li>
                                <li class="breadcrumb-item active">Editor</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
             <main class="app-content">
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
             </main>
        </div>
        <!-- Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">SGT v1.0</div>
                <strong>Copyright © 2025 <a href="https://techmeetings.net/">TechMeetings</a>.</strong> Todos los derechos reservados.
        </footer>
        <!-- Control Sidebar -->
    </div>
    <!-- Scripts -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.js'); ?>"></script>
    <!-- Page specific script -->
    <script>
     // Configurar OverlayScrollbarsMore actions
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbars !== 'undefined') {
                OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll
                    }
                });
            }
        });
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"94f416d79db9f052","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.6.2","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>
</body>
</html>