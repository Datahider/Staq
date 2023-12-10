<?php

use losthost\DB\DB;

require_once '../vendor/autoload.php';

define('DB_HOST', 'localhost');
define('DB_USER', 'test');
include_once 'db_pass.php';
define('DB_NAME', 'test');
define('DB_PREF', 'staq_');

DB::connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PREF);