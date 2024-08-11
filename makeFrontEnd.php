<?php
/**
 * CRUD
 * Create, Read, Update and Delete
 */
class makeFrontEnd
{
    private $outputFile;
    private $tableName;
    public $coments;
    private $hostNameIP;
    private $userName;
    private $passWord;
    private $dbName;
    private $select;
    private $folder;

    function __construct() { 
    }

    function __destruct() { 
        $this->outputFile = null; 
        $this->tableName  = null; 
    }

    public function setHostNameIP($_hostIP) {
        $this->hostNameIP = $_hostIP;
    }

    public function setUserName($_userName) {
        $this->userName = $_userName;
    }

    public function setPassWord($_passWord) {
        $this->passWord = $_passWord;
    }

    public function setDbName($_dbName) {
        $this->dbName = $_dbName;
    }

    public function setFolder($_folder) {
        $this->folder = $_folder;
    }

    public function setTableName($_tableName) {
        $this->tableName = $_tableName;
        if (substr($this->tableName, 0, 3) == 'db_') {
            $this->tableName = str_replace('db_', '', $this->tableName);
        }
    }

    public function CreateSelect($_rsTable, $_class_name) {
        $rowsCols = count($_rsTable);
        $select = "$mySelect = 'SELECT ";

        for ($x = 0; $x < $rowsCols - 1; $x++) {
            $select .= $_rsTable[$x]->getTableNameCols() . ", ";
        }
        $select .= $_rsTable[$rowsCols - 1]->getTableNameCols();
        $select .= " FROM " . $_class_name . " WHERE ";
        $select .= $_rsTable[0]->getTableNameCols() . " = ' . $this->" . $_rsTable[0]->getTableNameCols() . "';";

        return $select;
    }

