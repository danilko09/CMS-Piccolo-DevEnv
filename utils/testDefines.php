<?php

define('PICCOLO_ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tmp');
define('PICCOLO_ROOT_URL', '/tmp');

define('PICCOLO_CMS_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'cms');
define('PICCOLO_CMS_URL', PICCOLO_ROOT_URL . '/cms');

define('PICCOLO_CONFIGS_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'config');
define("PICCOLO_DATA_DIR", PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'data');

define('PICCOLO_TEMPLATES_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'template');
define('PICCOLO_TEMPLATES_URL', PICCOLO_ROOT_URL . '/template');

define('PICCOLO_SCRIPTS_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'scripts');
define('PICCOLO_CLASSES_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'classes');

define('PICCOLO_TRANSLATIONS_DIR', PICCOLO_ROOT_DIR . DIRECTORY_SEPARATOR . 'locales');

define('PICCOLO_SYSTEM_DEBUG', true);
define('PICCOLO_SYSTEM_PRINT_TIMINGS',true);
