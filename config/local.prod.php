<?php

// Production environment

$settings['error']['display_error_details'] = false;
$settings['logger']['level'] = \Monolog\Logger::INFO;

// Database
$settings['db']['database'] = 'api_slim4_prod';