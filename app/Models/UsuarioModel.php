<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false; // Desactivado porque usamos UUID
    protected $returnType = 'array';
    protected $allowedFields = ['id', 'nombre', 'correo', 'contrasena', 'rol', 'creado_en', 'actualizado_en'];

    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }
        return $data;
    }
}