<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['googleplus']['client_id']        = '502195815890-4bpemanqmdkjeob7gi9km93oqfr41boi.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'nRbXXrqk06CoQc7o8ru_PyqQ';
$config['googleplus']['redirect_uri']     = 'http://localhost/dijait/login/google';
$config['googleplus']['application_name'] = 'dijait.id';
$config['googleplus']['api_key']          = '';
$config['googleplus']['scopes']           = array();
