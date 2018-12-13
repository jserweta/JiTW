<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>PHP - blog</title>
</head>
<body>
    <?php
        session_start();
        include 'menu.php';
        
        $blogName = "";
		if (isset($_GET['nazwa'])) {
            $blogName = $_GET['nazwa'];
            $_SESSION['blogName']=$blogName;
        }
        
        if ($blogName == "") {
         
            $mainFolder = opendir("./");
            echo "<ul>";
            while(false !== ($blogDirectory = readdir($mainFolder))){
                if($blogDirectory == "." || $blogDirectory == ".."){
                    continue;
                }elseif(is_dir($blogDirectory)){
                    $blogName=$blogDirectory;
                    echo "<li>".sprintf("<a href=\"blog.php?nazwa=%s\">%s</a>", $blogName, $blogName)."</li>";
                }            
            }
            echo"</ul>";       
        }else{
            
            $blogExists=false;
            $blogFolder = "./".$blogName."/";
            $_SESSION['blogName']=$blogName;
            if(file_exists($blogFolder)){
                
                $blogExists=true;
                $i=1;
//Plik info
                $fileInfo = fopen($blogName."/info", "r");
                echo "<h1><strong>Tytuł: </strong>".$blogName."</h1>";
                while(false !== ($line = fgets($fileInfo))) {
					if ($i == 1) {
						echo "<p><strong>Autor: </strong>".$line."</p>";
					}else if ($i == 3) {
						echo "<p>Opis: ".$line."</p>";
                    }
                    
					if ($i >= 4) {
						echo $line . "</br>";
					}
					$i++;
				}
                fclose($fileInfo);
//Wpisy       
            
                $open=opendir($blogFolder);

                while(false !== ($blogFiles = readdir($open))){
                    
                    if(!is_dir($blogFiles) && preg_match('/\\d{16}$/', $blogFiles)){
                        $year=substr($blogFiles,0,4);
                        $month=substr($blogFiles,4,2);
                        $day=substr($blogFiles,6,2);
                        $hour=substr($blogFiles,8,2);
                        $minute=substr($blogFiles,10,2);
                        $seconds=substr($blogFiles,12,2);
                        $fileWpis = fopen("./".$blogName."/".$blogFiles, "r"); 
                        echo "<h3>Wpis: ".$year."-".$month."-".$day."  ".$hour.":".$minute.":".$seconds."</h3>";
                        echo "<h4>Treść: </h4>";
                        while(false !== ($line = fgets($fileWpis))){
                            echo $line."</br>";
                        }
                        fclose($fileWpis);
                       

//Zalaczniki            
                    $new_open=opendir($blogFolder);
                        $pattern='/'.$blogFiles.'[1-3]/';
                        while(false !== ($File = readdir($new_open))){
                            if(preg_match($pattern,$File)){
                                echo sprintf("Dołączony plik: <a href=\"./%s/%s\">%s</a><br /> ", $blogName, $File, $File);
                            }
                        }
                        echo "<p><a href=\"komentarz_form.php\">Dodaj komentarz do wpisu</a></p>";                
                        
//Komentarze            
                        
                        if(file_exists($blogFolder.$blogFiles.".k")){
                            while(false !== ($commFile=readdir($blogFolder.$blogFiles.".k/"))){
                                if($commFile == "." || $commFile == ".."){
                                    continue;
                                }elseif(!is_dir($commFile)){
                                    $commentFile = fopen($commFile, 'r');
                                    $j = 1;
									while (($line = fgets($plikKomentarza)) !== false) {
										if ($j == 1) {
											echo "<strong>Typ komentarza: </strong>" . $line . "<br />";
										} else if ($j == 2) {
											echo "<strong>Data komentarza: </strong>" . $line . "<br />";
										} else if ($j == 3) {
											echo "<strong>Autor komentarza: </strong>" . $line . "<br />";
										} else if ($j >= 4) {
											echo $line . "<br />";
										}
										$j++;
									}
									fclose($commentFile);
                                }
                            }
                        }
                        
                    }
                }      
            }
            
            if(!$blogExists){
                echo "Blog o takiej nazwie nie istnieje! </br>";
            }
            
        }
        
        //if(isset($_SESSION['blogName']) && !empty($_SESSION['blogName'])){echo $_SESSION['blogName'];}else{echo "error blogname";}
        //if(isset($_SESSION['numerWpisu']) && !empty($_SESSION['numerWpisu'])){echo $_SESSION['numerWpisu'];}else{echo "error wpis nuemr";}
        closedir($open);
        closedir($new_open);
        closedir($mainFolder);
    ?> 
</body>
</html>