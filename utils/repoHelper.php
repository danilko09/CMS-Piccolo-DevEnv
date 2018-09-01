<?php

define("REPOS_PATH", dirname(__DIR__).DIRECTORY_SEPARATOR."repos");
$reposConfig = [];

/**
	Ищет пакет во всех локальных репозиториях
	@return Не нашел - null, нашел - путь до папки пакета
*/
function findPackage($package){
	global $reposConfig;
	loadReposConfig();
	
	foreach($reposConfig as $repo){
		$path = REPOS_PATH.DIRECTORY_SEPARATOR.$repo.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $package);
		if(file_exists($path.DIRECTORY_SEPARATOR.'package.json')){
			return $path;
		}
	}
	
	return null;
}

/**
	Подгружает конфигу репозиториев
*/
function loadReposConfig(){
	global $reposConfig;
	
	if(count($reposConfig) > 0){return;}
	
	$txt = file_get_contents(REPOS_PATH.DIRECTORY_SEPARATOR."config.json");
	$reposConfig = json_decode($txt, true);
}