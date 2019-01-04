<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tworzenie Bloga</title>
</head>
<body>
        <?php
            include 'menu.php';
        ?>
        
    <h1>Założenie nowego bloga</h1>
    <form action="nowy.php" method="POST">
    
    Nazwa blogu:</br><input type="text" name="nazwa" /><br><br>
    Nazwa uzytkowika:</br><input type="text" name="user" /><br><br>
    Hasło:</br><input type="password" name="password" /><br><br>
    Opis bloga:</br>
    <textarea type="text" name="opis" rows="4" cols="50"></textarea></br></br>
    <input type="submit">
    <input type="reset">
    </form>

</body>
</html>