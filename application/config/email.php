<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Configuração email
* Arquivo de suporte da library Email Codeigniter
**/
$config['protocol']  = 'smtp';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE; //quebra de palavras
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'simcosta.data@gmail.com';
$config['smtp_pass'] = 'vitSO900@furg';
$config['smtp_timeout'] = 10;
$config['mailtype'] = 'html';