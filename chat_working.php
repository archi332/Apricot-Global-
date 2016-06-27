<?php
include_once('data_base.php');

class chat_working
{

    function __construct()
    {
        $this->db = new data_base;
    }

    /**
     * @param $name
     * @return mixed
     */
    function getId($name)
    {

        $query = "SELECT * ";
        $query .= " FROM chat_users ";
        $query .= "WHERE name = '$name'";

        $id = mysqli_query($this->db->connectBD(), $query);

        while ($i = mysqli_fetch_row($id)){
            $id_user = $i['0'];
        }
    return $id_user;
    }

}