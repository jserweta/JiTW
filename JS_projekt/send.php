<?php
	$nickINPUT = $_GET['nickINPUT'];
	$messageINPUT = $_GET['messageINPUT'];
	$dane = $nickINPUT . ": " . $messageINPUT."\n";
    $file = "./messages.txt";
    

	if(countFileLines($file) > 10)
		deleteFirstLine($file);
		
	$writer = fopen($file, "a");
	flock($writer,LOCK_EX);
	fwrite($writer, $dane);
	flock($writer,LOCK_UN);
	fclose($writer);
	
	function countFileLines($filename){
		$linecount = 0;
		$handle = fopen($filename, "r");
		while(!feof($handle))
		{
			$line = fgets($handle);
			$linecount++;
		}
		fclose($handle);
		return $linecount;
	}
	
	function deleteFirstLine($filename){
		$file = file($filename);
		unset($file[0]);
		file_put_contents($filename, $file);
	}
?>
