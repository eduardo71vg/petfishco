<?php

return new \Phalcon\Config(array(

    'database' => array(
        'adapter'    => 'Mysql',
        'host'     => getenv('DATABASE_HOST'),
        'username' => getenv('DATABASE_USER'),
        'password' => getenv('DATABASE_PASS'),
        'dbname'   => getenv('DATABASE_NAME'),
        'charset'    => 'utf8',
    ),

    'application' => array(
        'modelsDir'      => getenv('BASE_DIR')  . '/models/',
        'migrationsDir'  => getenv('BASE_DIR') . '/migrations/',
        'baseUri'        => '/',
    ),
    'api' => [
    	'base_url' => getenv('API_BASE_URL')
	]

));
