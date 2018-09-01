<?php
error_reporting(-1);
ini_set('display_errors', 1);

include_once 'repoHelper.php';

/**
 * Файлик для проверки зависимостей всех пакетов
 */


loadReposConfig();
foreach($reposConfig as $repo){
	search(REPOS_PATH.DIRECTORY_SEPARATOR.$repo['packages']);
}

/**
 * Перебирает папки в $path, ищет все package.json и отправляет их на проверку
 * по мере обнаружения.
 * @param type $path
 */
function search($path){
    foreach(scandir($path) as $entry){
        if(in_array($entry,['.','..'])){continue;}
        $ent = $path.DIRECTORY_SEPARATOR.$entry;        
        if(is_dir($ent)){
            search($ent);
        }else if($entry == 'package.json'){
            doCheck($ent);
        }
    }
}

/**
 * Проводит проверку зависимостей, указанных в jsonPath на предмет существования 
 * этих самых зависимостей.
 * @param type $jsonPath
 */
function doCheck($jsonPath){
    global $path;
    echo cutPath($jsonPath).'<br/>';
    $json = json_decode(file_get_contents($jsonPath), true);
    if(isset($json['requires'])){
        foreach($json['requires'] as $pack){
            echo $pack.' ';
            echo findPackage($pack) != null ?
                    '<font color="green">OK</font>' : '<font color="red">FAIL</font>';
            echo '<br/>';
        }
    }else{
        echo '<font color="orange">No "requires" found</font>';
    }
    echo '<hr/>';
}

function cutPath($fullPath){
    return str_replace("/",DIRECTORY_SEPARATOR,substr($fullPath,strlen(REPOS_PATH)));
}