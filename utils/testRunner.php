<?php

include_once 'repoHelper.php';
loadReposConfig();

    $dir = filter_input(INPUT_GET, 'dir') ?? "";
	if($dir == ""){
		foreach($reposConfig as $repo){
			printEntry($repo['tests']);
		}		
	}else{
		foreach(scandir(REPOS_PATH.DIRECTORY_SEPARATOR.$dir) as $entry){
			if($entry == '.'){continue;}
			printEntry($entry);
		}
	}

	function printEntry($entry){
		global $dir;
		$prefix = $dir == "" ? "" : $dir."/";        
			if($entry == '..' && $dir != ""){
				$dirname = dirname($dir);
				if($dirname != '.'){
					echo "<a href='?dir=".urldecode($dirname)."'>$entry</a><br/>";
				}else{
					echo "<a href='?'>$entry</a><br/>";
				}
			}elseif(is_dir(REPOS_PATH.DIRECTORY_SEPARATOR.$entry) && $entry != '..'){
				echo "<a href='?dir=".urldecode($prefix.$entry)."'>$entry</a><br/>";
			} elseif(is_file(REPOS_PATH.DIRECTORY_SEPARATOR.$prefix.$entry)) {
				?>
					<a href="#" onclick="
						document.getElementById('file').value = '<?=$prefix.$entry?>';
						document.getElementById('form').submit();
						"><?=$entry?></a><br/>
				<?php
			}else{
				echo "wtf? $entry";
			}
	}
	
?>
<form method="POST" id="form" style="display: none">
    <input type="text" name="file" id="file" value="<?=filter_input(INPUT_POST, "file")?>"/><br/>
    <input type="submit"/>
</form>
<?php

if(filter_input(INPUT_POST, "file") == null){
    exit();
}else{
    ?>
    <br/>
    <button onclick="document.getElementById('form').submit()">retest</button>
    <hr/>
    <?php
}

error_reporting(-1);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));
include 'cleanup.php';

include 'testAsserts.php';
include 'testDefines.php';
include 'testFunctions.php';

if(!file_exists('tmp')){
    mkdir('tmp');
}
chdir(getcwd().DIRECTORY_SEPARATOR.'tmp');

$testFile = filter_input(INPUT_POST, "file");
try{
    include REPOS_PATH.DIRECTORY_SEPARATOR.$testFile;
    echo '<br/><font color="green">Тест пройден успешно</font><br/>';
}catch(AssertionError $ex){
    echo '<br/><font color="red">Тест завершен с ошибкой</font></br>';
    $trace = str_replace($ex->getMessage(), $ex->getMessage()."\n\n", $ex);
    echo '<pre>'.str_replace($testFile, "<b>".$testFile."</b>", $trace).'</pre>';
}