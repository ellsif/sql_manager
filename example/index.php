<?php
require_once '../vendor/autoload.php';

use ellsif\sql_manager\SqlManager;

SqlManager::execute(dirname(__FILE__), 'ellsif\sql_manager');