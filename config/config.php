<?php
class Config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "rnw";

    private $STUDENT_TABLE = "students";
    private $USER_TABLE = "user";

    public $conn;


    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connect();
        $query = "INSERT INTO $this->STUDENT_TABLE(name,age,course) values('$name', $age, '$course');";

        // mysqli_query(connection,query);
        $res = mysqli_query($this->conn, $query);//  return bool;

        return $res;
    }

    public function fetchStudentsData()
    {
        $this->connect();

        $query = "SELECT * FROM $this->STUDENT_TABLE;";

        $res = mysqli_query($this->conn, $query); // return obj to mysqli_result class

        return $res;
    }

    public function deleteStudent($id)
    {
        $this->connect();
        $fetch = $this->fetchSingleStudentData($id);
        $result = mysqli_fetch_assoc($fetch);

        if ($result) {
            $query = "DELETE FROM $this->STUDENT_TABLE WHERE id=$id";

            $res = mysqli_query($this->conn, $query); // return true or number of deleted record 1

            return $res;
        } else {
            return false;
        }
    }

    public function fetchSingleStudentData($id)
    {
        $this->connect();

        $query = "SELECT * FROM $this->STUDENT_TABLE WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); // return obj to mysqli_result class

        return $res;
    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connect();

        $fetch = $this->fetchSingleStudentData($id);
        $result = mysqli_fetch_assoc($fetch);

        if ($result) {
            $query = "UPDATE $this->STUDENT_TABLE SET name='$name',age=$age,course = '$course' WHERE id=$id;";

            $res = mysqli_query($this->conn, $query);//  return bool;

            return $res;
        } else {
            return false;
        }
    }


    public function signUpUser($name, $email, $password)
    {
        $this->connect();

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO $this->USER_TABLE(name,email,password) values('$name','$email', '$hashed_password');";

        return mysqli_query($this->conn, $query);
    }
}
?>