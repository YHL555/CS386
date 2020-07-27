
<?php

ob_start();

session_start();

define("DS") ? null : define("DS", DIRECTORY_SEPARATOR);


define("TEMPLATE_FRONT") ?  null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

define("TEMPLATE_BACK") ?  null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/back");

define("DB_HOST") ?  null : define("DB_HOST", "localhost");

define("DB_USER") ?  null : define("DB_USER", "root");

define("DS_PASS") ?  null : define("DS_PASS", "");

define("DB_NAME") ?  null : define("DB_NAME", "ecmo_db");

$connectiuon = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("functions.php");




?>