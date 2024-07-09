<?php 
class tintuc{
    function getTT() {
        $db = new Connect();
        $select='SELECT * FROM tintuc';
        $result = $db->getList($select);
        return $result;
    }
    function getTB() {
        $db = new Connect();
        $select='SELECT * FROM thongbao';
        $result = $db->getList($select);
        return $result;
    }
}
?>