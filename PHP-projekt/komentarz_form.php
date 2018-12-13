<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Kometarz</title>
</head>
<body>
        <?php
            include 'menu.php';       
        ?>

<h1>Dodanie komentarza</h1>
    </br>
    <form action="koment.php" method="POST">
        Wybierz rodzaj komentarza: 
        <select name="commentType">
            <option>Pozytywny</option>
            <option>Neutralny</option>
            <option>Negatywny</option>
	    </select></br></br>
        Opinia:<br><textarea type="text" name="commentText" rows="4" cols="50"></textarea></br></br>
        Imię/Nazwisko/Pseudonim: <input type="text" name="commentatorName" /></br></br>
        <input type="submit">
        <input type="reset">
    </form>

</body>
</html>