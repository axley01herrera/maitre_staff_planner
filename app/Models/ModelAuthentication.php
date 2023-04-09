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

    public function verifyCredentials($email, $password)
    {
        $result = array();

        $checkClientEmailExist = $this->checkClientEmailExist($email);

        if(!empty($checkClientEmailExist))
        {
            if(password_verify($password , $checkClientEmailExist[0]['password']))
            {
                if($checkClientEmailExist[0]['emailVerified'] == 1)
                {
                    $result['error'] = 0;
                    $result['data'] = $checkClientEmailExist;
                }
                else
                {
                    $result['error'] = 1;
                    $result['msg'] = 'EMAIL_NOT_VERIFIED';
                }
            }
            else
            {
                $result['error'] = 1;
                $result['msg'] = 'INVALID_PASSWORD';
            }
        }
        else
        {
            $result['error'] = 1;
            $result['msg'] = 'EMAIL_NOT_FOUND';
        }

        return $result;
    }

    public function checkClientEmailExist($email)
    {
        return $this->db->table('client')->select('*')->where('email', $email)->get()->getResultArray();
    }

    public function createClient($data)
    {
        $result = array();
        $query = $this->db->table('client')->insert($data);

        if($query->resultID == true)
        {
            $result['error'] = 0;
            $result['id'] = $query->connID->insert_id;
        }
        else
        {
            $result['error'] = 1;
        }

        return $result;
    }

    public function getClientByToken($token)
    {
        return $this->db->table('client')->select('id, email')->where('token', $token)->get()->getResultArray();
    }

    public function updateClient($id, $data)
    {
        $query = $this->db->table('client')->where('id', $id)->update($data);

        if($query == true)
        {
            $result['error'] = 0;
            $result['id'] = $id;
        }
        else
        {
            $result['error'] = 1;
            $result['id'] = $id;
        }

        return $result;
    }
}