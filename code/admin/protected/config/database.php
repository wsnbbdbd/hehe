<?php

// this contains the application database configure
$_config = array();

// ---------------------  CONFIG CONNECTIONSTRING  ---------------------- //
$_config['connectionString'] = 'mysql:host=localhost;dbname=hehe';

// ----------------------  CONFIG EMULATEPREPARE  ----------------------- //
$_config['emulatePrepare'] = 1;

// -------------------------  CONFIG USERNAME  -------------------------- //
$_config['username'] = 'root';

// -------------------------  CONFIG PASSWORD  -------------------------- //
$_config['password'] = '';

// --------------------------  CONFIG CHARSET  -------------------------- //
$_config['charset'] = 'utf8';

// ------------------------  CONFIG TABLEPREFIX  ------------------------ //
$_config['tablePrefix'] = 'tb_';

return $_config;

// -------------------  THE END  -------------------- //

?>