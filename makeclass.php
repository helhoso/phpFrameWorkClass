<?php

/**
 * 
 */
class WorkClass
{
    private $outputFile;
    private $tableName;
    private $txt;
    public $coments;
    private $hostNameIP;
    private $userName;
    private $passWord;
    private $dbName;
    private $select;
    private $folder;

    function __construct() { }

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
        $select = "$"."mySelect = 'SELECT ";
        for ($x = 0; $x < $rowsCols - 1; $x++) {
            $select .= $_rsTable[$x]->getTableNameCols() . ", ";
        }
        $select .= $_rsTable[$rowsCols - 1]->getTableNameCols();
        $select .= " FROM " . $_class_name . " WHERE ";
        $select .= " id = $". "id';";
        // echo($select);
        
        return $select;
    }
	
    public function makeDoIt() {
        $coments = chr(10) . "/* " . chr(10) .
            "   Programm: FrameWork Class Generator" . chr(10) .
            "   Objective: Make all PHP classes Object Oriented from database connection" . chr(10) .
            "              and after selected table or tables make ui class front-end too." . chr(10) .
            "   Author: Hélio Barbosa" . chr(10) .
            "   Every classes will be generated in separate files." . chr(10) .
            "   GitHub: https://github.com/helhoso/phpFrameWorkClass.git" . chr(10) .
            "   linkedin: https://br.linkedin.com/in/helio-barbosa-32718082" . chr(10) .
            "   email: hflb01@gmail.com" . chr(10) .
            "   youtube: https://www.youtube.com/user/1908HELIO" . chr(10) . "*/";

        $space3 = "&nbsp;&nbsp;&nbsp;";
        $space6 = $space3 . $space3;

        if (file_exists($this->folder . "/" . $this->tableName . ".php")) {
            unlink($this->folder . "/" . $this->tableName . ".php");
        }

        $this->outputFile = $this->folder . "/" . $this->tableName . ".php";
        $fp = fopen($this->outputFile, "a");

        $class_name = $this->tableName;
        $txt = "";
        $textClass = "<?php";
        $textClass .= $coments . chr(10) . chr(10);
        $textClass .= "class $class_name" . chr(10) . "{";

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
            /* properties */
            for ($x = 0; $x < $rowsCols; $x++) {
                $textClass .= "    private $" . $rsTableCols[$x]->getTableNameCols() . ";" . chr(10);
            }

            $textClass .= "    private "."$"."records_found;" . chr(10);
            $textClass .= "    private "."$"."myCon;" . chr(10) . chr(10);

            /* set and get Methods */
            for ($x = 0; $x < $rowsCols; $x++) {
                $textClass .= "    function set" . $rsTableCols[$x]->getTableNameCols() .
                    "($" . "_" . $rsTableCols[$x]->getTableNameCols() . ")" . chr(10) .
                    "    {" . chr(10) .
                    "        $" . "this->" . $rsTableCols[$x]->getTableNameCols() . " = $" . "_" . $rsTableCols[$x]->getTableNameCols() . ";" . chr(10) .
                    "    }" . chr(10);

                $textClass .= "    function get" . $rsTableCols[$x]->getTableNameCols() . "()" . chr(10) .
                    "    {" . chr(10) .
                    "        return $" . "this->" . $rsTableCols[$x]->getTableNameCols() . ";" . chr(10) .
                    "    }" . chr(10);
            }
        }

        $textClass .= "    function __construct()" . chr(10) .
            "    {" . chr(10) .
            "        //You can change this field 'codigo' for your IndexKey" . chr(10) .
            "        $" . "this->codigo = null;" . chr(10) .
            "        $" . "records_found = null;" . chr(10) .
            "    }" . chr(10);
        $textClass .= "    function __destruct()" . chr(10) .
            "    {" . chr(10) .
            "        $" . "this->codigo = null;" . chr(10) .
            "        $" . "records_found = null;" . chr(10) .
            "    }" . chr(10);

        /* provider a database connection */
        $textClass .= "    function dataBaseAccess()" . chr(10) .
            "    {" . chr(10) .
            "        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);" . chr(10) .
            "        // error_reporting(0);" . chr(10) .
            "        date_default_timezone_set('America/Recife');" . chr(10) .
            "        // server connection" . chr(10) .
            "        $" . "Con = mysqli_connect('localhost', '" . $this->userName . "', '" . $this->passWord . "');" . chr(10) .
            "        $" . "db_selected = mysqli_select_db($" . "Con, '" . $this->dbName . "');" . chr(10) .
            "        return $" . "Con;" . chr(10) .
            "    }" . chr(10) . chr(10);

        // Insert record on Table
        $textClass .= "    function insert_$class_name()" . chr(10) . "    {" . chr(10);
        $select = $this->CreateSelect($rsTableCols, $class_name);
        $textClass .= "        $" . "myCon = $class_name::dataBaseAccess();" . chr(10);
        $textClass .= "        " . $select . chr(10);
        $textClass .= "        $" . "ret = mysqli_query($" . "myCon, $" . "mySelect);" . chr(10);
        $textClass .= "        if ($" . "ret->num_rows > 0)" . chr(10) . "        {" . chr(10);
        $textClass .= "            // record found" . chr(10);
        $textClass .= "        }" . chr(10);
        $textClass .= "        else" . chr(10) . "        {" . chr(10);
        $textClass .= "            // no record found" . chr(10);
        $textClass .= "        }" . chr(10);
        $textClass .= "    }" . chr(10) . chr(10);

        /* save into file */
        fwrite($fp, $textClass);
        fclose($fp);
    }
}
?>
