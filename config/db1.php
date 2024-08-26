<?php
// session_start();
class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "e-comm";

        $conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );
        return $conn;
    }
}

## Class to perform SQL queries
class Query extends Database
{
    ## Function to get all data
    public function getData($table, $fields)
    {
        $sql = "SELECT $fields FROM $table";
        $result = $this->connect()->query($sql);
        return $result;
    }

    ## Function to insert data
    public function insertData($table, $param)
    {
        $fields = array();
        $values = array();
        foreach ($param as $key => $value) {
            $fields[] = $key;
            $values[] = $value;
        }

        $fields = implode(",", $fields);
        $values = implode("','", $values);
        $values = "'" . $values . "'";

        $sql = "INSERT INTO $table ($fields) 
            VALUES ($values)";

        $result = $this->connect()->query($sql);
        return $result;
    }

    ## Function to delete data
    public function deleteData($table, $field, $id)
    {
        $sql = "DELETE FROM $table WHERE $field = $id";
        $result = $this->connect()->query($sql);
        return $result;
    }

    ## Function to get single record
    public function getDataById($table, $fields, $whereField, $id)
    {
        $sql = "SELECT $fields FROM $table WHERE $whereField = $id";

        $result = $this->connect()->query($sql);
        return $result;
    }

    ## Function to update data
    public function updateData($table, $param, $whereField, $id)
    {
        $sql = "UPDATE $table SET";

        $length = count($param); // 3
        $i = 1;

        foreach ($param as $key => $value) {
            if ($i == $length) // 1==3
                $sql .= " $key='$value'";
            else
                $sql .= " $key='$value' , ";

            $i++;
        }

        $sql .= " WHERE $whereField = $id";

        $result = $this->connect()->query($sql);
        return $result;
    }



    // update
    public function executeQuery($sql)
    {
        return $this->connect()->query($sql);
    }

    // New method for retrieving data using a custom query
    public function getDataByCustomQuery($sql)
    {
        return $this->connect()->query($sql);
    }
    public function getDataByCustomQuerys($sql)
    {
        return $this->executeQuery($sql);
    }

    public function getDataWithStatus($table, $fields)
    {
        $sql = "SELECT $fields FROM $table WHERE status = '0'";
        $result = $this->connect()->query($sql);
        return $result;
    }

    public function getSlugactive($table, $slug)
    {
        $sql = "SELECT * FROM $table WHERE slug = '$slug' AND status = '0' LIMIT 1";
        $result = $this->connect()->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getProductCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = '$category_id' AND status = '0'";
        $result = $this->connect()->query($sql);
    
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
     
}
 