    public function makeDoIt() {
        $coments = chr(10) . "<!-- " . chr(10) .
            "   Programm: FrameWork Class Generator" . chr(10) .
            "   Objective: Make all PHP classes Object Oriented from database connection" . chr(10) .
            "              and after selected table or tables make UI class front-end too." . chr(10) .
            "   Author: Hélio Barbosa" . chr(10) .
            "   Every class will be generated in separate files." . chr(10) .
            "   GitHub: https://github.com/helioso/phpFrameWorkClass.git" . chr(10) .
            "   LinkedIn: https://br.linkedin.com/in/helio-barbosa-32718082" . chr(10) .
            "   Email: hflb01@gmail.com" . chr(10) .
            "   YouTube: https://www.youtube.com/user/1908HELIO" . chr(10) . "-->";

        $space3 = "&nbsp&nbsp&nbsp";
        $space6 = $space3 . $space3;

        if (file_exists($this->folder . "/" . $this->tableName . "_Front.php")) {
            unlink($this->folder . "/" . $this->tableName . "_Front.php");
        }

        $this->outputFile = $this->folder . "/" . $this->tableName . "_Front.php";
        $fp = fopen($this->outputFile, "a");

        $class_name = $this->tableName;
        $textClass = "<!DOCTYPE html>" . chr(10);
        $textClass .= $coments . chr(10) .
            "<html>" . chr(10) .
            "  <head>" . chr(10) .
            "      <script src='js/jquery.min.js'></script>" . chr(10) .
            "      <meta content='text/html; charset=ISO-8859-1' http-equiv='content-type'>" . chr(10) .
            "      <title>" . $this->tableName . "</title>" . chr(10) .
            "      <script src='js/jquery.min.js'></script>" . chr(10) .
            "      <link href='css/padrao.css' rel='stylesheet'>" . chr(10) .
            "  </head>" . chr(10) .
            "   <body>" . chr(10) .
            "      <div class='one'>" . chr(10) .
            "         " . $this->tableName . chr(10) .
            "      </div>" . chr(10) .
            "      <div class='two'>" . chr(10) .
            "         <p>" . chr(10) .
            "         <input class='input-one' type='button' id='ins' value='Insert' onclick='myClick(this," . chr(34) . $this->tableName . chr(34) . ")'></input>" . chr(10) .
            "         </p>" . chr(10) .
            "         <p>" . chr(10) .
            "         <input class='input-one' type='button' id='apd' value='Update' onclick='myClick(this," . chr(34) . $this->tableName . chr(34) . ")'></input>" . chr(10) .
            "         </p>" . chr(10) .
            "         <p>" . chr(10) .
            "         <input class='input-one' type='button' id='del' value='Delete' onclick='myClick(this," . chr(34) . $this->tableName . chr(34) . ")'></input>" . chr(10) .
            "         </p>" . chr(10) .
            "      </div>" . chr(10) .
            "      <div class='three' id='three'>" . chr(10);

        include_once('connection.php');
        $NewCon = new Conection();
        $NewCon->setHostNameIP($this->hostNameIP);
        $NewCon->setUserName($this->userName);
        $NewCon->setPassWord($this->passWord);
        $NewCon->setDbName($this->dbName);
        $NewCon->setTableName($this->tableName);
        $rsTableCols = $NewCon->Conect();
        if ($rsTableCols == 0) {
            $rsTableCols = $NewCon->listTableCols();
        }

        $rowsCols = count($rsTableCols);
        if ($rowsCols > 0) {
            $textClass .= "   <table border=1>" . chr(10);
            $textClass .= "   <tr>" . chr(10);
            $textClass .= "      <td>Chk</td>" . chr(10);
            for ($x = 0; $x < $rowsCols; $x++) {
                $textClass .= "      <td align='right'>" . $rsTableCols[$x]->getTableNameCols() . "</td>" . chr(10);
            }
            $textClass .= "   </tr>" . chr(10);
        }

        $select = "SELECT ";
        for ($x = 0; $x < $rowsCols - 1; $x++) {
            $select .= $rsTableCols[$x]->getTableNameCols() . ", ";
        }
        $select .= $rsTableCols[$rowsCols - 1]->getTableNameCols();
        $select .= " FROM " . $class_name . " WHERE 1=1";

        $textClass .= "      <?php" . chr(10);
        $textClass .= "         include('" . $this->tableName . ".php');" . chr(10);
        $textClass .= "         $" . "New" . $this->tableName . " = new " . $this->tableName . "();" . chr(10);
        $textClass .= "         $" . "rsRows = $" . "New" . $class_name . "->executeSQL_" . $class_name . "('" . $select . "');" . chr(10);
        $textClass .= "         $" . "z = 0;" . chr(10);
        $textClass .= "         while ($" . "row = mysqli_fetch_array($" . "rsRows))" . chr(10);
        $textClass .= "         {" . chr(10);
        $textClass .= "            $" . "z = $" . "z + 1;" . chr(10);
        $textClass .= "            echo(\"<tr>\");" . chr(10);

        // Assume the first column is the IndexKey of the table
        $textClass .= "            echo(\"<td align='left'><input type='radio' name='rd' id='$" . "z' value='\" . $" . "row['" . $rsTableCols[0]->getTableNameCols() . "'] . \"' onclick='myClick(this)'/></td>\");" . chr(10);

        for ($x = 0; $x < $rowsCols; $x++) {
            $textClass .= "            echo(\"<td align='left'>\" . $" . "row['" . $rsTableCols[$x]->getTableNameCols() . "'] . \"</td>\");" . chr(10);
        }
        $textClass .= "            echo(\"</tr>\");" . chr(10);
        $textClass .= "         }" . chr(10);
        $textClass .= "      ?>" . chr(10);
        $textClass .= "   </table>" . chr(10);
        $textClass .= "   </div>" . chr(10);
        $textClass .= "   <script type='text/javascript'>" . chr(10);
        $textClass .= "      function myClick(el, table) {" . chr(10);
        $textClass .= "         var value = el.value;" . chr(10);
        $textClass .= "         $.post('doIt.php', {'tableName': table, 'ID': value, 'Action': el.id}, function(data) {" . chr(10);
        $textClass .= "            $('#three').html(data);" . chr(10);
        $textClass .= "         });" . chr(10);
        $textClass .= "      }" . chr(10);
        $textClass .= "   </script>" . chr(10);
        $textClass .= "   </body>" . chr(10);
        $textClass .= "</html>" . chr(10);

        fwrite($fp, $textClass);
        fclose($fp);
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
