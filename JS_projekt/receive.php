<?php
    if (!isset($_COOKIE['lastUpdate'])) {
        setcookie('lastUpdate', 0);
        $_COOKIE['lastUpdate'] = 0;
    }

    $lastUpdate = $_COOKIE['lastUpdate'];

	$file = "./messages.txt";
	if(!file_exists($file)){
        echo("Brak wiadomości!");
        $writer = fopen($file, "a");
		fclose($writer); 
	}
    
    while (true) {

		$fileModifyTime = filemtime($file);

		if ($fileModifyTime > $lastUpdate) {
			setcookie('lastUpdate', $fileModifyTime);

			readfile($file);

			exit();

        }
        
        clearstatcache();
        
		sleep(1);
		
    }
	
?>