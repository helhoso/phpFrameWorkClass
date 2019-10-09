<?php
    /* mysqli_connect(host, username, password, dbname, port, socket) */
	class Conection
	{
		Private $hostNameIP;
		Private $userName;
		Private $passWord;
		Private $dbName;
		Private $port;
		Private $socket;
		Private $conect ;
      Private $db_selected;
      Private $tableName;
      Private $tableNameCols;


      function __construct() { 
         $this->hostNameIP    = null; 
         $this->userName      = null; 
         $this->passWord      = null; 
         $this->dbName        = null ;
         $this->port          = null ;
         $this->socket        = null ;
         $this->conet         = null ;
         $this->tableName     = null ;
         $this->tableNameCols = null ;
      } 

      function __destruct() { 
         $this->hostNameIP    = null; 
         $this->userName      = null; 
         $this->passWord      = null; 
         $this->dbName        = null ;
         $this->port          = null ;
         $this->socket        = null ;
         $this->conet         = null ;
         $this->tableName     = null ;
         $this->tableNameCols = null ;
      }

      function setHostNameIP($_hostIP){
         $this->hostNameIP = $_hostIP ;
      }
      function setUserName($_userName){
         $this->userName = $_userName ;
      }
      function setPassWord($_passWord){
         $this->passWord = $_passWord ;
      }
      function setDbName($_dbName){
         $this->dbName = $_dbName ;
      }
      function setTableName($_tableName){
         $this->tableName = $_tableName ;
         if(substr($this->tableName,0,3)=='db_')
         {
            $this->tableName = str_replace('db_' , '' , $this->tableName ) ;
         }
      }
      function getTableName(){
         return $this->tableName ;
      }
      function setTableNameCols($_tableNameCols)
      {
         $this->tableNameCols = $_tableNameCols ;
      }
      function getTableNameCols()
      {
         return $this->tableNameCols ;
      }

      Function Conect(){

         $this->conet = mysqli_connect($this->hostNameIP, $this->userName, $this->passWord);
         if (!$this->conet){
            // return mysqli_error();
            return -1 ;
         } 

         $db_selected = mysqli_select_db( $this->conet , 'information_schema' );
       
         if (!$db_selected) {
            // return mysqli_error();
            return -1 ;
         }
         return 0 ;
      }

      function listTables()
      {
         $listaObjeto = Array();
         $id = -1;

         $mySql = "select TABLE_SCHEMA, TABLE_TYPE, TABLE_NAME from TABLES where TABLE_SCHEMA='".$this->dbName."' and TABLE_TYPE='BASE TABLE' ";
         $ret   =  mysqli_query( $this->conet , $mySql) ;
         while ($row = mysqli_fetch_array($ret)){
            $newRecord = new Conection() ;
            $newRecord->setTableName( $row["TABLE_NAME"] ) ;  
            $id++ ;
            $listaObjeto[$id] = $newRecord ; 
         }
         mysqli_close( $this->conet ) ;
         return $listaObjeto ;
      }

      function listTableCols()
      {
         $listaObjeto = Array();
         $id = -1;

         $mySql = "select TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME from COLUMNS where TABLE_SCHEMA='".$this->dbName."' and TABLE_NAME='".$this->tableName."'" ;

         $ret   =  mysqli_query( $this->conet , $mySql) ;
         while ($row = mysqli_fetch_array($ret)){
            $newRecord = new Conection() ;
            $newRecord->setTableNameCols( $row["COLUMN_NAME"] ) ;  
            $id++ ;
            $listaObjeto[$id] = $newRecord ; 
         }
         mysqli_close( $this->conet ) ;
         return $listaObjeto ;
      }
	}
?>

