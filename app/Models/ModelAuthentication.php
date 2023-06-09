<?php

namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use CodeIgniter\Database\MySQLi\Builder;


class ModelAuthentication extends Model 
{
    protected $db;
    
    function  __construct () 
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getClientBy($field, $value)
    {
        $query = $this->db->table('client')
        ->select('*')
        ->where($field, $value)
        ->get();

        return $query->getResultArray();
    }

    public function createClient($data)
    {
        $result = array();
        $result['error'] = '';
        $result['id'] = '';

        $query = $this->db->table('client')
        ->insert($data);

        if($query->resultID == true)
        {
            $result['error'] = 0;
            $result['id'] = $query->connID->insert_id;
        }
        else
          $result['error'] = 1;
        
        return $result;
    }

    public function activateAccountProcess($token)
    {
        $data = array();
        $data['token'] = '';
        $data['emailVerified'] = 1;
        $data['access'] = 1;
    
        $query = $this->db->table('client')
        ->where('token', $token)
        ->update($data);

        return $query;
    }

    public function setClientToken($id, $data)
    {
        
        $query = $this->db->table('client')
        ->where('id', $id)
        ->update($data);

        return $query;
    }

}