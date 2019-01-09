<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Wpis na blogu</title>
    <script type="text/javascript">

        function ustawAktualnyDataCzas(){
            ustawAktualnyCzas();
            ustawAktualnyData();
        }

        function ustawAktualnyData(){
            var dzis = new Date;
            var dzien = dzis.getDate();
            var miesiac = dzis.getMonth() + 1;
            var rok = dzis.getFullYear();
            
            if (miesiac<10) {miesiac = "0"+miesiac;}
            if (dzien<10) {dzien = "0"+dzien;}
            
            document.getElementById("dateINPUT").value = rok+"-"+miesiac+"-"+dzien;
        }
        function ustawAktualnyCzas(){
            var today = new Date;
            var godzina = today.getHours();
            var minuta = today.getMinutes();

            if (godzina<10) {godzina = "0"+godzina;}
            if (minuta<10) {minuta = "0"+minuta;}

            document.getElementById("timeINPUT").value = godzina+":"+minuta;
        }

        
        function sprawdzPoprawnoscDaty(){
            var date = document.getElementById("dateINPUT");
            var wprowadzonaData = date.value;
            var datePattern = /^\d{4}\-\d{2}\-\d{2}$/;
            
            if(!datePattern.test(wprowadzonaData)) {
                ustawAktualnyData();
            }else{
                var cuttedDate = wprowadzonaData.split('-');
                var isDateCorrect = true;
                
                if(cuttedDate[0]<0 || cuttedDate[0]>2100){
                    isDateCorrect = false;
                }    
                if(cuttedDate[1]<0 || cuttedDate[1]>12){
                    isDateCorrect = false;
                }
                if(cuttedDate[2]<0 || cuttedDate[2]>31){
                    isDateCorrect = false;
                }
                    
                if(!isDateCorrect){
                    ustawAktualnyData();
                } 
            }

        }

        function sprawdzPoprawnoscGodziny(){
            var time = document.getElementById("timeINPUT");
            var wprowadzonyCzas = time.value;
            var timePattern = /^\d{2}\:\d{2}$/;

            if(!timePattern.test(wprowadzonyCzas)) {
                ustawAktualnyCzas();
            }else{
                var cuttedTime = wprowadzonyCzas.split(':');
                var isTimeCorrect = true;

                if(cuttedTime[0]<0 || cuttedTime[0]>23){
                    isTimeCorrect = false;
                } 
                if(cuttedTime[1]<0 || cuttedTime[1]>59){
                    isTimeCorrect = false;
                }

                if(!isTimeCorrect){
                    ustawAktualnyCzas();
                }      
            }
        }
 
        function usunPusteZalaczniki(){
            var element = document.getElementById("attachments");
            var c = element.childNodes.length;
          
            for(i=c-1; i>4; i--){
                element.removeChild(element.childNodes[i]);
            }
        }

        var inputFieldNumber=1;
        function dodatkowyZalacznik(x){
            if(x.name == "file"+inputFieldNumber) {
                ++inputFieldNumber;
                var input = document.createElement("input");
                input.setAttribute("type", 'file');
                input.setAttribute("id", 'file');
                input.setAttribute("name", 'file' + inputFieldNumber);
                input.setAttribute("onchange", "dodatkowyZalacznik(this)");
                
                var element = document.getElementById("attachments");
                element.appendChild(input).outerHTML+='<br/>';
		    }
        }
        
    </script>

</head>

<body onload="ustawAktualnyDataCzas()">
        <?php
            include 'menu.php';
        ?>
<h1>Dodanie nowego wpisu</h1>
    </br>
    <form action="wpis.php" name="form1" method="POST" enctype="multipart/form-data">
        Nazwa użytkownika:</br><input type="text" name="user" /><br><br>
        Hasło:</br><input type="password" name="password" /><br><br>
        Wpis:</br>
        <textarea type="text" name="wpis" rows="4" cols="50"></textarea></br></br>
        
        Data dodania:</br><input type="text" id="dateINPUT" onblur="sprawdzPoprawnoscDaty()"/></br></br>
        
        Godzina:</br><input type="text" id="timeINPUT" onblur="sprawdzPoprawnoscGodziny()"/></br></br>
        
        <div id="attachments">
        Załączniki:</br><input type="file" id="file1" name="file1" onchange="dodatkowyZalacznik(this)"/></br>
        </div>
       
        <input type="submit">
        <input type="reset" onclick="usunPusteZalaczniki()" >
    </form>

    
</body>
</html>