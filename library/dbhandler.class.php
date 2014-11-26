<?php
/**
 * An abstraction layer for the database connectivity
 */

class DBHandler
{
    protected $_dbHandle;
    protected $_result;

    /**
     * Connects to database
     *
     * @param $address
     * @param $account
     * @param $password
     * @param $name
     * @return int
     */
    public function connect($address, $account, $password, $name)
    {
        $this->_dbHandle = @mysql_connect($address, $account, $password);
        if($this->_dbHandle != 0) {
            if(mysql_select_db($name, $this->_dbHandle)) return 1;
            else return 0;
        } else return 0;
    }

    /**
     * disconnect from database
     *
     * @return int
     */
    public function disconnect()
    {
        if(@mysql_close($this->_dbHandle) != 0) return 1;
        else return 0;
    }

    /**
     * select all from model's table
     * @return mixed
     */
    public function selectAll()
    {
        $query = 'SELECT * FROM `' . $this->_table .'`';
        return $this->query($query);
    }

    /**
     * select chosen record from model's table
     * @param $id
     * @return mixed
     */
    public function select($id)
    {
        $query = 'SELECT * FROM `' . $this->_table . '` WHERE `id` = \'' . mysql_real_escape_string($id) . '\'';
        return $this->query($query, 1);
    }

    /**
     * @param $query
     * @param int $singleResult
     * @return array
     */
    public function query($query, $singleResult = 0)
    {
        $this->_result = mysql_query($query, $this->_dbHandle);

        if(preg_match("/select/i", $query)) {
            $result = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = mysql_num_fields($this->_result);

            for($i = 0; $i < $numOfFields; ++$i) {
                array_push($table, mysql_field_table($this->_result, $i));
                array_push($field, mysql_field_name($this->_result, $i));
            }

            while($row = mysql_fetch_row($this->_result)) {
                for($i = 0; $i < $numOfFields; ++$i) {
                    $table[$i] = trim(ucfirst($table[$i]), "s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if($singleResult == 1) {
                    mysql_free_result($this->_result);
                    return $tempResults;
                }
                array_push($result, $tempResults);
            }
            mysql_free_result($this->_result);
            return ($result);
        }
    }

    /**
     * get number of rows
     * @return int
     */
    public function getNumRows()
    {
        return mysql_num_rows($this->_result);
    }

    /**
     * Free resources allocated by a query
     */
    public function freeResult()
    {
        mysql_free_result($this->_result);
    }

    /**
     * get error string
     * @return string
     */
    public function getError()
    {
        return mysql_error($this->_dbHandle);
    }
}