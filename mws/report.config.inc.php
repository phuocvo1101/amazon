<?php

include_once('config.inc.php');




function __autoload($className){
    $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    set_include_path(get_include_path() . PATH_SEPARATOR . './mws/report/src');
    $includePaths = explode(PATH_SEPARATOR, get_include_path());

    set_include_path(get_include_path() . PATH_SEPARATOR . './mws/order/src');
    $includePaths1 = explode(PATH_SEPARATOR, get_include_path());
    $includePaths = array_merge($includePaths,$includePaths1);

    foreach($includePaths as $includePath){

        if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
            require_once $filePath;
            return;
        }
      //  echo $includePath . DIRECTORY_SEPARATOR . $filePath.'<br>';
    }
}
