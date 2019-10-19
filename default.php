<!DOCTYPE html>
<html>
  <head>
      <script src="js/jquery.min.js"></script>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
      <title>Class Generator</title>
      <link href="css/padrao.css" rel="stylesheet">
  </head>
		<?php
			// How do you can try the generated class
				/*
				include("usuario.php") ;
				$newU = New Usuario();
				$obj  = $newU->executeSQL_usuario("select * from usuario");
				echo count($obj) ."</br>";
				$obj2  = $newU->executeLike_usuario("NOME","ds");
				echo count($obj2) ."</br></br></br>";
				https://celke.com.br/artigo/tabela-de-cores-html-nome-hexadecimal-rgb
				*/
		?>
<body onload="toggleFullScreen()">

  <div class='one'>
    Class Generator from MySQL DataBase Tables - Helio Barbosa - Brazil
  </div>
  <div class='two'>
    <p>Server IP address
      <input type='text' id='ip' value=''></input>
    </p>
    <p>User name 
      <input type='text' id='user' value=''></input>
    </p>
    <p>Database password
      <input type='password' id='pass' value=''></input>
    </p>
    <p>Database name
      <input type='text' id='db' value=''></input>
    </p>
    <p>Folder to create files
      <input type='text' id='folder' value=''></input>
    </p>
    <p>
      <!--<input class='one' type="button" length="50" value="Acess" name="btnAcess" onclick="dbAcess()">
      </input>
    </p> -->
      <p>
        <button class="input-one" onclick="dbAcess()">Get Database</button>
      </p>
  </div>
  <div class='three' id='three'>
    <!-- 
      Here the code will be generated
    -->
  </div>
  <!--
  <div class='four' id='four'>
  </div>
  -->

  <!--
    <input type="button" value="clique para alternar" onclick="toggleFullScreen()">
  -->

</body>
</html>

<script type="text/javascript">
  function toggleFullScreen() 
  {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
      (!document.mozFullScreen && !document.webkitIsFullScreen)) {
      if (document.documentElement.requestFullScreen) {  
        document.documentElement.requestFullScreen();  
      } else if (document.documentElement.mozRequestFullScreen) {  
        document.documentElement.mozRequestFullScreen();  
      } else if (document.documentElement.webkitRequestFullScreen) {  
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
      }  
    } else {  
      /*
      if (document.cancelFullScreen) {  
        document.cancelFullScreen();  
      } else if (document.mozCancelFullScreen) {  
        document.mozCancelFullScreen();  
      } else if (document.webkitCancelFullScreen) {  
        document.webkitCancelFullScreen();  
      }
      */  
    }  
    document.getElementById("ip").value     = getCookie('ip');
    document.getElementById("user").value   = getCookie('user');
    document.getElementById("pass").value   = getCookie('pass');
    document.getElementById("db").value     = getCookie('db');
    document.getElementById("folder").value = getCookie('folder');
  }

  function dbAcess()
  {
    WriteToCooke();
    $listAll = '' ;
    url = "dbacess.php?ip="+document.getElementById("ip").value 
        +"&user="+document.getElementById("user").value
        +"&pass="+document.getElementById("pass").value
        +"&db="  +document.getElementById("db").value ;
    $.get(url, function(resposta){
        document.getElementById("three").innerHTML = resposta ;
    },"html");
  }

  $listAll = '' ;
  function selTable($x)
  {
    //alert($x.value);
    /* creat a list with table names */
    if( $x.checked==true )
    {
      $listAll = $listAll +'&'+ $x.id +'=db_'+ $x.value ;
    }else{
      $listAll = $listAll.replace( '&'+ $x.id +'=db_'+ $x.value , '' ) ;
    }
    // alert( $listAll ) ;
  }

  function ClassWork()
  {
    /* call the class generator */
    $listAll = $listAll.substring(1) ;
    url = "makeclass_before.php?" + $listAll ;
    url = url + "&ip="+document.getElementById("ip").value 
        +"&user="+document.getElementById("user").value
        +"&pass="+document.getElementById("pass").value
        +"&db="  +document.getElementById("db").value 
        +"&fold="+document.getElementById("folder").value ;
    $.get(url, function(resposta){
        document.getElementById("three").innerHTML = resposta ;
    },"html");
    // document.getElementById("three").style.display = "none";
    // document.getElementById("three").style.display = "block";
  }

</script>

<script>
  function WriteToCooke(){
    document.cookie="ip="    + document.getElementById("ip").value;
    document.cookie="user="  + document.getElementById("user").value;
    document.cookie="pass="  + document.getElementById("pass").value;
    document.cookie="db="    + document.getElementById("db").value;
    document.cookie="folder="+ document.getElementById("folder").value;
  }
  function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
  }

</script>