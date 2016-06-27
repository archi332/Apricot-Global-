<?php
include_once('data_base.php');

class auth
{
    function __construct()
    {
        $this->db = new data_base;
    }

    /**
     * @return null or var errors
     */
    function validation_errors()
    {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $max = 10;
        $min = 3;
        $error = null;
        if (!$this->has_presence($name)) {
            $error['presence'] = 'There is no data in a field';
        }
        if (!$this->length_max($name, $max)) {
            $error['max length'] = 'Legth is bigger them max! Insert less than ' . $max . ' chars.';
        }
        if (!$this->length_min($name, $min) && $this->has_presence($name)) {
            $error['min length'] = 'Legth is less them min! Enter at least ' . $min . ' chars.';
        }
        return $error;
    }

    /**
     * @param $value
     * @return bool
     */
    function has_presence($value)
    {
        return isset($value) && $value !== "";
    }

    /**
     * @param $value
     * @param $max
     * @return bool
     */
    function length_max($value, $max)
    {
        return strlen($value) <= $max;
    }

    /**
     * @param $value
     * @param $min
     * @return bool
     */
    function length_min($value, $max)
    {
        return strlen($value) >= $max;
    }

    /**
     * @return string
     */
    function getPostParam()
    {
        return (isset($_POST['name'])) ? trim($_POST['name']) : '';

    }

    /**
     * @return string
     */
    function getSubmited()
    {
        return (isset($_POST['Submit'])) ? $_POST['Submit'] : '';

    }

    /**
     * @return void
     * print errors of auth form
     */
    function errors_view()
    {
        if ($this->getSubmited()) {
            echo "<H3>Please write in login without following errors:</H3>";

            foreach ($this->validation_errors() as $value) {
                echo $value . '<br />';
            }
        }
    }

    /**
     * @return void
     */
    function user()
    {
        if ($this->validation_errors() == null) {

            //  let's add user to database & activate cookies. and then redirect to chat page!

            $data_usr = mysqli_query($this->db->connectBD(), $this->check_user_db());

            if ($is = mysqli_fetch_array($data_usr)) {
                //  just write into cookies
                $this->set_user_cookie();
                header('Location: ' . $this->getUrl('chat.php'));

            } else {
                //  write into db and cookies
                mysqli_query($this->db->connectBD(), $this->add_user_db());
                echo $this->add_user_db();
                $this->set_user_cookie();
                header('Location: ' . $this->getUrl('chat.php'));
            }

        } else {
            //  There are some validation errors, let's view them
            $this->errors_view();
        }
    }


    /**
     * @return string
     */
    function add_user_db()
    {
        $name = $this->getPostParam();
        $name = htmlspecialchars($name);
        $query = 'INSERT INTO chat_users ( ';
        $query .= 'name';
        $query .= ' ) VALUES ( ';
        $query .= " '$name' ";
        $query .= ' ) ';
        return $query;
    }

    /**
     * @return string
     */
    function check_user_db()
    {
        $name = $this->getPostParam();
        $query = "SELECT * ";
        $query .= " FROM chat_users ";
        $query .= "WHERE name = '$name'";

        return $query;
    }

    /**
     * @return void
     */
    function set_user_cookie()
    {
        $name = 'checked';
        $value = $this->getPostParam();
        $expire = time() + (60 * 60 * 24);
        setcookie($name, $value, $expire);
    }

    /**
     * @param $where
     * @return string
     */
    function getUrl($where)
    {
        $url = 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= $_SERVER['REQUEST_URI'];
        $url .= $where;
        return $url;
    }

    /**
     * @return void
     */
    function log_out()
    {
        $name = 'checked';
        $value = null;
        $expire = time() - (60 * 60 * 24);
        setcookie($name, $value, $expire);
        header('Location: ' . $this->getUrl());
    }
}