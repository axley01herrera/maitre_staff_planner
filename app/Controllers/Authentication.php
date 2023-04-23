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
        $this->session->destroy();

        helper('Site');
        setLanguage($this->request->getPostGet('language'));
    }

    public function index()
    {
        $data = array();
        $data['pageTitle'] = lang('Text.login');
        $data['route'] = 'Authentication/index';
        $data['page'] = 'authentication/login';
        $data['textButtonSubmit'] = lang('Text.log_in');
        $data['language'] = $this->request->getLocale();
        $data['show_msg_success_activation'] = $this->request->getPostGet('show_msg_success_activation');

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
        $response['resultSendEmail'] = '';

        $today = getdate();
        $formData = $this->request->getPost('post');

        $data = array();
        $data['email'] = trim($formData['email']);
        $data['password'] = password_hash(trim($formData['password']), PASSWORD_DEFAULT);
        $data['token'] = md5(uniqid().$formData['email']);
        $data['language'] = $this->request->getLocale();
        $data['registrationDate'] = date('Y-m-d', $today[0]);

        $resultGetClient = $this->modelAuthentication->getClientBy('email', $data['email']);

        if(empty($resultGetClient))
        {
            $resultCreate = $this->modelAuthentication->createClient($data);

            if($resultCreate['error'] == 0)
            {
                $email = array();
                $email['welcomeMsg'] = lang('Text.ac_welcome_msg');
                $email['btnText'] = lang('Text.ac_text_btn_activate');
                $email['footerMsg'] = lang('Text.ac_footer_msg');
                $email['link'] = base_url('Authentication/activateAccount').'?token='.$data['token'].'&language='.$data['language'];

                $this->email->setFrom('info@grupoahvsolucionesinformaticas.es', 'MAITRE STAFF PLANNER');
                $this->email->setTo($formData['email']);
                $this->email->setSubject('MAITRE STAFF PLANNER');
                $this->email->setMessage(view('email/activateAccount', $email));
                $resultSendEmail = $this->email->send();

                $response['error'] = 0;
                $response['msg'] = lang('Text.success_registration_msg');
                $response['resultSendEmail'] = $resultSendEmail;
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

    public function activateAccount()
    {
        $token = $this->request->getPostGet('token');

        $data = array();
        $data['pageTitle'] = lang('Text.error');
        $data['language'] = $this->request->getLocale();

        if(empty($token))
            return view('errorPages/error', $data);

        $result = $this->modelAuthentication->getClientBy('token', $token);

        if(empty($result))
            return view('errorPages/tokenEpired', $data);

        $resulActivateAccountProcess = $this->modelAuthentication->activateAccountProcess($token);

        if($resulActivateAccountProcess == true)
            return redirect()->to(base_url('Authentication?language='.$data['language'].'&show_msg_success_activation=1'));
        else
            return view('errorPages/error', $data);
    }

    public function createNewPasswordEmail()
    {
        $response = array();
        $response['error'] = '';
        $response['msg'] = '';
        
        $formData = $this->request->getPost('post');
        $language = $this->request->getLocale();
        $verifyExistEmail = $this->modelAuthentication->getClientBy('email', $formData['email']);
        
        if(!empty($verifyExistEmail))
        {
            $data = array();
            $data['token'] =  md5(uniqid().$formData['email']);

            $resultSetToken = $this->modelAuthentication->setClientToken($verifyExistEmail[0]['id'], $data);

            if($resultSetToken == true)
            {
                $email = array();
                $email['info'] = lang('Text.rp_info_msg');
                $email['btnText'] = lang('Text.rp_text_btn_activate');
                $email['footerMsg'] = lang('Text.rp_footer_msg');
                $email['link'] = base_url('Authentication/createNewPassword').'?token='.$data['token'].'&language='.$language;

                $this->email->setFrom('info@grupoahvsolucionesinformaticas.es', 'MAITRE STAFF PLANNER');
                $this->email->setTo($formData['email']);
                $this->email->setSubject('MAITRE STAFF PLANNER');
                $this->email->setMessage(view('email/recoverPassword', $email));
                $resultSendEmail = $this->email->send();

                if($resultSendEmail == true)
                {
                    $response['error'] = 0;
                    $response['msg'] = lang('Text.success_send_email_create_new_password');
                    $response['resultSendEmail'] = $resultSendEmail;
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = lang('Text.global_error_msg');
                    $response['devMsg'] = 'error send email';
                }
            }
            else
            {
                $response['error'] = 1;
                $response['msg'] = lang('Text.global_error_msg');
                $response['devMsg'] = 'error set client token';
            }
        }
        else
        {
            $response['error'] = 1;
            $response['msg'] = lang('Text.email_not_found_msg');
        }

        return json_encode($response);
    }

    public function createNewPassword()
    {
        
    }
   
}