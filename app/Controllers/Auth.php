<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\TicketModel;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Controller;
helper('email_helper');

class Auth extends BaseController
{

   /*     public function email()
    {
        // Aquí puedes llamar a las funciones de envío de correo
        // Por ejemplo:
        $platillaSubTtl = "Asunto del Correo";
        $userMail = "zzzaida09@gmail.com"; // Reemplaza con el correo del destinatario
        $contenidoHTML = "<h1>Contenido del Correo</h1><p>Este es un ejemplo de contenido HTML.</p>";
        $response = enviarMail($platillaSubTtl, $userMail, $contenidoHTML);
        if ($response->statusCode() == 202) {
            echo "Correo enviado exitosamente.";
        } else {
            echo "Error al enviar el correo: " . $response->body();
        }
    } */

    public function login()
    {
        if ($this->request->is('post')) {
            $rules = [
                'correo' => 'required|valid_email',
                'contrasena' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $correo = $this->request->getPost('correo');
                $contrasena = $this->request->getPost('contrasena');
                $usuario = $model->where('correo', $correo)->first();

                if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                    session()->set([
                        'user_id' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'rol' => $usuario['rol'],
                        'isLoggedIn' => true
                    ]);
                    // Redirigir según rol
                    if ($usuario['rol'] === 'cliente') {
                        return redirect()->to('tickets');
                    } else {
                        return redirect()->to('dashboard');
                    }
                } else {
                    session()->setFlashdata('error', 'Correo o contraseña incorrectos.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        return view('auth/login');
    }

    public function registrar()
    {
        if ($this->request->is('post')) {
            $rules = [
                'nombre' => 'required|min_length[3]',
                'correo' => 'required|valid_email|is_unique[usuarios.correo]',
                'contrasena' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = [
                    'id' => Uuid::uuid4()->toString(), // Generar UUID para el id
                    'nombre' => $this->request->getPost('nombre'),
                    'correo' => $this->request->getPost('correo'),
                    'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT),
                    'rol' => 'cliente'
                ];

                if ($model->insert($data)) {
                    return redirect()->to('/register')->with('success', 'Usuario registrado correctamente.');
                } else {
                    session()->setFlashdata('error', 'Error al registrar el usuario.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        return view('auth/register');
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $rules = [
                'nombre' => 'required|min_length[3]',
                'correo' => 'required|valid_email|is_unique[usuarios.correo]',
                'contrasena' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = [
                    'id' => Uuid::uuid4()->toString(), // Generar UUID para el id
                    'nombre' => $this->request->getPost('nombre'),
                    'correo' => $this->request->getPost('correo'),
                    'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT),
                    'rol' => 'cliente'
                ];

                if ($model->insert($data)) {
                    return redirect()->to('/register')->with('success', 'Usuario registrado correctamente.');
                } else {
                    session()->setFlashdata('error', 'Error al registrar el usuario.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        return view('auth/register');
    }

    public function crear_usuario()
    {
        if (!session()->get('isLoggedIn') || !in_array(session()->get('rol'), ['supervisor', 'administrador'])) {
            return redirect()->to('dashboard')->with('error', 'Acceso denegado.');
        }
        $usuarioModel = new UsuarioModel();
        $data = ['nombre' => session()->get('nombre'), 'rol' => session()->get('rol'), 'usuarios' => $usuarioModel->findAll()];
        if ($this->request->is('post')) {
            $rules = [
                'nombre' => 'required|min_length[3]',
                'correo' => 'required|valid_email|is_unique[usuarios.correo]',
                'contrasena' => 'required|min_length[8]',
                'rol' => 'required|in_list[cliente,agente,supervisor,administrador]'
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = [
                    'id' => Uuid::uuid4()->toString(), // Generar UUID para el id
                    'nombre' => $this->request->getPost('nombre'),
                    'correo' => $this->request->getPost('correo'),
                    'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT),
                    'rol' => $this->request->getPost('rol'),
                    'creado_en' => date('Y-m-d H:i:s')
                ];

                if ($model->insert($data)) {
                    session()->setFlashdata('success', 'Usuario creado correctamente.');
                    return redirect()->to('crear_usuario');
                } else {
                    session()->setFlashdata('error', 'Error al crear el usuario.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }
        return view('auth/crear_usuario', $data);
    }

    public function editar_usuario($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('rol') !== 'administrador') {
            return redirect()->to('dashboard')->with('error', 'Acceso denegado.');
        }
        $model = new UsuarioModel();
        $usuario = $model->find($id); // Ahora funciona con CHAR(36) si el modelo está ajustado
        if (!$usuario) {
            return redirect()->to('crear_usuario')->with('error', 'Usuario no encontrado.');
        }
        if ($this->request->is('post')) {
            $rules = [
                'nombre' => 'required|min_length[3]',
                'correo' => 'required|valid_email|is_unique[usuarios.correo,id,' . $id . ']',
                'contrasena' => 'permit_empty|min_length[8]',
                'rol' => 'required|in_list[cliente,agente,supervisor,administrador]'
            ];
            if ($this->validate($rules)) {
                $data = [
                    'nombre' => $this->request->getPost('nombre'),
                    'correo' => $this->request->getPost('correo'),
                    'rol' => $this->request->getPost('rol')
                ];
                if ($this->request->getPost('contrasena')) {
                    $data['contrasena'] = password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT);
                }
                if ($model->update($id, $data)) {
                    session()->setFlashdata('success', 'Usuario actualizado correctamente.');
                    return redirect()->to('crear_usuario');
                } else {
                    session()->setFlashdata('error', 'Error al actualizar el usuario.');
                }
            } else {
                $data = [
                    'usuario' => $usuario,
                    'errors' => $this->validator->getErrors()
                ];
                return view('auth/crear_usuario', $data);
            }
        }
        $data = ['usuario' => $usuario];
        return view('auth/crear_usuario', $data);
    }

    public function eliminar_usuario($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('rol') !== 'administrador') {
            return redirect()->to('crear_usuario')->with('error', 'Acceso denegado.');
        }
        $model = new UsuarioModel();
        $usuario = $model->find($id);
        if (!$usuario) {
            return redirect()->to('crear_usuario')->with('error', 'Usuario no encontrado.');
        }
        if ($this->request->is('post')) {
            if ($model->delete($id)) {
                session()->setFlashdata('success', 'Usuario eliminado correctamente.');
            } else {
                session()->setFlashdata('error', 'Error al eliminar el usuario.');
            }
            return redirect()->to('crear_usuario');
        }
        return redirect()->to('crear_usuario');
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $rol = session()->get('rol');
        if ($rol === 'cliente') {
            return redirect()->to('tickets')->with('error', 'Acceso denegado. Los clientes no pueden ver el dashboard.');
        }
        $ticketModel = new TicketModel();

        $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'tickets' => [], 'categorias' => $ticketModel->getCategorias(), 'ticketsSinAsignar' => []];

        $ticketModel = new TicketModel();
        $data['totalTickets'] = $ticketModel->countAll();
        $data['ticketsAbiertos'] = $ticketModel->where('estado', 'abierto')->countAllResults();
        $data['ticketsEnProgreso'] = $ticketModel->where('estado', 'en_progreso')->countAllResults();
        $data['ticketsCerrados'] = $ticketModel->where('estado', 'cerrado')->countAllResults();
        $data['ticketsReabiertos'] = $ticketModel->where('estado', 'reabierto')->countAllResults();
        $data['ticketsSinAsignar'] = $ticketModel->where('asignado_a', null)->countAllResults();
        $data['ticketsAsignados'] = $ticketModel->where('asignado_a', session()->get('user_id'))->countAllResults();
        
        $data['tickets'] = $ticketModel->getAllTickets();
        $user_id = session()->get('user_id');
        $db = \Config\Database::connect();
        $db->table('registros_auditoria')->insert([
            'id_usuario' => $user_id,
            'accion' => 'ver_dashboard',
            'modelo' => 'dashboard',
            'id_registro' => 'N/A',
            'detalles' => json_encode(['rol' => $data['rol']]),
            'direccion_ip' => $this->request->getIPAddress()
        ]);
     
        // Obtener las categorías y sus estadísticas
        $categorias = $ticketModel->getCategorias();
        $data['categorias'] = [];
        foreach ($categorias as $categoria) {
            $data['categorias'][$categoria['id']] = [
                'nombre' => $categoria['nombre'],
                'tickets' => $ticketModel->where('id_categoria', $categoria['id'])->countAllResults(),
                'totalTickets' => $ticketModel->where('id_categoria', $categoria['id'])->countAllResults(),
                'ticketsAbiertos' => $ticketModel->where('id_categoria', $categoria['id'])->where('estado', 'abierto')->countAllResults(),
                'ticketsEnProgreso' => $ticketModel->where('id_categoria', $categoria['id'])->where('estado', 'en_progreso')->countAllResults(),
                'ticketsCerrados' => $ticketModel->where('id_categoria', $categoria['id'])->where('estado', 'cerrado')->countAllResults(),
                'ticketsReabiertos' => $ticketModel->where('id_categoria', $categoria['id'])->where('estado', 'reabierto')->countAllResults(),
            ];
        }

        return view('auth/dashboard', $data);
    }

    public function tickets()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        $ticketModel = new TicketModel();
        $rol = session()->get('rol');
        $user_id = session()->get('user_id'); // Ahora es CHAR(36)
        $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'tickets' => [], 'categorias' => $ticketModel->getCategorias(), 'ticketsSinAsignar' => []];

        $estado = $this->request->getGet('estado');
        $id_categoria = $this->request->getGet('id_categoria');
        $asignado_a = $this->request->getGet('asignado_a');
        $prioridad = $this->request->getGet('prioridad');
        $buscar = $this->request->getGet('buscar');

        $filteredModel = clone $ticketModel;
        if ($estado) {
            $filteredModel->where('estado', $estado);
        }
        if ($id_categoria) {
            $filteredModel->where('id_categoria', $id_categoria);
        }
        if ($prioridad) {
            $filteredModel->where('prioridad', $prioridad);
        }
        if ($asignado_a) {
            $filteredModel->where('asignado_a', $asignado_a);
        }
        if ($buscar) {
            $filteredModel->groupStart()
                          ->like('titulo', $buscar)
                          ->orLike('id', $buscar)
                          ->groupEnd();
        }

        if ($rol === 'cliente') {
            $data['tickets'] = $filteredModel->getTicketsByUsuario($user_id);
        } elseif ($rol === 'agente') {
            $data['tickets'] = $filteredModel->getTicketsByAgente($user_id);
            $data['ticketsSinAsignar'] = $ticketModel->getTicketsSinAsignar();
        } elseif ($rol === 'supervisor' || $rol === 'administrador') {
            $data['tickets'] = $filteredModel->getAllTickets();
            $data['ticketsSinAsignar'] = $ticketModel->getTicketsSinAsignar();
        }

        $db = \Config\Database::connect();
        $db->table('registros_auditoria')->insert([
            'id_usuario' => $user_id,
            'accion' => 'listar_tickets',
            'modelo' => 'tickets',
            'id_registro' => 'N/A',
            'detalles' => json_encode(['rol' => $rol]),
            'direccion_ip' => $this->request->getIPAddress()
        ]);
        return view('auth/tickets', $data);
    }

    public function crear_ticket()
    {
        if (!session()->get('isLoggedIn') || !in_array(session()->get('rol'), ['cliente', 'agente', 'administrador'])) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }
        $ticketModel = new TicketModel();
        $data = ['nombre' => session()->get('nombre'), 'rol' => session()->get('rol'), 'categorias' => $ticketModel->getCategorias()];
        if ($this->request->is('post')) {
            $rules = ['titulo' => 'required|min_length[3]', 'descripcion' => 'required', 'prioridad' => 'required|in_list[baja,media,alta]', 'categoria_nombre' => 'required|min_length[3]', 'adjuntos.*' => 'permit_empty|max_size[adjuntos.*,6144]|ext_in[adjuntos.*,jpg,jpeg,png,pdf]'];
            if ($this->validate($rules)) {
                $ticketModel = new TicketModel();
                $user_id = session()->get('user_id'); // Ahora es CHAR(36)
                $categoria_nombre = $this->request->getPost('categoria_nombre');
                $id_categoria = $ticketModel->getOrCreateCategoria($categoria_nombre);
                $ticket_id = Uuid::uuid4()->toString();
                $ticketData = ['id' => $ticket_id, 'id_usuario' => $user_id, 'titulo' => $this->request->getPost('titulo'), 'descripcion' => $this->request->getPost('descripcion'), 'prioridad' => $this->request->getPost('prioridad'), 'id_categoria' => $id_categoria, 'estado' => 'abierto'];
                $adjuntosData = [];

              $uploadDir = FCPATH . 'uploads/tickets/'; // Asegúrate de que esto apunte a la raíz correcta
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $files = $this->request->getFiles();
                if ($files && isset($files['adjuntos']) && !empty($files['adjuntos'])) {
                    foreach ($files['adjuntos'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            if ($file->move($uploadDir, $newName)) {
                                $adjuntosData[] = [
                                    'id_ticket' => $ticket_id,
                                    'ruta_archivo' => 'uploads/tickets/' . $newName,
                                    'nombre_archivo' => $file->getClientName(),
                                    'tipo_archivo' => $file->getClientMimeType(),
                                    'id_comentario_ticket' => null // O el ID del comentario si aplica
                                ];
                            }
                        }
                    }
                }

                try {
                    $db = \Config\Database::connect();
                    if (!$db->connID) {
                        die('Fallo al conectar a la base de datos. Verifica app/Config/Database.php');
                    }
                    $db->transStart();
                    $result = $ticketModel->insert($ticketData);
                    if ($result !== false) {
                        if (!empty($adjuntosData)) {
                            foreach ($adjuntosData as $adjunto) {
                                $ticketModel->addAdjunto($adjunto);
                            }
                        }
                        $db->table('registros_auditoria')->insert(['id_usuario' => $user_id, 'accion' => 'crear_ticket', 'modelo' => 'tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode($ticketData), 'direccion_ip' => $this->request->getIPAddress()]);
                        $db->transComplete();
                        if ($db->transStatus() === false) {
                            die('Transacción fallida. Error: ' . json_encode($db->error()));
                        }
                        session()->setFlashdata('success', 'Ticket creado correctamente.');
                        return redirect()->to('tickets');
                    } else {
                        $db->transRollback();
                        die('Fallo al insertar ticket. Consulta: ' . $db->getLastQuery()->getQuery() . '. Error: ' . json_encode($db->error()));
                    }
                } catch (\Exception $e) {
                    $db->transRollback();
                    die('Excepción: ' . $e->getMessage() . '. Consulta: ' . $db->getLastQuery()->getQuery() . '. Error DB: ' . json_encode($db->error()));
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }
        return view('auth/crear_ticket', $data);
    }

    public function ver_ticket($ticket_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        $ticketModel = new TicketModel();
        $ticket = $ticketModel->getTicketWithComentarios($ticket_id);
        $rol = session()->get('rol');
        $usuario_id = session()->get('user_id');
        $asignado_a = $ticket['asignado_a'];

        if (!$ticket || ($rol === 'cliente' && $ticket['id_usuario'] != $usuario_id) || ($rol === 'agente' && $asignado_a != $usuario_id && $asignado_a !== null)) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }

        if ($this->request->is('post')) {
            $rules = ['comentario' => 'required', 'es_interno' => 'permit_empty|in_list[0,1]', 'adjuntos.*' => 'permit_empty|max_size[adjuntos.*,6144]|ext_in[adjuntos.*,jpg,jpeg,png,pdf]'];
            if ($this->validate($rules)) {
                $es_interno = $this->request->getPost('es_interno') && in_array($rol, ['agente', 'supervisor', 'administrador']) ? 1 : 0;
                $comentarioData = ['id_ticket' => $ticket_id, 'id_usuario' => $usuario_id, 'comentario' => $this->request->getPost('comentario'), 'es_interno' => $es_interno, 'id' => Uuid::uuid4()->toString(), 'creado_en' => date('Y-m-d H:i:s')];
                $db = \Config\Database::connect();
                $db->transStart();
                $userExists = $db->table('usuarios')->where('id', $usuario_id)->countAllResults() > 0;
                $ticketExists = $db->table('tickets')->where('id', $ticket_id)->countAllResults() > 0;
                if (!$userExists || !$ticketExists) {
                    $db->transRollback();
                    die('Error: Usuario o ticket no encontrado.');
                }
                if ($db->table('comentarios_tickets')->insert($comentarioData)) {
                    $comment_id = $comentarioData['id'];
                    $files = $this->request->getFiles();
                    $uploadDir = FCPATH . 'uploads/tickets/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    if ($files && isset($files['adjuntos']) && !empty($files['adjuntos'])) {
                        foreach ($files['adjuntos'] as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $newName = $file->getRandomName();
                                if ($file->move($uploadDir, $newName)) {
                                    $adjuntoData = [
                                        'id_ticket' => $ticket_id,
                                        'ruta_archivo' => 'uploads/tickets/' . $newName,
                                        'nombre_archivo' => $file->getClientName(),
                                        'tipo_archivo' => $file->getClientMimeType(),
                                        'id_comentario_ticket' => $comment_id
                                    ];
                                    $ticketModel->addAdjunto($adjuntoData);
                                }
                            }
                        }
                    }
                    $db->table('registros_auditoria')->insert(['id_usuario' => $usuario_id, 'accion' => 'añadir_comentario', 'modelo' => 'comentarios_tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode($comentarioData), 'direccion_ip' => $this->request->getIPAddress()]);
                    $db->transComplete();
                    if ($db->transStatus() === false) {
                        die('Transacción fallida.');
                    } else {
                        session()->setFlashdata('success', 'Comentario agregado.');
                    }
                } else {
                    $db->transRollback();
                    die('Fallo al agregar comentario.');
                }
                return redirect()->to("ver_ticket/$ticket_id");
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        $db = \Config\Database::connect();
        $db->table('registros_auditoria')->insert(['id_usuario' => $usuario_id, 'accion' => 'ver_ticket', 'modelo' => 'tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode(['rol' => $rol]), 'direccion_ip' => $this->request->getIPAddress()]);
        $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'ticket' => $ticket];
        return view('auth/ver_ticket', $data);
    }

    public function editar_ticket($ticket_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        $ticketModel = new TicketModel();
        $ticket = $ticketModel->find($ticket_id);
        $rol = session()->get('rol');
        $usuario_id = session()->get('user_id');
        $asignado_a = $ticket['asignado_a'];

        if (!$ticket || !in_array($rol, ['administrador', 'supervisor']) && $ticket['id_usuario'] != $usuario_id && ($rol === 'agente' && $asignado_a != $usuario_id)) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'titulo' => 'required|min_length[3]',
                'descripcion' => 'required',
                'prioridad' => 'required|in_list[baja,media,alta]',
                'categoria' => 'required|permit_empty',
                'new_categoria' => 'permit_empty|min_length[3]'
            ];
            if ($this->validate($rules)) {
                $data = [
                    'titulo' => $this->request->getPost('titulo'),
                    'descripcion' => $this->request->getPost('descripcion'),
                    'prioridad' => $this->request->getPost('prioridad')
                ];
                $categoria = $this->request->getPost('categoria');
                if ($categoria === 'new' && $this->request->getPost('new_categoria')) {
                    $data['id_categoria'] = $ticketModel->getOrCreateCategoria($this->request->getPost('new_categoria'));
                } elseif ($categoria && $categoria !== 'new') {
                    $data['id_categoria'] = $categoria;
                } else {
                    $data['id_categoria'] = $ticket['id_categoria'];
                }

                if ($ticketModel->update($ticket_id, $data)) {
                    session()->setFlashdata('success', 'Ticket actualizado correctamente.');
                } else {
                    session()->setFlashdata('error', 'Error al actualizar el ticket.');
                }
                return redirect()->to('ver_ticket/' . $ticket_id);
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
                $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'ticket' => $ticket];
                return view('auth/ver_ticket', $data);
            }
        }
        return redirect()->to('ver_ticket/' . $ticket_id);
    }

    public function eliminar_ticket($ticket_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        $ticketModel = new TicketModel();
        $ticket = $ticketModel->find($ticket_id);
        $rol = session()->get('rol');
        $usuario_id = session()->get('user_id');
        if (!$ticket || ($rol !== 'administrador' && $ticket['id_usuario'] != $usuario_id)) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }

        if ($ticketModel->delete($ticket_id)) {
            session()->setFlashdata('success', 'Ticket eliminado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al eliminar el ticket.');
        }
        return redirect()->to('tickets');
    }
    
   public function asignar_ticket($ticket_id)
    {
        log_message('info', 'Entró a asignar_ticket con ticket_id: ' . $ticket_id);
        if (!session()->get('isLoggedIn')) {
            log_message('error', 'Usuario no autenticado');
            return redirect()->to('login');
        }

        $ticketModel = new TicketModel();
        $rol = session()->get('rol');
        $user_id = session()->get('user_id');
        $atender = $this->request->getGet('atender');
        log_message('info', "Rol: $rol, User ID: $user_id, Método: " . $this->request->getMethod() . ", Atender: " . var_export($atender, true));
        log_message('info', 'Parámetros GET: ' . json_encode($this->request->getGet()));
        log_message('info', 'Parámetros POST: ' . json_encode($this->request->getPost()));
        log_message('info', 'Sesión completa: ' . json_encode(session()->get()));

        if ($this->request->getMethod() === 'GET' && strtolower($rol) === 'agente' && strtolower($atender) === 'true') {
            log_message('info', "Atendiendo ticket $ticket_id por $user_id");
            $result = $ticketModel->asignarTicket($ticket_id, 'atender');
            log_message('info', 'Resultado de asignarTicket: ' . ($result ? 'éxito' : 'fallo'));
            if ($result) {
                $db = \Config\Database::connect();
                $db->table('registros_auditoria')->insert([
                    'id_usuario' => $user_id,
                    'accion' => 'atender_ticket',
                    'modelo' => 'tickets',
                    'id_registro' => $ticket_id,
                    'detalles' => json_encode(['agente_id' => $user_id]),
                    'direccion_ip' => $this->request->getIPAddress()
                ]);
                return redirect()->to('/tickets')->with('success', 'Ticket atendido exitosamente.');
            } else {
                log_message('error', 'Fallo al actualizar el ticket');
                return redirect()->to('/tickets')->with('error', 'Fallo al atender el ticket.');
            }
        } elseif ($this->request->getMethod() === 'POST' && ($rol === 'supervisor' || $rol === 'administrador')) {
            $agente_id = $this->request->getPost('agente_id');
            log_message('info', "Agente ID recibido: " . var_export($agente_id, true));
            if ($agente_id && $agente_id !== '') {
                log_message('info', "Asignando ticket $ticket_id a $agente_id");
                $result = $ticketModel->asignarTicket($ticket_id, $agente_id);
                if ($result) {
                    $db = \Config\Database::connect();
                    $db->table('registros_auditoria')->insert([
                        'id_usuario' => $user_id,
                        'accion' => 'asignar_ticket',
                        'modelo' => 'tickets',
                        'id_registro' => $ticket_id,
                        'detalles' => json_encode(['agente_id' => $agente_id]),
                        'direccion_ip' => $this->request->getIPAddress()
                    ]);
                    return redirect()->to('/tickets')->with('success', 'Ticket asignado exitosamente.');
                } else {
                    log_message('error', 'Fallo al asignar el ticket');
                    return redirect()->to('/tickets')->with('error', 'Fallo al asignar el ticket.');
                }
            } else {
                log_message('error', 'No se recibió un agente_id válido');
                return redirect()->to('/tickets')->with('error', 'Seleccione un agente válido.');
            }
        } else {
            log_message('error', 'Acceso no autorizado o método inválido: Método: ' . $this->request->getMethod() . ', Rol: ' . $rol . ', Atender: ' . var_export($atender, true));
            return redirect()->to('/tickets')->with('error', 'Acción no permitida. Verifica tu rol o parámetros.');
        }
    }

    public function cambiar_estado($ticket_id)
    {
        log_message('info', 'Entró a cambiar_estado con ticket_id: ' . $ticket_id);
        if (!session()->get('isLoggedIn')) {
            log_message('error', 'Usuario no autenticado');
            return redirect()->to('login');
        }

        $ticketModel = new TicketModel();
        $rol = session()->get('rol');
        $user_id = session()->get('user_id');
        $nuevo_estado = $this->request->getPost('nuevo_estado');
        $ticket = $ticketModel->find($ticket_id);
        $asignado_a = $ticket['asignado_a'];

        if (!$ticket) {
            log_message('error', 'Ticket no encontrado: ' . $ticket_id);
            return redirect()->to('tickets')->with('error', 'Ticket no encontrado.');
        }

        // Verificar permisos
        if ($rol === 'agente' && $asignado_a != $user_id) {
            log_message('error', 'Acceso denegado para agente: ' . $user_id);
            return redirect()->to('ver_ticket/' . $ticket_id)->with('error', 'Acceso denegado. Solo puedes cambiar el estado de tickets asignados a ti.');
        }

        // Validar transición de estado
        $estados_permitidos = [];
        if ($ticket['estado'] === 'en_progreso') {
            $estados_permitidos = ['cerrado', 'esperando_cliente'];
        } elseif ($ticket['estado'] === 'cerrado' && in_array($rol, ['supervisor', 'administrador'])) {
            $estados_permitidos = ['reabierto'];
        } elseif ($ticket['estado'] === 'reabierto') {
            $estados_permitidos = ['cerrado'];
        } elseif ($ticket['estado'] === 'esperando_cliente') {
            $estados_permitidos = ['en_progreso', 'cerrado'];
        }

        if (!in_array($nuevo_estado, $estados_permitidos)) {
            log_message('error', 'Transición de estado no permitida: ' . $ticket['estado'] . ' a ' . $nuevo_estado);
            return redirect()->to('ver_ticket/' . $ticket_id)->with('error', 'Transición de estado no permitida.');
        }

        // Actualizar estado
        $data = ['estado' => $nuevo_estado];
        if ($ticketModel->update($ticket_id, $data)) {
            $db = \Config\Database::connect();
            $db->table('registros_auditoria')->insert([
                'id_usuario' => $user_id,
                'accion' => 'cambiar_estado',
                'modelo' => 'tickets',
                'id_registro' => $ticket_id,
                'detalles' => json_encode(['estado_anterior' => $ticket['estado'], 'nuevo_estado' => $nuevo_estado]),
                'direccion_ip' => $this->request->getIPAddress()
            ]);
            log_message('info', 'Estado cambiado exitosamente de ' . $ticket['estado'] . ' a ' . $nuevo_estado);
            return redirect()->to('ver_ticket/' . $ticket_id)->with('success', 'Estado cambiado exitosamente a ' . ucfirst(str_replace('_', ' ', $nuevo_estado)) . '.');
        } else {
            log_message('error', 'Fallo al actualizar el estado');
            return redirect()->to('ver_ticket/' . $ticket_id)->with('error', 'Fallo al cambiar el estado.');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}