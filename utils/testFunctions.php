<?php

include_once 'repoHelper.php';


/**
	Добавляет сообщение в лог теста
*/
function testLog($msg, $level = 'info'){
	if($level == 'error'){
		echo '<font color="red">'.htmlspecialchars($msg).'</font><br/>';
	}else{
		echo htmlspecialchars($msg).'<br/>';
	}
}

/**
	Подгружает классы пакета и его зависимостей
*/
function loadPackageClasses($package){
    
	$packagePath = findPackage($package);
	
	if($packagePath == null){
		testLog("Unable to load classes for '$package': package not found!", "error");
		return;
	}
	
    $packageInfo = json_decode(file_get_contents($packagePath.DIRECTORY_SEPARATOR.'package.json'), true);
    
    if(isset($packageInfo['requires'])){
        if(!is_array($packageInfo['requires'])){
            loadPackageClasses($packageInfo['requires']);
        }
        foreach($packageInfo['requires'] as $dependency){
            loadPackageClasses($dependency);
        }
    }
    
    testLog("Loading classes for '$package'");    
    foreach($packageInfo['classes'] ?? [] as $class){
        testLog($class['file_in']);
        include $packagePath.DIRECTORY_SEPARATOR.$class['file_in'];
    }
    testLog("");
}