<?php
class hedaotao
{
    function getHeDaoTao()
    {
        $db = new connect();
        $select = "SELECT * FROM hedaotao";
        $result = $db->getList($select);
        return $result;
    }

    public function getHeDaoTaoById($idhdt)
    {
        $db = new connect();
        $select = "SELECT * FROM hedaotao WHERE idhdt = $idhdt";
        $result = $db->getList($select);
        return $result->fetch();
    }

    function insertHeDaoTao($tenhdt, $mahdt)
    {
        $db = new connect();
        $select = "INSERT INTO hedaotao (tenhdt,mahdt) VALUES ('$tenhdt','$mahdt')";
        $result = $db->exec($select);
        return $result;
    }

    function deleteHeDaoTao($idhdt)
    {
        $db = new connect();
        $query = "DELETE FROM hedaotao WHERE idhdt = $idhdt";
        $result = $db->exec($query);
        return $result;
    }

    function updateHeDaoTao($idhdt, $tenhdt, $mahdt)
    {
        $db = new Connect();

        $update_query = "UPDATE hedaotao SET tenhdt='$tenhdt',mahdt='$mahdt' WHERE idhdt=$idhdt";
        $result = $db->exec($update_query);
        return $result;
    }

    public function countHeDaoTao()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM hedaotao";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
}
?>