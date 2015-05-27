<?php



function __autoload($className){
    $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $includePaths = explode(PATH_SEPARATOR, get_include_path());

    foreach($includePaths as $includePath){
        $path1 =  $includePath. DIRECTORY_SEPARATOR . $filePath;

        if(file_exists($path1)){
            require_once $filePath;
            return;
        }
    }
}

