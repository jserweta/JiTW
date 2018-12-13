<?php
    session_start();
    include 'menu.php';
    $typeOfComment=$_POST["commentType"];
    $contentOfComment=$_POST["commentText"];
    $nameOfCommentator=$_POST["commentatorName"];
    $blogName=$_SESSION['blogName'];
    $numerWpisu=$_SESSION['numerWpisu'];

        //echo $blogName;
        //echo $numerWpisu;

    $blogDirectory = opendir("./".$blogName."/");
    if(!file_exists("./".$numerWpisu.".k")){
        mkdir("./".$blogName.$numerWpisu.".k",0755);
    }
    $commentFolderPath="./".$blogName.$numerWpisu.".k";
    $commentID=0;
    while(file_exists($commentFolderPath."/".$commentID)){
        $commentID++;
    }

    $commentFilePath=$commentFolderPath."/".$commentID;
    $commentFile=fopen($commentFilePath, 'w');

    fwrite($commentFile, $typeOfComment.PHP_EOL);
    fwrite($commentFile, date("Y-m-d").",".date('H:i:s').PHP_EOL);
    fwrite($commentFile, $contentOfComment.PHP_EOL);
    fwrite($commentFile, $nameOfCommentator.PHP_EOL);

    fclose($commentFile);

    closedir($blogDirectory);
?>
