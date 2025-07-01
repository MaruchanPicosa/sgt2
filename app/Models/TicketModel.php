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

    public function getTicketsByUsuario($usuario_id)
    {
        return $this->where('id_usuario', $usuario_id)
                    ->join('categorias', 'categorias.id = tickets.id_categoria')
                    ->select('tickets.*, categorias.nombre as categoria_nombre')
                    ->findAll();
    }

    public function getTicketsByAgente($agente_id)
    {
        return $this->where('asignado_a', $agente_id)
                    ->join('categorias', 'categorias.id = tickets.id_categoria')
                    ->select('tickets.*, categorias.nombre as categoria_nombre')
                    ->findAll();
            
            /*$asigando = $this->where('asignado_a', $agente_id)
                    ->join('categorias', 'categorias.id = tickets.id_categoria')
                    ->select('tickets.*, categorias.nombre as categoria_nombre')
                    ->findAll();

        $sinAsignar = $this->where('asignado_a', null)
                    ->join('categorias', 'categorias.id = tickets.id_categoria')
                    ->select('tickets.*, categorias.nombre as categoria_nombre')
                    ->findAll();

        return array_merge($asigando, $sinAsignar); */
    }   

    public function getAllTickets()
    {
        return $this->join('categorias', 'categorias.id = tickets.id_categoria')
                    ->join('usuarios', 'usuarios.id = tickets.asignado_a', 'left')
                    ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as agente_nombre')
                    ->findAll();
    }

    public function getTicketWithComentarios($ticket_id)
    {
        $ticket = $this->join('categorias', 'categorias.id = tickets.id_categoria')
                       ->join('usuarios', 'usuarios.id = tickets.asignado_a', 'left')
                       ->select('tickets.*, categorias.nombre as categoria_nombre, usuarios.nombre as agente_nombre')
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
        }

        return $ticket;
    }

    public function addComentario($data)
    {
        $db = \Config\Database::connect();
        $db->table('comentarios_tickets')->insert($data);
        return $db->insertID();
    }

    public function addAdjunto($data)
    {
        $db = \Config\Database::connect();
        return $db->table('adjuntos_tickets')->insert($data);
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
            $data = [
                'nombre' => $nombre,
                'descripcion' => 'Categoría creada por usuario'
            ];
            $db->table('categorias')->insert($data);
            $categoria = $db->table('categorias')->where('id', $db->insertID())->get()->getRowArray();
        }

        return $categoria['id'];
    }

    
}