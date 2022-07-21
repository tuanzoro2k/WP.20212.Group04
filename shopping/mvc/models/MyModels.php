<?php
class MyModels extends Database
{
    function select_array($data = '*', $where = NULL, $orderby = NULL, $start = NULL, $limit = NULL)
    {
        $sql = "SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $isFields = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
            for ($i = 0; $i < count($fields); $i++) {
                preg_match('/<=|>=|<|>|!=/', $fields[$i], $matches, PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                    $string_Caculator = $matches[0][0];
                }
                if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields = false;
                $sql .= "  " . $stringWhere . " " . preg_replace('/<=|>=|<|>|!=/', '', $fields[$i]) . " " . $string_Caculator . " ? ";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        } else {
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function add($data = NULL)
    {
        $fields = array_keys($data);
        $fields_list = implode(",", $fields);
        $values = array_values($data);
        $qr = str_repeat("?,", count($fields) - 1);
        $sql = "INSERT INTO `" . $this->table . "`(" . $fields_list . ") VALUES (${qr}?)";
        $query = $this->conn->prepare($sql);
        if ($query->execute($values)) {
            return json_encode(
                array(
                    'type'      => 'sucessFully',
                    'Message'   => 'Insert data success',
                    'id'        => $this->conn->lastInsertId()
                )
            );
        } else {
            return json_encode(
                array(
                    'type'      => 'fails',
                    'Message'   => 'Insert data fails',
                )
            );
        }
    }
    function update($data = NULL, $where = NULL)
    {
        if ($data != NULL && $where != NULL) {
            $fields = array_keys($data);
            $values = array_values($data);
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $sql = "UPDATE $this->table SET ";
            $isFields = true;
            $isFields_where = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
            for ($i = 0; $i < count($fields); $i++) {
                if (!$isFields) {
                    $sql .= ", ";
                }
                $isFields = false;
                $sql .= "" . $fields[$i] . " =?";
            }
            for ($i = 0; $i < count($where_array); $i++) {
                preg_match('/<=|>=|<|>/', $where_array[$i], $matches, PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                    $string_Caculator = $matches[0][0];
                }
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "  " . $stringWhere . " " . preg_replace('/<=|>=|<|>/', '', $where_array[$i]) . " " . $string_Caculator . " '" . $value_where[$i] . "'";
            }
            $query = $this->conn->prepare($sql);
            if ($query->execute($values)) {
                return json_encode(
                    array(
                        'type'      => 'sucessFully',
                        'Message'   => 'Update data success',
                    )
                );
            } else {
                return json_encode(
                    array(
                        'type'      => 'fails',
                        'Message'   => 'Update data fails',
                    )
                );
            }
        }
    }
    function delete($where = NULL)
    {
        $sql = "DELETE FROM  $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
            for ($i = 0; $i < count($where_array); $i++) {
                preg_match('/<=|>=|<|>/', $where_array[$i], $matches, PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                    $string_Caculator = $matches[0][0];
                }
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" . $stringWhere . " " . preg_replace('/<=|>=|<|>/', '', $where_array[$i]) . " " . $string_Caculator . " ?";
            }
            $query = $this->conn->prepare($sql);
            if ($query->execute($value_where)) {
                return json_encode(
                    array(
                        'type'      => 'sucessFully',
                        'Message'   => 'Delete data success',
                    )
                );
            } else {
                return json_encode(
                    array(
                        'type'      => 'fails',
                        'Message'   => 'Delete data fails',
                    )
                );
            }
        }
    }
    function select_row($data = '*', $where)
    {
        $sql = "SELECT $data FROM $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" . $stringWhere . " " . $where_array[$i] . " = ?";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($value_where);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
    function select_max_fields($data = '', $where = NULL)
    {
        if ($data != '') {
            $sql = "SELECT MAX(" . $data . ") as sort FROM $this->table ";
        }
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" . $stringWhere . " " . $where_array[$i] . " = ?";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($value_where);
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    function query($query)
    {
        $sql = $query;
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // ============================================================================
    function select_array_where_not_in($data = '*', $where = NULL, $fields_not_in = NULL, $array_where_not_in = NULL, $orderby = NULL, $start = NULL, $limit = NULL)
    {
        $sql = "SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $isFields = true;
            $stringWhere = 'where';
            for ($i = 0; $i < count($fields); $i++) {
                if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields = false;
                $sql .= "  " . $stringWhere . " " . $fields[$i] . " = ? ";
            }
            if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                $sql .= ' ' . $this->where_not_in($fields_not_in, $array_where_not_in, true) . ' ';
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        } else {
            if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                $sql .= ' ' . $this->where_not_in($fields_not_in, $array_where_not_in) . ' ';
            }
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // JOIN TABLE
    function select_array_join_table(
        $data = '*',
        $where = NULL,
        $orderby = NULL,
        $start = NULL,
        $limit = NULL,
        $table_join = NULL,
        $query_join = NULL,
        $type_join  = NULL
    ) {
        $sql = "SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $isFields = true;
            if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                $sql .= ' ' . $this->join_table($table_join, $query_join, $type_join) . ' ';
            }
            $stringWhere = 'where';
            for ($i = 0; $i < count($fields); $i++) {
                if (!$isFields) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields = false;
                $sql .= "  " . $stringWhere . " " . $fields[$i] . " = ? ";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        } else {
            if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                $sql .= ' ' . $this->join_table($table_join, $query_join, $type_join) . ' ';
            }
            if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY " . $orderby . "";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT " . $start . " , " . $limit . "";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
