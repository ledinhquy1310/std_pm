<?php
class diachi{
    function getTinh() {
        $db = new Connect();
        $select = "SELECT * FROM province";
        $result = $db->getList($select);
        return $result;
    }
    function getQuan() {
        $db = new Connect();
        $select = "SELECT * FROM district";
        $result = $db->getList($select);
        return $result;
    }
    function getXa() {
        $db = new Connect();
        $select = "SELECT * FROM wards";
        $result = $db->getList($select);
        return $result;
    }
    function getTinhbyId($province_id) {
        $db = new Connect();
        $select = "SELECT * FROM province WHERE province_id=$province_id";
        $result = $db->getInstance($select);
        return $result;
    }
    function getQuanbyTinh($province_id)  {
        $db = new Connect();
        $select = "SELECT * FROM district WHERE province_id = $province_id";
        $result = $db->getList($select);
        return $result;
    }
    function getQuanbyId($district_id) {
        $db = new Connect();
        $select = "SELECT * FROM district WHERE district_id=$district_id";
        $result = $db->getInstance($select);
        return $result;
    }
    function getXabyQuan($district_id) {
        $db = new Connect();
        $select = "SELECT * FROM wards WHERE district_id = $district_id";
        $result = $db->getList($select);
        return $result;
    }
    function getXabyId($wards_id) {
        $db = new Connect();
        $select = "SELECT * FROM wards WHERE wards_id=$wards_id";
        $result = $db->getInstance($select);
        return $result;
    }
}
?>