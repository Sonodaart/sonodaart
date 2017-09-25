<?php
session_start();
$nome = htmlspecialchars($_POST['nome']);
if($nome!=""){
$_SESSION['nome'] = $nome;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Chat</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <script type="text/javascript">
            
        function invia_mess(mex){
                var http = new XMLHttpRequest(message);
                var url = "salva.php";
                http.open("GET", url+"?message="+mex+"&nome=<?php echo $_SESSION['nome'];?>", true);
                http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                                var response = http.responseText;  
                                document.getElementById("view").innerHTML = response;
                        }
                };
                http.send(null);    
    }
        
        function visualizzaconv(){
                var http = new XMLHttpRequest(message);
                var url = "visualizza.php";
                http.open("GET", url, true);
                http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                                var response = http.responseText;  
                                document.getElementById("view").innerHTML = response;
                                setTimeout("visualizzaconv()",2000);
                        }
                };
                http.send(null);    
    }
        </script>
    </head>
    <body onload="visualizzaconv();">
        <div id="view"></div>
        <div id="send">
            <input type="text" id="message" name="message" onsubmit="invia_mess(this.value); this.value='';">//input messaggio
            <input type="button" value="Invia" onclick="invia_mess(document.getElementById('message').value); document.getElementById('message').value='';">
        </div>
    </body>
</html>
