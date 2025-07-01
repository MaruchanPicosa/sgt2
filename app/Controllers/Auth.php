<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\TicketModel;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Controller;

class Auth extends BaseController
{
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
                    return redirect()->to('dashboard');
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
                'contrasena' => 'required|min_length[8]',
                
        
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = [
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
                'contrasena' => 'required|min_length[8]',
                
                
            ];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = [
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
        if (!session()->get('isLoggedIn') ||!in_array(session()->get('rol'), ['supervisor', 'administrador'])) {
            return redirect()->to('dashboard')->with('error', 'Acceso denegado.');
        }
        $usuarioModel = new UsuarioModel();
        $data = ['nombre' => session()->get('nombre'), 'rol' => session()->get('rol'), 'usuarios' => $usuarioModel->findAll()];
        if ($this->request->is('post')) {
            $rules = ['nombre' => 'required|min_length[3]', 'correo' => 'required|valid_email|is_unique[usuarios.correo]', 
            'contrasena' => 'required|min_length[8]', 'rol' => 'required|in_list[cliente,agente,supervisor,administrador]'];

            if ($this->validate($rules)) {
                $model = new UsuarioModel();
                $data = ['nombre' => $this->request->getPost('nombre'), 'correo' => $this->request->getPost('correo'), 
                'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT), 'rol' => $this->request->getPost('rol'), 
                'creado_en' => date('Y-m-d H:i:s')];

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
        $usuario = $model->find($id);
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
                // Devolver errores al modal
                $data = [
                    'usuario' => $usuario,
                    'errors' => $this->validator->getErrors()
                ];
                return view('auth/crear_usuario', $data); // Re-renderizar la vista con errores
            }
        }
        // Si no es POST, cargar la vista con los datos del usuario
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
        // Si no es POST, no hacer nada (modal manejará la cancelación)
        return redirect()->to('crear_usuario');
    }
    
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $data = [
            'nombre' => session()->get('nombre'),
            'rol' => session()->get('rol'),  
        ];

