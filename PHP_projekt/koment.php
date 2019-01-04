<?php
    include 'menu.php';
    $typeOfComment=$_POST["commentType"];
    $contentOfComment=$_POST["commentText"];
    $nameOfCommentator=$_POST["commentatorName"];

    if (isset($_GET['blogPostNumber'])) {
        $blogPostNumberGET = $_GET['blogPostNumber'];
    }
    

    $mainFolder = opendir("./");
    while(false !== ($blogDirectory = readdir($mainFolder))){
        
        if($blogDirectory == "." || $blogDirectory == ".."){
            continue;
        }elseif(is_dir($blogDirectory)){        
            $blogDirectory2 = opendir($blogDirectory);
            
            while(false !== ($xxx = readdir($blogDirectory2))){
                if($xxx == $blogPostNumberGET){
                    $blogName = $blogDirectory;
                }
            }
            closedir($blogDirectory2);   
        }            
    }
    closedir($mainFolder);

    $semaphore = sem_get(10000, 1, 0666, 1);
    sem_acquire($semaphore);
   
    $blogPath = opendir("./$blogName/");

    if(!file_exists("$blogPostNumberGET.k")){
        mkdir("./$blogName/$blogPostNumberGET.k",0755);
    }

    $commentFolderPath="./$blogName/$blogPostNumberGET.k";
    $commentID=0;
    while(file_exists("$commentFolderPath/$commentID")){
        $commentID++;
    }

    $commentFilePath=$commentFolderPath."/".$commentID;
    $commentFile=fopen($commentFilePath, 'w');

    fwrite($commentFile, $typeOfComment.PHP_EOL);
    fwrite($commentFile, date("Y-m-d").",".date('H:i:s').PHP_EOL);
    fwrite($commentFile, $contentOfComment.PHP_EOL);
    fwrite($commentFile, $nameOfCommentator.PHP_EOL);

    fclose($commentFile);
    closedir($blogPath);

    sem_release($semaphore);
?>