<?php

	/**
	 * 
	 */
	class WorkClass
	{
		
		private $outputFile ;
		private $tableName ;
		private $txt ;
		public  $coments ;
		Private $hostNameIP;
		Private $userName;
		Private $passWord;
		Private $dbName;
		Private $select;


      function __construct() { 
		$this->coments    = "/* ".chr(10).
		"   Programm: FrameWork Class Generator" .chr(10). 
		"   Objective: Gerar classes em PHP oritenado a objeto a partir de um arquivo texto sql" .chr(10).
		"   Autor: Hélio Barbosa" .chr(10). 
		"   Todas as classes serão criadas em um unico arquivo separe-as posteriormente" .chr(10). 
		"   GitHub: https:/". "/github.com/helhoso/FrameWorkClassGenerator.git" .chr(10).
		"   linkedin: https://br.linkedin.com/in/helio-barbosa-32718082" .chr(10).
		"   email: hflb01@gmail.com" .chr(10). 
		"   youtube: https://www.youtube.com/user/1908HELIO" .chr(10). "*/" ;
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


      public function makeDoIt()
      {
      	$space3    = "&nbsp&nbsp&nbsp" ;
      	$space6    = $space3 . $space3 ;
		$this->outputFile = $this->tableName . Date("ymd") . time("hms") .".TXT" ;
		$fp        = fopen($this->outputFile,"a");
      	$inicio    = false   ;
      	$final     = true    ;
      	$class_name= $this->tableName ;
      	$arrayProp = array() ;    
      	// echo ($this->outputFile . '</br>') ;
	    $textClass  = "" . chr(10) . chr(10);
	    $txt        = "";
	    $textClass  = $textClass . "<?php" ;
    	$textClass  = $textClass . "   class $class_name" . chr(10); 
    	$textClass  = $textClass . "   {" .chr(10) ;

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
			// $textClass  = $textClass . " [" . $rowsCols ."]" .chr(10) ;
    		/* proprerties */
			for($x=0; $x < $rowsCols; $x++)
			{
				$textClass  = $textClass . "      private $".$rsTableCols[$x]->getTableNameCols() . ";" . chr(10) ; 

			}

			$textClass  = $textClass . "      private $" ."records_found;" .chr(10) ;
			$textClass  = $textClass . "      private $" ."myCon; " . chr(10) . chr(10) ;

			/* set and get Methods */
			for($x=0; $x < $rowsCols; $x++)
			{
        		$textClass  = $textClass . 
        		"      function set" .$rsTableCols[$x]->getTableNameCols() .
        		"(". "$" . "_" .$rsTableCols[$x]->getTableNameCols() . ")" 
        		.chr(10). "      {" 
        		.chr(10). "         " . "$" ."this->" .$rsTableCols[$x]->getTableNameCols() . " = $" ."_" .$rsTableCols[$x]->getTableNameCols() . " ;" 
        		. "; " . chr(10) . "      }" 
        		. chr(10) ;
			}
		}

		$textClass  = $textClass . "       function __construct() " . chr(10). "       {".chr(10) ;
		$textClass  = $textClass . "           $" . "this->codigo=null;" .chr(10) ;
		$textClass  = $textClass . "           $" . "this->records_found=null;" .chr(10) ;
		$textClass  = $textClass . "       }" .chr(10) ;
		$textClass  = $textClass . "       function __destruct() " .chr(10). "       {" .chr(10) ;
		$textClass  = $textClass . "           $" . "this->codigo=null; " .chr(10) ;
		$textClass  = $textClass . "           $" . "this->records_found=null; " .chr(10) ;
		$textClass  = $textClass . "       }" .chr(10) ;

		/* provider a database conection */
        $textClass  = $textClass .
        "      function dataBaseAccess() " .chr(10).
        "      {" .chr(10).
        "          error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED); " . chr(10).
        "          // error_reporting(0);" .chr(10). 
        "          date_default_timezone_set('America/Recife');" .chr(10).
        "          // server conection " .chr(10).
        "          $"."this->myCon=mysqli_connect('localhost', 'userName', 'userPassword');".chr(10).
        "          $"."db_selected = mysqli_select_db( $"."this->myCon , 'dataBaseName here' );" .chr(10). 
        "          return; " .chr(10).
        "      }" .chr(10) .chr(10) ;

        // Insert record on Table
        $textClass = $textClass."      function insert_" .$class_name. "()".chr(10)."       {" .chr(10);

		$select = "$" ."mySelect = 'select ";
		for($x=0; $x < $rowsCols-1; $x++)
		{
			$select = $select .$rsTableCols[$x]->getTableNameCols(). "," ;
		}
		$select = $select .$rsTableCols[$rowsCols-1]->getTableNameCols()  ;
		$y = sizeof($rowsCols)-1 ;
		$select = $select .$rowsCols[ $y ] . " from ".$class_name." where " ;
		$select = $select .$rsTableCols[0]->getTableNameCols(). " = ' . $" . "this->" .$rsTableCols[0]->getTableNameCols() . ";" ;
		$textClass  = $textClass . "           $"."this->dataBaseAccess();". chr(10)  ;
		$textClass  = $textClass . "           ". $select .chr(10)  ;
		$textClass  = $textClass . "           $". "ret = mysqli_query($" ."this->myCon , $" . "mySelect);" .chr(10)  ;

        // $textClass  = $textClass . "           $". "numRows= mysqli_num_rows($" . "ret);  " .chr(10)  ;
        $textClass  = $textClass . "           if( $". "ret->num_rows>0 )"  .chr(10). "           {" .chr(10) ;
        $textClass  = $textClass ."               // record found " .chr(10) ;
        $textClass  = $textClass ."               mysqli_close( $". "this->myCon );"  .chr(10) ;
        $textClass  = $textClass ."               return -1; // record found  ".chr(10) ;
        $textClass  = $textClass ."           }else{" .chr(10) ;
        $textClass  = $textClass ."               // insert new record " .chr(10) ;

        $insert = "$" ."myInsert = 'insert into " . $class_name ." (";
		for($x=1 ; $x <= sizeof($rsTableCols)-1 ; $x++)
		{
			$insert = $insert .$rsTableCols[$x]->getTableNameCols(). "," ;
		}
		$y = sizeof($rsTableCols)-1 ;
		$insert = $insert .$rsTableCols[$y]->getTableNameCols(). ") values (" ;

		for($x=1 ; $x <= sizeof($rsTableCols)-2 ; $x++)
		{
			$insert = $insert ."$". "this->" . $rsTableCols[$x]->getTableNameCols(). "," ;
		}
		$y = sizeof($rsTableCols)-1 ;
		$insert = $insert ."$" ."this->".$rsTableCols[$y]->getTableNameCols().")';" ;
        $textClass  = $textClass ."               $insert" .chr(10) ;
        $textClass  = $textClass ."               $" . "ret = mysqli_query($" . "this->myCon , $". "myInsert);" .chr(10) ;
        $textClass  = $textClass ."               $" . "new_rec = mysqli_insert_id($" . "this->myCon);" .chr(10) ;
        $textClass  = $textClass ."               return $" . "new_rec; // if result 0 then error" .chr(10) ;
        $textClass  = $textClass ."           }" .chr(10) ;
        $textClass  = $textClass . "       }" .chr(10) .chr(10)  ;



        /* update record */
        $textClass  = $textClass . "       function update_" .$class_name. "()".chr(10) . "       {" .chr(10) ;

		$select = "$" ."mySelect = 'select ";
		for($x=0; $x < $rowsCols-1; $x++)
		{
			$select = $select .$rsTableCols[$x]->getTableNameCols(). "," ;
		}
		$select = $select .$rsTableCols[$rowsCols-1]->getTableNameCols()  ;
		$y = sizeof($rowsCols)-1 ;
		$select = $select .$rowsCols[ $y ] . " from ".$class_name." where " ;
		$select = $select .$rsTableCols[0]->getTableNameCols(). " = ' . $" . "this->" .$rsTableCols[0]->getTableNameCols() . ";" ;
		$textClass  = $textClass . "           $"."this->dataBaseAccess();". chr(10)  ;
		$textClass  = $textClass . "           ". $select .chr(10)  ;
		$textClass  = $textClass . "           $". "ret = mysqli_query($" ."this->myCon , $" . "mySelect);" .chr(10)  ;

		$textClass  = $textClass . "           $". "numRows = $" . "ret->num_rows;" .chr(10)  ;


        $textClass  = $textClass . "           if($". "numRows>0)"  .chr(10). "           {" .chr(10) ;
        $update = "$" ."myUpdae = 'update table " . $class_name  ;
		for($x=1 ; $x <= sizeof($rsTableCols)-2 ; $x++)
		{
			$update = $update  ." set ".$rsTableCols[$x]->getTableNameCols(). "=$" . "this->". $rsTableCols[$x]->getTableNameCols() . " , " ;
		}
		$y = sizeof($rsTableCols)-1 ;
		$update = $update . $rsTableCols[$y]->getTableNameCols() . "= $" . "this->".$rsTableCols[$y]->getTableNameCols()."  from ".$class_name." where " ;
		$update = $update . $rsTableCols[0]->getTableNameCols() . "=' . $" . "this->" .$rsTableCols[0]->getTableNameCols() ;

        $textClass  = $textClass . "               $update;"  .chr(10)  ;

        $textClass  = $textClass ."               $" ."ret_upd=mysqli_query( $". "this->myCon , $"."update);"  .chr(10) ;

        $textClass  = $textClass ."               if( $" ."ret_upd )" . chr(10) ;
        $textClass  = $textClass ."               {" . chr(10) ;
        $textClass  = $textClass ."                   mysqli_close( $". "this->myCon );"  .chr(10) ;
        $textClass  = $textClass ."                   return true; // sucesso" . chr(10) ;
        $textClass  = $textClass ."               }else{ " . chr(10) ;
        $textClass  = $textClass ."                   mysqli_close( $". "this->myCon );"  .chr(10) ;
        $textClass  = $textClass ."                   return false; // falha " . chr(10) ;
        $textClass  = $textClass ."               } " . chr(10) ;

        $textClass  = $textClass ."           }else{" .chr(10) ;
        $textClass  = $textClass ."               mysqli_close( $". "this->myCon );" .chr(10) ; 
        $textClass  = $textClass ."               return false; // falha na alteracao" .chr(10) ;
        $textClass  = $textClass ."           } " .chr(10) ;
        $textClass  = $textClass ."       } " .chr(10) ;




		$textClass  = $textClass . "    } // end of class " .chr(10) ; 
	    $textClass  = $textClass . "?>" .chr(10) ;
	    fwrite( $fp,$textClass.chr(10).chr(13) ) ;
		fclose( $fp ) ;
		$txt = str_replace('<?php' , '<<text>?php</text></br>' , $textClass ) ;
		$txt = str_replace(' ' , '&nbsp' , $txt ) ;
		$txt = str_replace(chr(10) , '</br>' , $txt ) ;
		$txt = str_replace('?>' , '<text></text>' , $txt ) ;
		echo $txt ;
      }

	}
?>