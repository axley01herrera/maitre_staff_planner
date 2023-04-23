<?php

    function setLanguage($language)
    {
        $request = \Config\Services::request();

        if(empty($language))
        {
            $browserLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

            if($browserLang == 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3')
                $request->setLocale('es');
            else
                $request->setLocale('en');
        }
        else
            $request->setLocale($language);
    }
?>