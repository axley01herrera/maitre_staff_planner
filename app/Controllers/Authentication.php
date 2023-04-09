<?php

namespace App\Controllers;

use App\Models\ModelAuthentication;

class Authentication extends BaseController
{
    public $session;
    public $request;
    public $modelAuthentication;
    public $email;

    public function __construct()
    {
        $this->session = session();
        $this->request = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->modelAuthentication = new ModelAuthentication;

        $this->session->set('id', '');
        $this->session->set('email', '');
        $this->session->set('status', '');

        # SET LANGUAJE
        if(empty($this->request->getPostGet('language')))
        {
            $browserLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

            if($browserLang == 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3')
                $this->request->setLocale('es');
            else
                $this->request->setLocale('en');
        }
        else
            $this->request->setLocale($this->request->getPostGet('language'));
    }

    public function index()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.login');
        $data['route'] = 'Authentication/index';
        $data['page'] = 'authentication/login';
        $data['textButtonSubmit'] = lang('Text.log_in');
        $data['language'] = $this->request->getLocale();

        return view('authentication/layout', $data);
    }

    public function recoverPassword()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.recover_password');
        $data['route'] = 'Authentication/recoverPassword';
        $data['page'] = 'authentication/recoverPassword';
        $data['textButtonSubmit'] = lang('Text.send_instructions');
        $data['language'] = $this->request->getLocale();

        return view('authentication/layout', $data);
    }
   
}