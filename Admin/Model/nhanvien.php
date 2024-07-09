<?php
include_once "connect.php";
class quanli
{
    function getAdmin($email, $pass)
    {
        $db = new connect();
        $select = "SELECT * from quanli where email='$email' and password='$pass'";
        $result = $db->getInstance($select);
        return $result;
    }
    function getQuanLi()
    {
        $db = new connect();
        $select = "SELECT * FROM quanli";
        $result = $db->getList($select);
        return $result;

    }
    function insertQuanLi($username, $email, $password)
    {
        $db = new connect();
        $insert = "INSERT INTO quanli (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = $db->exec($insert);
        return $result;
    }
    function deleteQuanLi($idql)
    {
        $db = new connect();
        $query = "DELETE FROM quanli WHERE idql = $idql";
        $result = $db->exec($query);
        return $result;
    }

    function updateQuanLi($idql, $username, $email, $password)
    {
        $db = new Connect();

        $update_query = "UPDATE quanli SET username='$username', email='$email', password='$password' WHERE idql=$idql";
        $result = $db->exec($update_query);
        return $result;
    }
    function getQuanLiById($idql)
    {
        $db = new connect();
        $select = "SELECT *FROM quanli
               WHERE quanli.idql = $idql";
        $result = $db->getInstance($select);
        return $result;
    }
    function checkEmail($email)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total From quanli where email='$email'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function checkEmail_edit($email,$email_now)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total From quanli where email='$email' AND email <> '$email_now'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }

    function checkpasswordbyid($pass,$idql)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total From quanli where password='$pass' and idql='$idql'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    
}
?>