<?php
    include 'menu.php';
    $dir_name=$_POST["nazwa"];
    $username=$_POST["user"];
    $password=$_POST["password"];
    $pass_code=md5($password);
    $opis=$_POST["opis"];

    $Semaphore = sem_get(9998, 1, 0666, 1);
	sem_acquire($Semaphore);

    if(!file_exists("./$dir_name")){
        mkdir("./$dir_name", 0755);
        $info = fopen("./$dir_name/info", "w");
        fwrite($info, $username. PHP_EOL);
        fwrite($info, $pass_code. PHP_EOL);
        fwrite($info, $opis. PHP_EOL); 
        print_r("Stworzono poprawnie!");
        fclose($info);   
    }
    else{
        print_r("Blog o podanej nazwie już istnieje!");
    }
    sem_release($Semaphore);
?>

