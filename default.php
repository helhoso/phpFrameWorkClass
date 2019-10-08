<!DOCTYPE html>
<html>
  <head>
      <script src="js/jquery.min.js"></script>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
      <title>Class Generator</title>
      <script src="js/jquery.min.js"></script>
      <link href="css/padrao.css" rel="stylesheet">
  </head>

<body onload="toggleFullScreen()">

  <!-- http://localhost/helhosoFW/ -->
  <div class='one'>
    Class Generator from MySQL DataBase Tables - Helio Barbosa - Brazil
  </div>
  <div class='two'>
    <p>Server IP address
      <input type='text' id='ip' value='localhost'></input>
    </p>
    <p>User name 
      <input type='text' id='user' ></input>
    </p>
    <p>Database password
      <input type='password' id='pass' ></input>
    </p>
    <p>Database name
      <input type='text' id='db' ></input>
    </p>
    <p>
      <input type="button" length="50" value="Acess" name="btnAcess" onclick="dbAcess()">
        Get Database
      </input>
    </p>
  </div>
  <div class='three' id='three'>
    <!-- 
      Here the code will be generated
    -->
  </div>

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
  }

  function dbAcess()
  {
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
        +"&db="  +document.getElementById("db").value ;
    $.get(url, function(resposta){
        document.getElementById("three").innerHTML = resposta ;
    },"html");
  }

</script>
