<?php

  namespace App\Models;

  use CodeIgniter\Model;
  use Ramsey\Uuid\Uuid;

  class TicketModel extends Model
  {
      protected $table = 'tickets';
      protected $primaryKey = 'id';
      protected $useAutoIncrement = false;
      protected $returnType = 'array';
      protected $allowedFields = ['id', 'id_usuario', 'titulo', 'descripcion', 'prioridad', 'id_categoria', 'estado', 'asignado_a', 'respondido_en', 'resuelto_en'];

      protected $beforeInsert = ['generateUuid'];

      public function generateUuid($data)
      {
          if (!isset($data['data']['id'])) {
              $data['data']['id'] = Uuid::uuid4()->toString();
          }
          return $data;
      }

        public function getTicketsByCategoria($categoria_id)
        {
            return $this->where('id_categoria', $categoria_id)
                        ->join('categorias', 'categorias.id = tickets.id_categoria')
                        ->join('usuarios', 'usuarios.id = tickets.id_usuario', 'left')
                        ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as usuario_nombre')
                        ->findAll();
        }


      public function getTicketsByUsuario($usuario_id)
      {
          return $this->where('id_usuario', $usuario_id)
                      ->join('categorias', 'categorias.id = tickets.id_categoria')
                      ->join('usuarios', 'usuarios.id = tickets.id_usuario', 'left')
                      ->join('usuarios u2', 'u2.id = tickets.asignado_a', 'left')
                      ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as usuario_nombre,u2.nombre as agente_nombre')
                      ->findAll();
      }

      public function getTicketsByAgente($agente_id)
      {
          return $this->where('asignado_a', $agente_id)
                      ->join('categorias', 'categorias.id = tickets.id_categoria')
                      ->join('usuarios', 'usuarios.id = tickets.asignado_a', 'left')
                      ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as agente_nombre')
                      ->findAll();
      }

      public function getTicketsSinAsignar()
      {
          return $this->where('asignado_a IS NULL')
                      ->join('categorias', 'categorias.id = tickets.id_categoria')
                      ->join('usuarios', 'usuarios.id = tickets.id_usuario', 'left')
                      ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as usuario_nombre')
                      ->findAll();
      }

      public function asignarTicket($ticket_id, $agente_id = null)
        {
            log_message('info', "Intentando asignar ticket $ticket_id a agente $agente_id");
            $data = ['asignado_a' => $agente_id];
            // Cambiar estado a "en progreso" cuando se asigna un agente (incluye 'atender' para agentes)
            if ($agente_id && $agente_id !== 'atender') {
                $data['estado'] = 'en_progreso';
                log_message('info', 'Actualizando estado a en_progreso al asignar a: ' . $agente_id);
            } elseif ($agente_id === 'atender') {
                $data['estado'] = 'en_progreso';
                $data['asignado_a'] = session('user_id'); // Asigna al agente actual
                log_message('info', 'Actualizando estado a en_progreso y asignando a: ' . session('user_id'));
            }
            $exists = $this->where('id', $ticket_id)->countAllResults();
            if ($exists) {
                $result = $this->update($ticket_id, $data);
                log_message('info', 'Resultado de actualización: ' . ($result ? 'éxito' : 'fracaso') . ', Última consulta: ' . $this->db->getLastQuery());
                return $result;
            } else {
                log_message('error', 'Ticket ID no encontrado: ' . $ticket_id);
                return false;
            }
        }
        

      public function getAllTickets()
      {
          return $this->join('categorias', 'categorias.id = tickets.id_categoria')
                      ->join('usuarios u1', 'u1.id = tickets.id_usuario', 'left')
                      ->join('usuarios u2', 'u2.id = tickets.asignado_a', 'left')
                      ->select('tickets.*, categorias.nombre as categoria_nombre, u1.nombre as usuario_nombre, u2.nombre as agente_nombre')
                      ->findAll();
      }

      public function getTicketWithComentarios($ticket_id)
        {
            $ticket = $this->join('categorias', 'categorias.id = tickets.id_categoria')
                        ->join('usuarios u1', 'u1.id = tickets.id_usuario', 'left')
                        ->join('usuarios u2', 'u2.id = tickets.asignado_a', 'left')
                        ->select('tickets.*, categorias.nombre as categoria_nombre, u1.nombre as usuario_nombre, u2.nombre as agente_nombre')
                        ->where('tickets.id', $ticket_id)
                        ->first();

            if ($ticket) {
                $db = \Config\Database::connect();
                $ticket['comentarios'] = $db->table('comentarios_tickets')
                    ->select('comentarios_tickets.*, usuarios.nombre as usuario_nombre')
                    ->join('usuarios', 'usuarios.id = comentarios_tickets.id_usuario')
                    ->where('id_ticket', $ticket_id)
                    ->orderBy('creado_en', 'ASC')
                    ->get()
                    ->getResultArray();

                foreach ($ticket['comentarios'] as &$comentario) {
                    $comentario['adjuntos'] = $db->table('adjuntos_tickets')
                        ->where('id_comentario_ticket', $comentario['id'])
                        ->get()
                        ->getResultArray();
                }
                // Solo adjuntos del ticket (sin comentarios)
                $ticket['adjuntos'] = $db->table('adjuntos_tickets')
                    ->where('id_ticket', $ticket_id)
                    ->where('id_comentario_ticket IS NULL')
                    ->get()
                    ->getResultArray();
            }

            return $ticket;
        }

      public function addComentario($data)
      {
          $db = \Config\Database::connect();
          $data['id'] = Uuid::uuid4()->toString(); // Generar UUID para id
          $data['creado_en'] = date('Y-m-d H:i:s');
          $db->table('comentarios_tickets')->insert($data);
          log_message('info', 'Comentario insertado con ID: ' . $db->insertID());
          return $db->insertID() ? $data['id'] : false; // Retornar el ID generado
      }

      public function addAdjunto($data)
      {
          $db = \Config\Database::connect();
          $data['creado_en'] = date('Y-m-d H:i:s');
          if (!isset($data['id_comentario_ticket'])) {
              $data['id_comentario_ticket'] = null;
          }
          log_message('info', 'Intentando insertar adjunto: ' . json_encode($data));
          $db->table('adjuntos_tickets')->insert($data);
          log_message('info', 'Adjunto insertado con ID: ' . $db->insertID());
          return $db->insertID();
      }

      public function getCategorias()
      {
          $db = \Config\Database::connect();
          return $db->table('categorias')->get()->getResultArray();
      }

      public function getOrCreateCategoria($nombre)
      {
          $db = \Config\Database::connect();
          $categoria = $db->table('categorias')->where('nombre', $nombre)->get()->getRowArray();

          if (!$categoria) {
              $data = ['nombre' => $nombre, 'descripcion' => 'Categoría creada por usuario'];
              $db->table('categorias')->insert($data);
              $categoria = $db->table('categorias')->where('id', $db->insertID())->get()->getRowArray();
          }

          return $categoria['id'];
      }
  }