<?php

function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = APPPATH.'libraries/'. $classname.'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

    function CustomMail($array)
    { 
        $CI = & get_instance();                                    
        $CI->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';

        /*$config['smtp_user']    =  $CI->configuration_setting_data['SupportEmail'];
        $config['smtp_pass']    =$CI->configuration_setting_data['EmailPassword'];*/

        $config['smtp_user']="shripa.saggisoftsolutions@gmail.com";
        $config['smtp_pass']="Shripa@321";
        
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html/text
        $config['validation'] = TRUE;//TRUE; // bool whether to validate email or not      
           
        $CI->email->initialize($config);
        $CI->email->from($CI->configuration_setting_data['SupportEmail'],'Upexa Patel');
        $CI->email->to($array['to']); 
        $CI->email->cc(@$array['CC']);
        $CI->email->bcc(@$array['BCC']);

        $CI->email->subject($array['subject']);
        $CI->email->message($array['Body']); 
        if(@$array['Attached']!='')
        $CI->email->attach($array['Attached']);
        if(@$array['Attached2']!='')
        $CI->email->attach($array['Attached2']); 
        //print_r($CI->email); exit;
        return $CI->email->send();
        
        //echo $CI->email->print_debugger();exit;
    }

    if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
        //SPL autoloading was introduced in PHP 5.1.2
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            spl_autoload_register('PHPMailerAutoload', true, true);
        } else {
            spl_autoload_register('PHPMailerAutoload');
        }
    } else {
        /**
         * Fall back to traditional autoload for old PHP versions
         * @param string $classname The name of the class to load
         */
        spl_autoload_register(function($classname) 
        {
            PHPMailerAutoload($classname);
        });
    }

