<?php
class Config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "rnw";

    public $conn;


    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insert($name, $age, $course)
    {
        $this->connect();
        $query = "INSERT INTO students(name,age,course) values('$name', $age, '$course');";

        // mysqli_query(connection,query);
        $res = mysqli_query($this->conn, $query);//  return bool;

        return $res;
    }

    public function fetch_students_data()
    {
        $this->connect();

        $query = "SELECT * FROM students;";

        $res = mysqli_query($this->conn, $query); // return obj to mysqli_result class

        return $res;
    }

    public function delete($id)
    {
        $this->connect();

        $query = "DELETE FROM students WHERE id=$id";

        $res = mysqli_query($this->conn, $query); // return true or number of deleted record 1

        return $res;
    }

    public function fetch_single_student_data($id)
    {
        $this->connect();

        $query = "SELECT * FROM students WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); // return obj to mysqli_result class

        return $res;
    }

    public function update($name, $age, $course, $id)
    {
        $this->connect();
        $query = "UPDATE students SET name='$name',age=$age,course = '$course' WHERE id=$id;";

        $res = mysqli_query($this->conn, $query);//  return bool;

        return $res;
    }
}
?>