        return view('auth/dashboard', $data);
    }


   public function tickets()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        $ticketModel = new TicketModel();
        $rol = session()->get('rol');
        $user_id = session()->get('user_id');
        $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'tickets' => [], 'categorias' => $ticketModel->getCategorias(), 'ticketsSinAsignar' => []];

        $estado = $this->request->getGet('estado');
        $id_categoria = $this->request->getGet('id_categoria');
        $asignado_a = $this->request->getGet('asignado_a');
        $prioridad = $this->request->getGet('prioridad');
        $buscar = $this->request->getGet('buscar');

        // Aplicar filtros al modelo base
        $filteredModel = clone $ticketModel; // Clonar el modelo para no modificar el original
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
            $data['ticketsSinAsignar'] = $ticketModel->getTicketsSinAsignar(); // Sin filtros para sin asignar
        } elseif ($rol === 'supervisor' || $rol === 'administrador') {
            $data['tickets'] = $filteredModel->getAllTickets();
            $data['ticketsSinAsignar'] = $ticketModel->getTicketsSinAsignar(); // Sin filtros para sin asignar
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
                $user_id = session()->get('user_id');
                $categoria_nombre = $this->request->getPost('categoria_nombre');
                $id_categoria = $ticketModel->getOrCreateCategoria($categoria_nombre);
                $ticket_id = Uuid::uuid4()->toString();
                $ticketData = ['id' => $ticket_id, 'id_usuario' => $user_id, 'titulo' => $this->request->getPost('titulo'), 'descripcion' => $this->request->getPost('descripcion'), 'prioridad' => $this->request->getPost('prioridad'), 'id_categoria' => $id_categoria, 'estado' => 'abierto'];
                try {
                    if ($ticketModel->insert($ticketData)) {
                        $files = $this->request->getFiles();
                        if ($files && isset($files['adjuntos']) && !empty($files['adjuntos'])) {
                            foreach ($files['adjuntos'] as $file) {
                                if ($file->isValid() && !$file->hasMoved()) {
                                    $newName = $file->getRandomName();
                                    $file->move(ROOTPATH . 'public/uploads/tickets', $newName);
                                    $adjuntoData = ['id_ticket' => $ticket_id, 'ruta_archivo' => 'uploads/tickets/' . $newName, 'nombre_archivo' => $file->getClientName(), 'tipo_archivo' => $file->getClientMimeType()];
                                    $ticketModel->addAdjunto($adjuntoData);
                                }
                            }
                        }
                        $db = \Config\Database::connect();
                        $db->table('registros_auditoria')->insert(['id_usuario' => $user_id, 'accion' => 'crear_ticket', 'modelo' => 'tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode($ticketData), 'direccion_ip' => $this->request->getIPAddress()]);
                        session()->setFlashdata('success', 'Ticket creado correctamente.');
                        return redirect()->to('tickets');
                    } else {
                        $errors = $ticketModel->errors();
                        log_message('error', 'Error al insertar ticket: ' . json_encode($errors));
                        session()->setFlashdata('error', 'Error al crear el ticket: ' . json_encode($errors));
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Excepción al crear ticket: ' . $e->getMessage());
                    session()->setFlashdata('error', 'Error al crear el ticket: ' . $e->getMessage());
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
        $user_id = session()->get('user_id');
        if (!$ticket || ($rol === 'cliente' && $ticket['id_usuario'] != $user_id) || ($rol === 'agente' && $ticket['asignado_a'] != $user_id)) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }
        if ($this->request->is('post')) {
            $rules = ['comentario' => 'required', 'es_interno' => 'permit_empty|in_list[0,1]'];
            if ($this->validate($rules)) {
                $es_interno = $this->request->getPost('es_interno') && in_array($rol, ['agente', 'supervisor', 'administrador']) ? 1 : 0;
                $comentarioData = ['id_ticket' => $ticket_id, 'id_usuario' => $user_id, 'comentario' => $this->request->getPost('comentario'), 'es_interno' => $es_interno];
                if ($ticketModel->addComentario($comentarioData)) {
                    $db = \Config\Database::connect();
                    $db->table('registros_auditoria')->insert(['id_usuario' => $user_id, 'accion' => 'añadir_comentario', 'modelo' => 'comentarios_tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode($comentarioData), 'direccion_ip' => $this->request->getIPAddress()]);
                    session()->setFlashdata('success', 'Comentario agregado correctamente.');
                } else {
                    session()->setFlashdata('error', 'Error al agregar el comentario.');
                }
                return redirect()->to("ver_ticket/$ticket_id");
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }
        $db = \Config\Database::connect();
        $db->table('registros_auditoria')->insert(['id_usuario' => $user_id, 'accion' => 'ver_ticket', 'modelo' => 'tickets', 'id_registro' => $ticket_id, 'detalles' => json_encode(['rol' => $rol]), 'direccion_ip' => $this->request->getIPAddress()]);
        $data = ['nombre' => session()->get('nombre'), 'rol' => $rol, 'ticket' => $ticket];
        return view('auth/ver_ticket', $data);
    }

    public function asignar_ticket($ticket_id)
    {
        if (!session()->get('isLoggedIn') || !in_array(session()->get('rol'), ['agente', 'supervisor', 'administrador'])) {
            return redirect()->to('tickets')->with('error', 'Acceso denegado.');
        }

        $ticketModel = new TicketModel();
        $ticket = $ticketModel->find($ticket_id);

        if (!$ticket) {
            return redirect()->to('tickets')->with('error', 'Ticket no encontrado.');
        }

        if ($this->request->getMethod() === 'post' && $this->request->getPost('agente_id')) {
            $agente_id = $this->request->getPost('agente_id');
            $data = ['asignado_a' => $agente_id];
            if ($ticketModel->update($ticket_id, $data)) {
                session()->setFlashdata('success', 'Ticket asignado correctamente.');
            } else {
                session()->setFlashdata('error', 'Error al asignar el ticket.');
            }
            return redirect()->to('tickets');
        } elseif ($this->request->getMethod() === 'get' && $this->request->getGet('atender')) {
            $user_id = session()->get('user_id');
            $data = ['asignado_a' => $user_id];
            if ($ticketModel->update($ticket_id, $data)) {
                session()->setFlashdata('success', 'Ticket atendido correctamente.');
            } else {
                session()->setFlashdata('error', 'Error al atender el ticket.');
            }
            return redirect()->to('tickets');
        }

        return redirect()->to('tickets');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}