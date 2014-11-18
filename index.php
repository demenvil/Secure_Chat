<?php
session_start();

define('DEBUG', TRUE);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);
define('EXT', '.php');
define('WEBROOT', '/');

require 'system' . DS . 'Config' . EXT;
require 'system' . DS . 'Database' . EXT;
require 'system' . DS . 'Input' . EXT;
require 'system' . DS . 'Popup' . EXT;
require 'system' . DS . 'Auth' . EXT;
require 'system' . DS . 'Message' . EXT;
require 'system' . DS . 'User' . EXT;
require 'system' . DS . 'Router' . EXT;
require 'system' . DS . 'mvc' . DS .'View' . EXT;
require 'system' . DS . 'mvc' . DS .'Controller' . EXT;

require 'app' . DS . 'RSA' . DS . 'RSAMathsTools' . EXT;
require 'app' . DS . 'RSA' . DS . 'RSAStringTools' . EXT;
require 'app' . DS . 'RSA' . DS . 'RSA' . EXT;
require_once 'app' . DS . 'RSA' . DS . 'Keys' . EXT;

$router = new Router();
$router->run();
