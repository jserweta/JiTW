<?php
    include 'menu.php';
    $username=$_POST["user"];
    $password=$_POST["password"];
    $wpis=$_POST["wpis"];
    $pass_code=md5($password);

    $data=str_replace("-", "",$_POST["data"]);
    $godzina=str_replace(":","",$_POST["godzina"]);
    $sekunda=date("s");
    $unikalneID=0;

    $userExists=false;
    
    $attachment1=$_FILES["file1"];
    $attachment2=$_FILES["file2"];
    $attachment3=$_FILES["file3"];
    $attachments=array($attachment1,$attachment2,$attachment3);

    
    $mainFolder = opendir("./");
    while(false !== ($blogDirectory = readdir($mainFolder))){
        if($blogDirectory == "." || $blogDirectory == ".."){
            continue;
        }elseif(is_dir($blogDirectory)){

            $fileInfo = fopen("./".$blogDirectory."/info", "r");
          
                for($i=0; $i<2; $i++){
                    $line[$i] = fgets($fileInfo);
                }
                $nameOfUser = rtrim($line[0],"\r\n");
                $passwordOfUser = rtrim($line[1],"\r\n");

                if($username==$nameOfUser && $pass_code==$passwordOfUser){
                    $userExists=true;
                    $nameOfBlog=$blogDirectory;
                    fclose($fileInfo);
                }
        }            
    }

    if($userExists){
        do{
            $ID=sprintf("%02d", $unikalneId);
            $wpisFileName=$data.$godzina.$sekunda.$ID;
            $wpisPath="./".$nameOfBlog."/".$wpisFileName;
            $unikalneID++;
        }while(file_exists($wpisPath));

        $semaphore = sem_get(9999, 1, 0666, 1);
        sem_acquire($semaphore);
        
        $fileWpis = fopen($wpisPath, "w");
        fwrite($fileWpis, $wpis.PHP_EOL);
        fclose($fileWpis);

        sem_release($semaphore);

        print_r("Wpis dodano poprawnie!");

       
        $attachmentID=1;

        foreach($attachments as $attach) {           
            $attachmentFileExtension = pathinfo($attach['name'], PATHINFO_EXTENSION);
            $attachmentFileName = $data.$godzina.$sekunda.$ID.$attachmentID.".".$attachmentFileExtension;
            $attachmentPath = "./".$nameOfBlog."/".$attachmentFileName;

			if(file_exists($attachmentPath)){
				echo "Plik " . $attach['name'] . "juz istnieje! <br />";
			} else {
				if (move_uploaded_file($attach["tmp_name"], $attachmentPath)) {
					echo "Pomyślnie dodano plik " . $attach['name'] . "<br />";
				}
			}
			$attachmentID++;
		}        
    }else{
        
        print_r("Podałes niepoprawne dane!");
    }
    closedir($mainFolder);

?>