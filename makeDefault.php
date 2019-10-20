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







      $textoOut  = $textoOut . "<script type='text/javascript'>" .chr(10) ;
      $textoOut  = $textoOut . "   var rowPosition = 0 ;".chr(10);
      $textoOut  = $textoOut . "   var NoRec = 0;".chr(10);
      $textoOut  = $textoOut . "   var flag  = '';".chr(10);
      $textoOut  = $textoOut . "   function myClick(myVal,fontName)".chr(10);
      $textoOut  = $textoOut . "   {".chr(10);
      $textoOut  = $textoOut . "      var zz = myVal.value;".chr(10);

      $textoOut  = $textoOut . "      if(zz!='Insert' && zz!='Update' && zz!='Delete' )".chr(10);
      $textoOut  = $textoOut . "      {".chr(10);
      $textoOut  = $textoOut . "         rowPosition = myVal.id ;  ".chr(10);
      $textoOut  = $textoOut . "      }".chr(10);

      $textoOut  = $textoOut . "      switch(zz)".chr(10); 
      $textoOut  = $textoOut . "      {".chr(10); 
      $textoOut  = $textoOut . "         case 'Insert':".chr(10);
      $textoOut  = $textoOut . "            // Insert here ".chr(10); 
      $textoOut  = $textoOut . "            zz=0;".chr(10); 
      $textoOut  = $textoOut . "            NoRec = 0;".chr(10); 

      $textoOut  = $textoOut . "            if(rowPosition!=0)".chr(10);
      $textoOut  = $textoOut . "            {".chr(10);
      $textoOut  = $textoOut . "               document.getElementById(rowPosition).checked = false ;".chr(10);
      $textoOut  = $textoOut . "               document.getElementById('four2').innerHTML='' ;".chr(10); 
      $textoOut  = $textoOut . "               rowPosition = 0 ;".chr(10);
      $textoOut  = $textoOut . "            }".chr(10);

      $textoOut  = $textoOut . "            flag  = 'Ins';".chr(10); 
      $textoOut  = $textoOut . "            url = fontName+'_i.php?rec=' + NoRec + '&f=Ins';".chr(10);
      $textoOut  = $textoOut . "            $.get(url, function(resposta){".chr(10);
      $textoOut  = $textoOut . "            ".
      "document.getElementById('four2').innerHTML=resposta ;".chr(10);
      $textoOut  = $textoOut . "            },'html');".chr(10);

      $textoOut  = $textoOut . "            break;".chr(10); 
      $textoOut  = $textoOut . "         case 'Update':".chr(10);
      $textoOut  = $textoOut . "            // Update here".chr(10); 

      $textoOut  = $textoOut . "            if(NoRec == 0)".chr(10); 
      $textoOut  = $textoOut . "            {".chr(10); 
      $textoOut  = $textoOut . "               alert('Select the record again, please!');".chr(10); 
      $textoOut  = $textoOut . "               document.getElementById('four2').innerHTML='';".chr(10); 
      $textoOut  = $textoOut . "               break;".chr(10); 
      $textoOut  = $textoOut . "            }".chr(10); 

      $textoOut  = $textoOut . "            flag  = 'Upd';".chr(10); 
      $textoOut  = $textoOut . "            url = fontName+'_i.php?rec=' + NoRec + '&f=Upd';".chr(10);
      $textoOut  = $textoOut . "            $.get(url, function(resposta){".chr(10);
      $textoOut  = $textoOut . "            ".
      "document.getElementById('four2').innerHTML=resposta ;".chr(10);
      $textoOut  = $textoOut . "            },'html');".chr(10);
      $textoOut  = $textoOut . "            break;".chr(10); 

      $textoOut  = $textoOut . "         case 'Delete':".chr(10);
      $textoOut  = $textoOut . "            // Delete here".chr(10); 

      $textoOut  = $textoOut . "            if(NoRec == 0)".chr(10); 
      $textoOut  = $textoOut . "            {".chr(10); 
      $textoOut  = $textoOut . "               alert('Select the record again, please!');".chr(10); 
      $textoOut  = $textoOut . "               document.getElementById('four2').innerHTML='';".chr(10); 
      $textoOut  = $textoOut . "               break;".chr(10); 
      $textoOut  = $textoOut . "            }".chr(10); 

      $textoOut  = $textoOut . "            flag  = 'Del';".chr(10); 
      $textoOut  = $textoOut . "            url = fontName+'_i.php?rec=' + NoRec + '&f=Del';".chr(10);
      $textoOut  = $textoOut . "            $.get(url, function(resposta){".chr(10);
      $textoOut  = $textoOut . "            ".
      "document.getElementById('four2').innerHTML=resposta ;".chr(10);
      $textoOut  = $textoOut . "            },'html');".chr(10);
      $textoOut  = $textoOut . "            break;".chr(10); 

      $textoOut  = $textoOut . "         default:".chr(10);
      $textoOut  = $textoOut . "            NoRec = zz;".chr(10);
      $textoOut  = $textoOut . "            break;".chr(10); 
      $textoOut  = $textoOut . "      }".chr(10); 
      $textoOut  = $textoOut . "   }".chr(10); 
      $textoOut  = $textoOut."   function my2Click(myVal,fontName)" .chr(10) ;
      $textoOut  = $textoOut."   {" .chr(10) ;
      $textoOut  = $textoOut."      //here you need persit your datas!" .chr(10) ;

      $textoOut  = $textoOut."      if(myVal.value=='Yes - Confirm')" .chr(10) ;
      $textoOut  = $textoOut."      {" .chr(10) ;

      $textoOut  = $textoOut."         params='';".chr(10);


      $textoOut  = $textoOut."         try{".chr(10);
      $textoOut  = $textoOut."         for( x=0 ; x<=200 ; x++ )".chr(10);
      $textoOut  = $textoOut."         {".chr(10);
      $textoOut  = $textoOut."            params= params + '&p' + x.toString() +'='+ ";$textoOut  = $textoOut."document.getElementById( 'x' + x.toString() ).value;".chr(10);
      $textoOut  = $textoOut."         }".chr(10);
      $textoOut  = $textoOut."         }catch{".chr(10);
      $textoOut  = $textoOut."         }".chr(10);
      $textoOut  = $textoOut."         //alert(params);".chr(10);

      $textoOut  = $textoOut."         //alert(myVal.value)" .chr(10) ;
      $textoOut  = $textoOut."         url = fontName+'_ii.php?rec=' + NoRec + '&f=' + flag + params;" .chr(10) ;
      $textoOut  = $textoOut."         $.get(url, function(resposta){" ;
      $textoOut  = $textoOut."            // alert(resposta);" .chr(10) ;
      $textoOut  = $textoOut."            document.getElementById('four2').innerHTML=resposta ;" .chr(10);
      $textoOut  = $textoOut."         },'html');" . chr(10) ;

      $textoOut  = $textoOut."      }else{" .chr(10) ;
      $textoOut  = $textoOut."         document.getElementById('four2').innerHTML='' ;" .chr(10) ;
      $textoOut  = $textoOut."      }" .chr(10) ;
      $textoOut  = $textoOut."   }" .chr(10) ;
      $textoOut  = $textoOut . "</script>" .chr(10) ;





			fwrite( $fileOut , $textoOut .chr(10) ) ;
			fclose( $fileOut ) ;
		}
	}
?>