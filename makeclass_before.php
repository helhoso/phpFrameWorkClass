<?php

  $hostIP    = $_GET['ip'];
  $user      = $_GET['user'];
  $password  = $_GET['pass'];
  $database  = $_GET['db'];

  // echo( $hostIP."</br>".$user."</br>".$password."</br>".$database."</br>" ) ;


  /* Make the back-end classes */
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


  /* Make the front-end classes */
  include_once("makeFrontEnd.php") ;
  $NewFront = New makeFrontEnd() ;
  $NewFront->setHostNameIP($hostIP);
  $NewFront->setUserName($user);
  $NewFront->setPassWord($password);
  $NewFront->setDbName($database);

  $x = -1;
  foreach($_GET as $key => $value){
    // echo $key . " : " . $value . "<br />\r\n";
    // echo( "$x - $value <br />\r\n" ) ;
    if(substr($value,0,3)=='db_')
    {
      $NewFront->settableName( $value ) ;
      $NewFront->makeDoIt();
    }
  }



?>