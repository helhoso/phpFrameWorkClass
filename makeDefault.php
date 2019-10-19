<?php

	class makeDefault
	{

		Private $folder;
		Private $outputFile;

		function __construct() 
		{
		}
		function __destruct() 
		{
		}
		function setfolder($_folder)
		{
			$this->folder = $_folder ;
		}

		public function makeClass($arrayMenuNames)
		{
			if(file_exists($this->folder."/default.php"))
			{
				unlink($this->folder."/default.php") ;
			}
			$this->outputFile=$this->folder."/default.php" ;
			$fileOut = fopen($this->outputFile,"a");
			$textoOut = "" ;
	  		$coments    = chr(10)."<!-- ".chr(10).
	  		"   Programm: FrameWork Class Generator" .chr(10). 
	  		"   Objective: Make all PHP classes Object Oriented from database conection" .chr(10).
	  		"              and after selected table or tables make ui class front-end too.".chr(10).
	  		"   Author: Hélio Barbosa" .chr(10). 
	  		"   Every classes will be generated in separated files." .chr(10). 
	  		"   GitHub: https:/". "/github.com/helhoso/phpFrameWorkClass.git" .chr(10).
	  		"   linkedin: https://br.linkedin.com/in/helio-barbosa-32718082" .chr(10).
	  		"   email: hflb01@gmail.com" .chr(10). 
	  		"   youtube: https://www.youtube.com/user/1908HELIO" .chr(10). "-->" ;
	    	$space3    = "&nbsp&nbsp&nbsp" ;
	    	$space6    = $space3 . $space3 ;
			$textoOut = "<!DOCTYPE html>" . chr(10) ;
			$textoOut = $textoOut . $coments .chr(10) .
			"<html>" . chr(10) .
			"  <head>". chr(10) .
			"      <script src='js/jquery.min.js'></script>" . chr(10) .
			"      <meta content='text/html; charset=ISO-8859-1' http-equiv='content-type'>". chr(10) .
			"      <title>Class Generator</title>". chr(10) .
			"      <script src='js/jquery.min.js'></script>". chr(10) .
			"      <link href='css/padrao.css' rel='stylesheet'>". chr(10) .
			"  </head>". chr(10) ;
			$textoOut  = $textoOut ."   <body>"  .chr(10) ;
			$textoOut  = $textoOut ."      <div class='one'>".chr(10)
			                       ."         Class Generator from MySQL DataBase Tables - Helio Barbosa - Brazil". chr(10) 
			                       ."      </div>".chr(10) ;

			$textoOut  = $textoOut ."      <div class='two'>".chr(10); 
			$textoOut  = $textoOut ."         <p>".chr(10);
			foreach($arrayMenuNames as $key => $value)
			{
				if(substr($value,0,3)=='db_')
				{
			    	$menuItem = str_replace('db_' , '' , $value ) ;
			    	//$textoOut = $textoOut  . "      <a href='".$menuItem."_Front.php'>".$menuItem."</a></br>".chr(10) ;

			    	$textoOut = $textoOut  . "<p>
	      <input class='input-one' type='button' length='50' value='".$menuItem."' name='btnWork' onclick='call_Item(this)'>
	      </input>
	    </p>".chr(10) ;



				}
			}
			$textoOut  = $textoOut ."         </p>".chr(10);
			$textoOut  = $textoOut ."      </div>".chr(10);

			$textoOut  = $textoOut ."      <div class='three' id='three'>".chr(10) ;
			$textoOut  = $textoOut ."         <!--  put code here  -->".chr(10) ;
			$textoOut  = $textoOut ."      </div>".chr(10) ;
			$textoOut  = $textoOut ."   </body>".chr(10) ;
			$textoOut  = $textoOut ."</html>".chr(10) ;
			$textoOut  = $textoOut ."<script type='text/javascript'>
".chr(10) ;
			$textoOut  = $textoOut ."   function call_Item(iRec)".chr(10);
			$textoOut  = $textoOut ."   {".chr(10);
			$textoOut  = $textoOut ."      //alert(iRec.value);".chr(10);
			// $textoOut  = $textoOut ."      document.getElementById('three').innerHTML = iRec.value;".chr(10);

			$textoOut  = $textoOut ."      url=iRec.value+'_Front.php'".chr(10);
			$textoOut  = $textoOut ."      $.get(url, function(resposta)".chr(10);
			$textoOut  = $textoOut ."      {".chr(10);
			$textoOut  = $textoOut ."         document.getElementById('three').innerHTML = resposta ;".chr(10);
			$textoOut  = $textoOut ."      ".chr(10);
			$textoOut  = $textoOut ."      ".chr(10);
			$textoOut  = $textoOut ."      },'html');".chr(10);

			$textoOut  = $textoOut ."   }".chr(10);
			$textoOut  = $textoOut ."</script>".chr(10);
			fwrite( $fileOut , $textoOut .chr(10) ) ;
			fclose( $fileOut ) ;
		}
	}
?>