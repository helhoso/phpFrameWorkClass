<?php

	/**
	 * 
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
  		$this->outputFile = $this->tableName ."_Front_". time("hms") .".php" ;
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
        $textClass = $textClass."   <table border=1>".chr(10) ;
        $textClass = $textClass."   <tr>".chr(10) ;
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

      $textClass  = $textClass ."         $"."rsRows = $"."Newusuario->executeSQL_usuario('".$select."');" . chr(10) ;


      $textClass  = $textClass ."         while ($"."row = mysqli_fetch_array($"."rsRows))".chr(10);
      $textClass  = $textClass ."         {".chr(10);
      $textClass  = $textClass ."            echo(".chr(34)."<tr>".chr(34).");".chr(10);
      for($x=0; $x < $rowsCols; $x++)
      {
        $textClass  = $textClass ."          echo(".chr(34)."<td aligh="."'left'>".chr(34).
        ".$"."row['".$rsTableCols[$x]->getTableNameCols(). "'].".chr(34)."</td>".chr(34).");".chr(10) ;
      }
      $textClass  = $textClass ."            echo(".chr(34)."</tr>".chr(34).");".chr(10);
      $textClass  = $textClass ."         }".chr(10);
      $textClass  = $textClass ."      ?".">".chr(10) ;
      $textClass  = $textClass."   <table>".chr(10) ;

      $textClass  = $textClass . "     </div>".chr(10) ;
      $textClass  = $textClass . "   </body>" .chr(10) ;
      $textClass  = $textClass . "</html>"    .chr(10) ;

      fwrite( $fp,$textClass.chr(10).chr(13) ) ;
      fclose( $fp ) ;
    }
  }
?>
<!-- 
http://localhost/helhosoFW/ 
-->
