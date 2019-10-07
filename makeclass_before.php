<?php

  $hostIP    = $_GET['ip'];
  $user      = $_GET['user'];
  $password  = $_GET['pass'];
  $database  = $_GET['db'];

  // echo( $hostIP."</br>".$user."</br>".$password."</br>".$database."</br>" ) ;

  include_once("makeclass.php") ;
  $NewWork = New WorkClass() ;
  $NewWork->setHostNameIP($hostIP);
  $NewWork->setUserName($user);
  $NewWork->setPassWord($password);
  $NewWork->setDbName($database);

  $x = -1;
  foreach($_GET as $key => $value){
    // echo $key . " : " . $value . "<br />\r\n";
    // echo( "$x - $value <br />\r\n" ) ;
    if(substr($value,0,3)=='db_')
    {
      $NewWork->settableName( $value ) ;
      $NewWork->makeDoIt();
    }
  }

?>