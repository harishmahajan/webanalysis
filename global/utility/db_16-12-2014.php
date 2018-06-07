<?php
/**
 * Created by Indrek Päri
 * Date: 16.01.14 10:57
 */

namespace Utility;
use PDO;

class Db
{
    private static $_dbHandle;

    private static function getDbHandle($_dbalet=false){
        global $_dbhost, $_dbuser, $_dbpass, $_dbname, $_dbalternativename;

        // do we need to use alternative database
        $dbindex = ($_dbalet ? $_dbalternativename : $_dbname);

        if(self::$_dbHandle[$dbindex] == null){

            self::$_dbHandle[$dbindex] = new PDO('mysql:host='.$_dbhost.';dbname='.$dbindex, $_dbuser, $_dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$_dbHandle[$dbindex]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $error = self::$_dbHandle[$dbindex]->errorInfo();
            if($error[0] != "00000") {
                print '<p>DATABASE CONNECTION ERROR:</p>';
                print_r($error);
            }
        }
        return self::$_dbHandle[$dbindex];
    }

    public static function closeConnection($_dbalet=false){
        global $_dbname, $_dbalternativename;

        // do we need to use alternative database
        $dbindex = ($_dbalet ? $_dbalternativename : $_dbname);

        if(self::$_dbHandle[$dbindex] != null){
            self::$_dbHandle[$dbindex] = null;
            unset(self::$_dbHandle[$dbindex]);
        }
    }

    /**
     * @param string $queryString
     * @param array $values
     *	PDO::PARAM_NULL (integer)
     *	PDO::PARAM_INT (integer)
     *	PDO::PARAM_STR (integer)
     * @param boolean $force_array
     * @param boolean $aletrnativeDB
     * @return object
     */
    public static function query($queryString, $values=array(), $force_array=false, $aletrnativeDB=false){

        $db = self::getDbHandle($aletrnativeDB);

        $sth = $db->prepare($queryString);
        if(isset($values[0]) and is_array($values[0]))
        {
            foreach ($values as $param )
            {
                $sth->bindParam(
                    $param[0],
                    $param[1],
                    ( $param[2] ? $param[2] : \PDO::PARAM_STR ),
                    ( $param[3] ? $param[3] : null),
                    ( $param[4] ? $param[4] : null)
                );
            }
            $result = $sth->execute();
        }
        else
        {
            $result = $sth->execute($values);
        }

        // skip insert, update and delete querys
        if ( !in_array(strtolower(substr(trim($queryString), 0, 6)), array('insert','update','delete')) ) {
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
        }

        if(count($result)==1 and $force_array != true)
            return $result[0];
        else
            return $result;
    }

    public static function array_of_values($sKey,$aVal)
    {
        $aReturn = array();
        foreach ($aVal as $oVal)
            $aReturn[] = $oVal->$sKey;
        return $aReturn;
    }

    public static function last_insert_id(){
        $row = self::query("SELECT LAST_INSERT_ID() as last_id");
        return $row->last_id;
    }

    public static function get_found_rows(){
        $row = self::query("SELECT FOUND_ROWS() as found_rows");
        return $row->found_rows;
    }

}