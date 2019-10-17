<?php
	/**
   * CRUD
	 * Create, Read, Update and Delete
	 */
	class makeFrontEnd
	{
		
		private $outputFile ;
		private $tableName ;
		public  $coments ;
		Private $hostNameIP;
		Private $userName;
		Private $passWord;
		Private $dbName;
		Private $select;
    Private $folder;


    function __construct() { 
    } 
    function __destruct() { 
	    $this->outputFile = null; 
		  $this->tableName  = null; 
    }


    public function setHostNameIP($_hostIP){
       $this->hostNameIP = $_hostIP ;
    }
    public function setUserName($_userName){
       $this->userName = $_userName ;
    }
    public function setPassWord($_passWord){
       $this->passWord = $_passWord ;
    }
    public function setDbName($_dbName){
       $this->dbName = $_dbName ;
    }
    public function setFolder($_folder){
       $this->folder = $_folder ;
    }
    public function setTableName($_tableName){
       $this->tableName = $_tableName ;
       if(substr($this->tableName,0,3)=='db_')
       {
          $this->tableName = str_replace('db_' , '' , $this->tableName ) ;
       }
    }
    public function CreateSelect($_rsTable, $_class_name)
    {
        $rowsCols = count($_rsTable);
        $select = "$" ."mySelect = 'select ";
        for($x=0; $x < $rowsCols-1; $x++)
        {
          $select = $select .$_rsTable[$x]->getTableNameCols(). "," ;
        }
        $select = $select .$_rsTable[$rowsCols-1]->getTableNameCols()  ;
        $y = sizeof($rowsCols)-1 ;
        $select = $select .$rowsCols[ $y ] . " from ".$_class_name." where " ;
        $select = $select .$_rsTable[0]->getTableNameCols(). " = ' . $" . "this->" .$_rsTable[0]->getTableNameCols().";" ;
        return $select ;
    }

    public function makeDoIt()
    {
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
  		// $this->outputFile =  $this->folder ."/". $this->tableName ."_Front_". time("hms") .".php" ;
      if(file_exists($this->folder."/".$this->tableName."_Front.php"))
      {
        unlink($this->folder."/".$this->tableName."_Front.php") ;
      }
      $this->outputFile= $this->folder."/".$this->tableName."_Front.php" ;
  		$fp        = fopen($this->outputFile,"a");
    	$class_name= $this->tableName ;
	    $textClass = "<!DOCTYPE html>" . chr(10) ;
      $textClass = $textClass . $coments .chr(10) .
      "<html>" . chr(10) .
      "  <head>". chr(10) .
      "      <script src='js/jquery.min.js'></script>" . chr(10) .
      "      <meta content='text/html; charset=ISO-8859-1' http-equiv='content-type'>". chr(10) .
      "      <title>".$this->tableName."</title>". chr(10) .
      "      <script src='js/jquery.min.js'></script>". chr(10) .
      "      <link href='css/padrao.css' rel='stylesheet'>". chr(10) .
      "  </head>". chr(10) ;
      $textClass  = $textClass ."   <body>"  .chr(10) ;
      $textClass  = $textClass ."      <div class='one'>".chr(10)
                               ."         ".$this->tableName . chr(10) 
                               ."      </div>".chr(10) ;
      $textClass  = $textClass ."      <div class='two'>".chr(10); 
      $textClass  = $textClass ."         <p>".chr(10);
      $textClass  = $textClass ."         <input type='button' id='ins' value='Insert' onclick='myClick(this)'></input>".chr(10);
      $textClass  = $textClass ."         </p>".chr(10);
      $textClass  = $textClass ."         <p>".chr(10);
      $textClass  = $textClass ."         <input type='button' id='apd' value='Update' onclick='myClick(this)'></input>".chr(10);
      $textClass  = $textClass ."         </p>".chr(10);
      $textClass  = $textClass ."         <p>".chr(10);
      $textClass  = $textClass ."         <input type='button' id='del' value='Delete' onclick='myClick(this)'></input>".chr(10);
      $textClass  = $textClass ."         </p>".chr(10);
      $textClass  = $textClass ."      </div>".chr(10);

      $textClass  = $textClass ."      <div class='three' id='three'>".chr(10) ;

      include_once('connection.php');
      $NewCon = New Conection();
      $NewCon->setHostNameIP($this->hostNameIP);
      $NewCon->setUserName($this->userName);
      $NewCon->setPassWord($this->passWord);
      $NewCon->setDbName($this->dbName);
      $NewCon->settableName($this->tableName);
      $rsTableCols =  $NewCon->Conect();
      if($rsTableCols==0)
      {
        $rsTableCols =  $NewCon->listTableCols();
      }
      $rowsCols = count($rsTableCols);
      if($rowsCols>0)
      {

/*
JOGA ISSO EM UMA CHAMADA JSON
NO INICIO DO SCRIPT
TODA VEZ Q TIVER UAM ATUALIZAÇÃO FAZ UMA CHAMADA
$PDO->query();
*/
        $textClass = $textClass."   <table border=1>".chr(10) ;
        $textClass = $textClass."   <tr>".chr(10) ;
        $textClass = $textClass."      <td>Chk</td>".chr(10) ;
        for($x=0; $x < $rowsCols; $x++)
        {
          $textClass = $textClass."      <td aligh='rigth'>".$rsTableCols[$x]->getTableNameCols()."</td>".chr(10);  
        }
        $textClass = $textClass."   </tr>".chr(10) ;
      }

      $rowsCols = count($rsTableCols);
      $select = "select ";
      for($x=0; $x < $rowsCols-1; $x++)
      {
        $select = $select .$rsTableCols[$x]->getTableNameCols(). "," ;
      }
      $select = $select .$rsTableCols[$rowsCols-1]->getTableNameCols()  ;
      $y = sizeof($rowsCols)-1 ;
      $select = $select .$rowsCols[$y]." from ".$class_name." where 1=1" ;

      $textClass  = $textClass ."      <"."?php" . chr(10);
      $textClass  = $textClass ."         include('".$this->tableName.".php');".chr(10) ;
      $textClass  = $textClass ."         $"."New".$this->tableName. " = New ".$this->tableName."();".chr(10);

      $textClass  = $textClass ."         $"."rsRows = $"."New".$class_name."->executeSQL_".$class_name ."('".$select."');" . chr(10) ;
      $textClass  = $textClass."         $"."z=0;".chr(10);
      $textClass  = $textClass."         while ($"."row = mysqli_fetch_array($"."rsRows))".chr(10);
      $textClass  = $textClass."         {".chr(10);
      $textClass  = $textClass."            $"."z = $"."z+1;".chr(10);
      $textClass  = $textClass."            echo(".chr(34)."<tr>".chr(34).");".chr(10);

      // supose that col zero to be IndexKey of table
      $textClass  = $textClass."            echo(".chr(34)."<td aligh="."'left'><input type='radio' name='rd' id='$"."z' value='".chr(34).
        ".$"."row['".$rsTableCols[0]->getTableNameCols(). "'].".chr(34)."' onclick='myClick(this)'/>".
        "</td>".chr(34).");".chr(10) ;
      // supose that col zero to be IndexKey of table

      for($x=0; $x < $rowsCols; $x++)
      {
        $textClass  = $textClass."            echo(".chr(34)."<td aligh="."'left'>".chr(34).
        ".$"."row['".$rsTableCols[$x]->getTableNameCols(). "'].".chr(34)."</td>".chr(34).").chr(10);".chr(10) ;
      }
      $textClass  = $textClass."            echo(".chr(34)."</tr>".chr(34).");".chr(10);
      $textClass  = $textClass."         }".chr(10);
      $textClass  = $textClass."      ?".">".chr(10) ;
      $textClass  = $textClass."   <table>".chr(10) ;

      $textClass  = $textClass . "     </div>".chr(10) ;
      $textClass  = $textClass . "     <div class='four' id='four'></div>
" .chr(10) ;
      $textClass  = $textClass . "   </body>" .chr(10) ;

      $textClass  = $textClass . "<script type='text/javascript'>" .chr(10) ;
      $textClass  = $textClass . "   var NoRec = 0;".chr(10);
      $textClass  = $textClass . "   var flag  = '';".chr(10);
      $textClass  = $textClass . "   function myClick(myVal)".chr(10);
      $textClass  = $textClass . "   {".chr(10);
      $textClass  = $textClass . "      var zz = myVal.value;".chr(10);
      $textClass  = $textClass . "      switch(zz)".chr(10); 
      $textClass  = $textClass . "      {".chr(10); 
      $textClass  = $textClass . "         case 'Insert':".chr(10);
      $textClass  = $textClass . "            // Insert here ".chr(10); 
      $textClass  = $textClass . "            zz=0;".chr(10); 
      $textClass  = $textClass . "            NoRec = 0;".chr(10); 
      $textClass  = $textClass . "            flag  = 'Ins';".chr(10); 
      $textClass  = $textClass . "            url = '".$class_name."_i.php?rec=' + NoRec + '&f=Ins';".chr(10);
      $textClass  = $textClass . "            $.get(url, function(resposta){".chr(10);
      $textClass  = $textClass . "            ".
      "document.getElementById('four').innerHTML=resposta ;".chr(10);
      $textClass  = $textClass . "            },'html');".chr(10);

      $textClass  = $textClass . "            break;".chr(10); 
      $textClass  = $textClass . "         case 'Update':".chr(10);
      $textClass  = $textClass . "            // Update here".chr(10); 
      $textClass  = $textClass . "            flag  = 'Upd';".chr(10); 
      $textClass  = $textClass . "            url = '".$class_name."_i.php?rec=' + NoRec + '&f=Upd';".chr(10);
      $textClass  = $textClass . "            $.get(url, function(resposta){".chr(10);
      $textClass  = $textClass . "            ".
      "document.getElementById('four').innerHTML=resposta ;".chr(10);
      $textClass  = $textClass . "            },'html');".chr(10);
      $textClass  = $textClass . "            break;".chr(10); 

      $textClass  = $textClass . "         case 'Delete':".chr(10);
      $textClass  = $textClass . "            // Delete here".chr(10); 
      $textClass  = $textClass . "            flag  = 'Del';".chr(10); 
      $textClass  = $textClass . "            url = '".$class_name."_i.php?rec=' + NoRec + '&f=Del';".chr(10);
      $textClass  = $textClass . "            $.get(url, function(resposta){".chr(10);
      $textClass  = $textClass . "            ".
      "document.getElementById('four').innerHTML=resposta ;".chr(10);
      $textClass  = $textClass . "            },'html');".chr(10);
      $textClass  = $textClass . "            break;".chr(10); 

      $textClass  = $textClass . "         default:".chr(10);
      $textClass  = $textClass . "            NoRec = zz;".chr(10);
      $textClass  = $textClass . "            break;".chr(10); 
      $textClass  = $textClass . "      }".chr(10); 
      $textClass  = $textClass . "   }".chr(10); 
      $textClass  = $textClass."   function my2Click(myVal)" .chr(10) ;
      $textClass  = $textClass."   {" .chr(10) ;
      $textClass  = $textClass."      //here you need persit your datas!" .chr(10) ;

      $textClass  = $textClass."      params='';".chr(10);
      for($x=0; $x < $rowsCols; $x++)
      {
        $textClass  = $textClass."      params=params + '&p".$x."='+document.getElementById('x".$x."').value;" .chr(10) ;
      }

      $textClass  = $textClass."      //alert(myVal.value)" .chr(10) ;
      $textClass  = $textClass."      url = '".$class_name."_ii.php?rec=' + NoRec + '&f=' + flag + params;" .chr(10) ;
      $textClass  = $textClass."      $.get(url, function(resposta){" ;
      $textClass  = $textClass."         // alert(resposta);" .chr(10) ;
      $textClass  = $textClass."         document.getElementById('four').innerHTML=resposta ;" .chr(10);
      $textClass  = $textClass."      },'html');" . chr(10) ;
      $textClass  = $textClass."   }" .chr(10) ;
      $textClass  = $textClass . "</script>" .chr(10) ;

      $textClass  = $textClass . "</html>"    .chr(10) ;
      fwrite( $fp,$textClass.chr(10).chr(13) ) ;
      fclose( $fp ) ;

      /* makeing the interface */
      if(file_exists($this->folder."/".$this->tableName."_i.php"))
      {
        unlink($this->folder."/".$this->tableName."_i.php") ;
      }
      $this->outputFile= $this->folder."/".$this->tableName."_i.php" ;
      $fp        = fopen($this->outputFile,"a");
      $class_name= $this->tableName ;
      $textClass = chr(10) ;
      $textClass = $textClass."<"."?php".chr(10) ;
      $textClass = $textClass."   $"."recNo = $"."_GET['rec'];".chr(10);
      $textClass = $textClass."   $"."flag  = $"."_GET['f'] ;".chr(10);
      $textClass = $textClass."   include('".$class_name.".php');".chr(10);
      $textClass = $textClass."   $"."new".$this->tableName."= New ".$this->tableName."();".chr(10);

      $textClass = $textClass."   if($"."flag=='Ins')".chr(10);
      $textClass = $textClass."   {".chr(10);
      $textClass = $textClass."      $"."ret = $"."new". $this->tableName."->executeSQL_".$class_name."(".chr(34)."select ";
      for($x=0; $x < $rowsCols-1; $x++)
      {
        $textClass = $textClass."'', ";
      }
      $textClass = $textClass."''".chr(34).");".chr(10);

      $textClass = $textClass."   }else{".chr(10);

      $textClass = $textClass."      $"."ret = $"."new". $this->tableName."->executeSQL_".$class_name."('select ";
      for($x=0; $x < $rowsCols-1; $x++)
      {
        $textClass = $textClass.$rsTableCols[$x]->getTableNameCols().", ";
      }
      $textClass = $textClass.$rsTableCols[$rowsCols-1]->getTableNameCols()." from ". $this->tableName." where ".$rsTableCols[0]->getTableNameCols()."='.$"."recNo);".chr(10);
      $textClass = $textClass."   }".chr(10);



      $textClass  = $textClass."   while ($"."row = mysqli_fetch_array($"."ret))".chr(10);
      $textClass  = $textClass."   {".chr(10);
      $textClass  = $textClass."       ".chr(10);
      for($x=0; $x <= $rowsCols-1; $x++)
      {
        $textClass = $textClass."      $"."new".$this->tableName."->set".$rsTableCols[$x]->getTableNameCols()."($"."row['".$rsTableCols[$x]->getTableNameCols()."']);".chr(10);

        $textClass = $textClass."      echo(".chr(34).$rsTableCols[$x]->getTableNameCols().": <input type='text' id='x".$x."'value='".chr(34).".$"."row['".$rsTableCols[$x]->getTableNameCols()."'].".chr(34)."'></input></br>".chr(34).");".chr(10);

      }
      $textClass  = $textClass."   }".chr(10);

      $textClass  = $textClass."?>".chr(10);
      $textClass  = $textClass."<input type='button' id='b1' value='Upd' onclick='my2Click(this)'></input>".chr(10);
      $textClass  = $textClass."<input type='button' id='b2' value='Cancel' onclick='my2Click(this)'></input>".chr(10);

      $textClass = $textClass . "</html>" .chr(10) ;
      fwrite( $fp,$textClass.chr(10).chr(13) ) ;
      fclose( $fp ) ;

      /* makeing the persistent class */
      if(file_exists($this->folder."/".$this->tableName."_ii.php"))
      {
        unlink($this->folder."/".$this->tableName."_ii.php") ;
      }
      $this->outputFile= $this->folder."/".$this->tableName."_ii.php" ;
      $fp        = fopen($this->outputFile,"a");

      $this->outputFile= $this->folder."/".$this->tableName."_ii.php" ;
      $fp        = fopen($this->outputFile,"a");
      $class_name= $this->tableName ;
      $textClass = "<!DOCTYPE html>" . chr(10) ;
      $textClass = $textClass . $coments .chr(10) .
      $textClass = $textClass."<"."?php".chr(10) ;
      $textClass = $textClass."   $"."recNo = $"."_GET['rec'];".chr(10);
      $textClass = $textClass."   $"."flag  = $"."_GET['f'] ;".chr(10);
      for($xx=0; $xx<$x; $xx++)
      {
        $textClass = $textClass."   $"."p".$xx." = $"."_GET['p".$xx."'];".chr(10);
      }

      $textClass = $textClass."   include('".$class_name.".php');".chr(10);
      $textClass = $textClass."   $"."new".$this->tableName."= New ".$this->tableName."();".chr(10);


      for($xx=0; $xx<$x; $xx++)
      {
        $textClass = $textClass."   $"."new".$class_name."->set".$rsTableCols[$xx]->getTableNameCols()."($"."p".$xx.");".chr(10);

      }


      $textClass = $textClass."   if($"."flag=='Ins')".chr(10);
      $textClass = $textClass."   {".chr(10);
      $textClass = $textClass."      $"."newRecNo = $"."new".$class_name."->insert_".$class_name."();".chr(10);
      $textClass = $textClass."      echo $"."newRecNo ;".chr(10);
      $textClass = $textClass."   }".chr(10);

      $textClass = $textClass."   if($"."flag=='Upd')".chr(10);
      $textClass = $textClass."   {".chr(10);
      $textClass = $textClass."      $"."new".$class_name."->update_".$class_name."();".chr(10);
      $textClass = $textClass."   }".chr(10);

      $textClass = $textClass."   if($"."flag=='Del')".chr(10);
      $textClass = $textClass."   {".chr(10);
      $textClass = $textClass."      $"."new".$class_name."->delete_".$class_name."();".chr(10);
      $textClass = $textClass."   }".chr(10);

      $textClass = $textClass."?".">".chr(10) ;
      fwrite( $fp,$textClass.chr(10).chr(13) ) ;
      fclose( $fp ) ;

    }
  }
?>
<!-- 
https://www.w3schools.com/php/php_mysql_connect.asp
https://github.com/helhoso/PHPCodeGenerator  
http://localhost/helhosoFW/ 
http://localhost/dashboard/phpinfo.php
forum https://github.com/bjverde/formDin/issues/192
http://localhost/formDin/sysgen/
https://github.com/bjverde/sysgen/wiki/Do-Zero-at%C3%A9-Rodar

-->
