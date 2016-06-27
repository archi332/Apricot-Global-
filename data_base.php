<?php

class data_base
{
    /**
     * @return mysqli
     */
    function connectBD()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '1111';
        $dbname = 'lifechat';

        $mysql_connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        return $mysql_connect;
    }

    /**
     * @return string
     */
    function loadMess()
    {
        $query = " SELECT * FROM chat_log ";
        $query .= " LEFT JOIN chat_users ";
        $query .= " ON chat_log.user_id = chat_users.id ";
        $query .= " ORDER BY chat_log.id ";
        return $query;
    }
}