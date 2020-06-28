<?php

class Md_database extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//function for getting all global data
    public function globalData() {
        $globalData = array();

        $this->db->select('*');
        $this->db->from('settings');
        $result = $this->db->get();
        foreach ($result->result_array() as $value) {
            $global[$value['setting_name']] = $value['setting_value'];
        }
        return $global;
    }

    public function socialData() {
        $socialData = array();

        $this->db->select('*');
        $this->db->from('social');
        $result = $this->db->get();
        foreach ($result->result_array() as $value) {
            $socialData[$value['social_name']] = $value['social_value'];
            $socialData[$value['statusck']] = $value['status'];
        }
        return $socialData;
    }

//function for inserting data into database
    public function insertData($table, $data) {
        $this->db->insert($table, $data);
    }

//function for delete data into database
    public function deleteData($table, $condition) {
        $this->db->where($condition);
        $this->db->delete($table);
    }

//function for  data fetching data from database
    public function getData($table, $fields = '', $condition = '', $order_by = '', $limit = '') {

        $str_sql = '';
        if (is_array($fields)) {
#$fields passed as array
            $str_sql.=implode(",", $fields);
        } elseif ($fields != "") {
#$fields passed as string
            $str_sql .= $fields;
        } else {
            $str_sql .= '*';  #$fields passed blank
        }
        $this->db->select($str_sql);
        if (is_array($condition)) {  #$condition passed as array
            if (count($condition) > 0) {
                foreach ($condition as $field_name => $field_value) {
                    if ($field_name != '' && $field_value != '') {
                        $this->db->where($field_name, $field_value);
                    }
                }
            }
        } else if ($condition != "") { #$condition passed as string
            $this->db->where($condition);
        }
        if ($limit != ""){
            $this->db->limit($limit);#limit is not blank
        }
        if (is_array($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);  #$order_by is not blank
        } else if ($order_by != "") {
            $this->db->order_by($order_by);  #$order_by is not blank
        }
        $this->db->from($table);
            
#getting record from table name passed
        $query = $this->db->get();

        return $query->result_array();
    }

//function for updating data into database
    public function updateData($table, $data, $condition) {
        $this->db->where($condition);
        $this->db->update($table, $data);
        return true;
    }

 
}

?>
