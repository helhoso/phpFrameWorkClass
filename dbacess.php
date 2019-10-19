<?php

	$hostIP    = $_GET['ip']  ;
	$user      = $_GET['user'];
	$password  = $_GET['pass'];
	$database  = $_GET['db']  ;

	include_once('connection.php') ;
	$NewCon = New Conection();
	$NewCon->setHostNameIP($hostIP);
	$NewCon->setUserName($user);
	$NewCon->setPassWord($password);
	$NewCon->setDbName($database);
	$rsTables =  $NewCon->Conect() ; // return a RecordSet with a list of tables
	if($rsTables==0)
	{
		$rsTables =  $NewCon->listTables();
	}
	$rowsTable = count($rsTables);
	if($rowsTable>0)
	{
		echo( "<form id='makeclass_before.php'>") ;
		echo("<p>Select table(s) that you want to make class</br>") ;

		/* try to implement select all */
		//echo( '! - ') ;
		//echo( "<input type='checkbox' name='all_' id='all_' value='all_' onclick='selTable(this)'> Select All </input><br>" ) ;

		for($x=0; $x < $rowsTable; $x++)
		{
			echo( $x . ' - ') ;
			echo( "<input type='checkbox' name='tb_".$rsTables[$x]->getTableName()
				."' id='".$rsTables[$x]->getTableName()
				."' value='". $rsTables[$x]->getTableName() 
				."' onclick='selTable(this)'> ".$rsTables[$x]->getTableName() . "<br>" ) ;
		}
	    echo ("<p>
	      <input class='input-one' type='button' length='50' value='Work' name='btnWork' onclick='ClassWork()'>
	      </input>
	    </p>" );
		echo( '</form>') ;
	}
?>
