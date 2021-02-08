<?php

define("ENV" ,getenv("APP_ENV" ));
define('ENV_DEV' , 'dev');
define('ENV_TEST' , 'test');
define('ENV_PRODUCT' , 'product');
define('IS_DEV_ENV' , ENV_DEV == ENV);
define('IS_TEST_ENV' , ENV_TEST == ENV);
define('IS_PRODUCT_ENV' , ENV_PRODUCT == ENV);

