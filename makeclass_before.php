<?php

  $hostIP    = $_GET['ip'];
  $user      = $_GET['user'];
  $password  = $_GET['pass'];
  $database  = $_GET['db'];
  $folder    = $_GET['fold'];


  /* Make the back-end classes */
  include_once("makeclass.php") ;
  $NewWork = New WorkClass() ;
  $NewWork->setHostNameIP($hostIP);
  $NewWork->setUserName($user);
  $NewWork->setPassWord($password);
  $NewWork->setDbName($database);
  $NewWork->setFolder($folder);
  foreach($_GET as $key => $value){
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
  $NewFront->setFolder($folder);

  foreach($_GET as $key => $value){
    if(substr($value,0,3)=='db_')
    {
      $NewFront->settableName( $value ) ;
      $NewFront->makeDoIt();
    }
  }

  /* Create a default.php with itens liked */
  include_once("makeDefault.php");
  $NewDefaullt = New makeDefault();
  $NewDefaullt->setfolder($folder);
  $NewDefaullt->makeClass($_GET);

?>