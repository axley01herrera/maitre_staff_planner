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

    public function signup()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.recover_password');
        $data['route'] = 'Authentication/signup';
        $data['page'] = 'authentication/signup';
        $data['textButtonSubmit'] = lang('Text.save');
        $data['language'] = $this->request->getLocale();

        return view('authentication/layout', $data);
    }

    public function showTerm()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.terms_and_conditions');

        return view('modals/simpleModal', $data);
    }

    public function showPrivacyPolicy()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.privacy_policy');

        return view('modals/simpleModal', $data);
    }

    public function create()
    {
        $response = array();
        $response['error'] = '';
        $response['msg'] = '';

        $today = getdate();
        $formData = $this->request->getPost('post');

        $data = array();
        $data['email'] = trim($formData['email']);
        $data['password'] = password_hash(trim($formData['password']), PASSWORD_DEFAULT);
        $data['token'] = md5(uniqid().$formData['email']);
        $data['lang'] = $this->request->getLocale();
        $data['registrationDate'] = date('Y-m-d', $today[0]);

        $resultGetClient = $this->modelAuthentication->getClientBy('email', $data['email']);

        if(empty($resultGetClient))
        {
            $resultCreate = $this->modelAuthentication->createRecord($data);

            if($resultCreate['error'] == 0)
            {
                $email = array();
                $email['barner'] = 'MAITRE STAFF PLANNER';
                $email['welcomeMsg'] = lang('Text.ac_welcome_msg');
                $email['btnText'] = lang('Text.ac_text_btn_activate');
                $email['footerMsg'] = lang('Text.ac_footer_msg');

                $this->email->setFrom('info@grupoahvsolucionesinformaticas.es', 'MAITRE STAFF PLANNER');
                $this->email->setTo($formData['email']);
                $this->email->setSubject('MAITRE STAFF PLANNER');
                $this->email->setMessage(view('email/activateAccount', $email));
                $this->email->send();

                $response['error'] = 0;
                $response['msg'] = lang('Text.success_registration_msg');
            }
            else
            {
                $response['error'] = 1;
                $response['msg'] = lang('Text.global_error_msg');
            }
        }
        else 
        {
            $response['error'] = 1;
            $response['msg'] = lang('Text.dulicate_client_msg');
        }

        return json_encode($response);
    }
   
}