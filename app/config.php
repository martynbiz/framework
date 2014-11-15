<?php
/**
* All this script does really is just load our PHP array containing files
*/

function loadConfig($configDirs)
{
    $config = array();

    foreach($configDirs as $dir) {
        if (is_dir($dir)) {
            foreach (new \DirectoryIterator($dir) as $fileInfo) {
                if($fileInfo->isDot() or $fileInfo->isDir()) continue;
                $config = array_merge($config, require($dir . $fileInfo->getFilename()));
            }
        }
    }
    
    return $config;
}

$config = loadConfig(array(
    APPLICATION_PATH . '/config/',
    APPLICATION_PATH . '/config/' . getenv('APPLICATION_ENV') . '/',
));