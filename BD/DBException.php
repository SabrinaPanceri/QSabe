<?php
/**
 * Description of DBException
 *
 * @author Ciro
 */
class DBException extends Exception {

    private $_mysqlError;

    public function __construct($exceptionMessage, $mysqlError) {
        parent::__construct($exceptionMessage, 0);
        $this->_mysqlError = $mysqlError;
    }

    public function getMySQLError() {
        return $this->$_mysqlError;
    }
}
?>
