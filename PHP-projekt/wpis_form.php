<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Wpis na blogu</title>
</head>
<body>
        <?php
            include 'menu.php';
        ?>
<h1>Dodanie nowego wpisu</h1>
    </br>
    <form action="wpis.php" method="POST" enctype="multipart/form-data">
        Nazwa użytkownika:</br><input type="text" name="user" /><br><br>
        Hasło:</br><input type="password" name="password" /><br><br>
        Wpis:</br>
        <textarea type="text" name="wpis" rows="4" cols="50"></textarea></br></br>
        Data dodania:</br><input type="text" name="data" value="<?php echo date("Y-m-d");?>"/></br></br>
        Godzina:</br><input type="text" name="godzina" value="<?php echo date('H:i');?>"/></br></br>
        Załącznik 1:</br><input type="file" name="file1"/></br>
        Załącznik 2:</br><input type="file" name="file2"/></br>
        Załącznik 3:</br><input type="file" name="file3"/></br></br>

        <input type="submit">
        <input type="reset" >
    </form>
</body>
</html>