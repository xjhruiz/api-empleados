<?php
ini_set('display_errors', 1);
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);

class Model extends Config
{
    private $db;
    private static $singleton;
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;

    public function __construct()
    {
        $this->dbhost = Config::$BD_HOSTNAME;
        $this->dbname = Config::$DB_NAME;
        $this->dbuser = Config::$DB_USER;
        $this->dbpass = Config::$DB_PASSWORD;
        //Intenté hacer singleton para ahorar recursos y no tener que crear un nuew objeto conexión, pero me daba errores y por falta de tiempo
        // try {
        //     $con = "mysql:host=$dbhost;port=3306;dbname=$dbname;charset=utf8";
        //     $this->db = new PDO($con, $dbuser, $dbpass);
        // } catch (PDOException $e) {
        //     print_r("¡Error connection ! " . $e->getMessage());
        // }
    }

    public function connection()
    {
        try {
            $con = "mysql:host={$this->dbhost};port=3306;dbname={$this->dbname};charset=utf8";
            $errorPDO = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($con, $this->dbuser, $this->dbpass, $errorPDO);
        } catch (PDOException $e) {
            print_r("¡Error connection ! " . $e->getMessage());
        }
        return $pdo;
    }

    //Intenté hacer singleton para ahorar recursos y no tener que crear un objeto conexión, pero me daba errores
    // public function singleton()
    // {
    //     if (!isset(self::$singleton)) {
    //         $miClase = __CLASS__;
    //         self::$singleton = new $miClase;
    //     }
    //     return self::$singleton;
    // }

    // public function __clone()
    // {
    //     trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    // }

    public function __destroy()
    {
        $this->db->null;
    }

    public function getListEmployeesByCurrentSalaryLimit50OrderByHireDate()
    {
        $sql = "SELECT e.emp_no, e.first_name, e.last_name, DATE_FORMAT(e.hire_date, '%d-%m-%Y') as hire_date  ,
        d.dept_name, t.title ,s.salary
       FROM employees e
       LEFT JOIN salaries s ON s.emp_no = e.emp_no
       LEFT JOIN titles t ON e.emp_no = t.emp_no
       INNER JOIN dept_emp de ON e.emp_no = de.emp_no
       INNER JOIN departments d ON de.dept_no = d.dept_no
       WHERE year(s.to_date)= 9999 
       AND year(t.to_date)= 9999
       ORDER BY hire_date LIMIT 50; ";
        try {
            $statement = $this->connection()->query($sql);
            $statement->execute();
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
        return $statement;
    }

    public function getProfileEmployeeById($idEmployee)
    {
        $idEmployee = intval($idEmployee);
        $sql = " SELECT  e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date, e.birth_date,
                d.dept_name, t.title,  s.salary
                FROM employees e
           LEFT JOIN salaries s ON s.emp_no = e.emp_no
           LEFT JOIN titles t ON e.emp_no = t.emp_no
           INNER JOIN dept_emp de ON e.emp_no = de.emp_no
           INNER JOIN departments d ON de.dept_no = d.dept_no
        WHERE e.emp_no = ?
        AND YEAR(s.to_date) = 9999
        AND YEAR(t.to_date) = 9999 ;";

        try {
            $statement = $this->connection()->prepare($sql);
            $statement->bindParam(1, $idEmployee, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
        return $statement;
    }

    public function selectListTable($table, $groupBy = " ")
    {
        //para obtener el listado de los titles y departamente obté obtenerlos directamente desde el model y no desde el controlador
        $sql = "SELECT * FROM  $table     $groupBy";
        try {
            $statement = $this->connection()->prepare($sql);
            $statement->execute();
            $filas = array();
            if ($statement->rowCount() > 0) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $filas[] = $row;
                }
            }
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
        return $filas;
    }

    //funcion principal para insertar el empleado hacer con transacciones ?
    public function insertDataEmploye($firstName, $lastName, $birth_date, $gender)
    {
        if (is_null($firstName) || is_null($lastName) || is_null($birth_date) || is_null($gender)) {
            return false;
        }
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);
        $birth_date = htmlspecialchars($birth_date);
        $gender = htmlspecialchars($gender);

        $sqlInsertDataEmployee = "INSERT INTO employees(emp_no, first_name, last_name, gender, hire_date, birth_date) 
                                    VALUES (( SELECT MAX(emp_no)+1 
                                              FROM employees AS queryinsert), 
                                            ?, ?, ?, now(), ?)";
        try {
            $statement = $this->connection()->prepare($sqlInsertDataEmployee);
            $statement->bindParam(1, $firstName, PDO::PARAM_STR);
            $statement->bindParam(2, $lastName, PDO::PARAM_STR);
            $statement->bindParam(3, $gender, PDO::PARAM_STR);
            $statement->bindParam(4, $birth_date, PDO::PARAM_STR);
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            print_r("¡Error to run query InsertDataEmployee ! " . $e->getMessage());
        }
    }

    //tabla n n necesaria para guardar empleado y departamento
    public function insertDept_Emp($idEmployee, $idDep)
    {
        if (is_null($idEmployee) || is_null($idDep)) {
            echo "Error";
            return false;
        }
        $idEmployee = htmlspecialchars($idEmployee);
        $sql = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) 
                VALUES( ? , ? , NOW(),'9999-01-01');";
        try {

            $statement = $this->connection()->prepare($sql);
            $statement->bindParam(1, $idEmployee);
            $statement->bindParam(2, $idDep);
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            die("¡Error to run query insertDept_Emp ! " . $e->getMessage());
        }
    }

    //necesario para guardar el salario
    public function insertSalary($idEmployee, $salary)
    {
        if (is_null($idEmployee) || is_null($salary)) {
            return false;
        }
        $idEmployee = htmlspecialchars($idEmployee);
        $salary = htmlspecialchars($salary);

        $sql = "INSERT INTO salaries values( ? , ? ,NOW(), '9999-01-01')";
        try {
            $statement = $this->connection()->prepare($sql);
            $statement->bindParam(1, $idEmployee, PDO::PARAM_INT);
            $statement->bindParam(2, $salary, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            print_r("¡Error to run query insertSalary ! " . $e->getMessage());
        }
        return $statement;
    }

    //necesario para guardar el cargo
    public function insertTitle($idEmployee, $title)
    {
        if (is_null($idEmployee) || is_null($title)) {
            return false;
        }
        $idEmployee = htmlspecialchars($idEmployee);
        $title = htmlspecialchars($title);
        $sql = "INSERT INTO titles values(?, ?, NOW(), '9999-01-01')";
        try {
            $statement = $this->connection()->prepare($sql);
            $statement->bindParam(1, $idEmployee, PDO::PARAM_INT);
            $statement->bindParam(2, $title, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            print_r("¡Error to run query insertTitle ! " . $e->getMessage());
        }
    }

    public function getIdLastEmployeeInsert()
    {
        $sql = "SELECT MAX(emp_no) as idLastEmployee FROM employees";
        try {
            $statement = $this->connection()->query($sql);
            $statement->execute();
            $idLastEmployee = 0;
            if ($statement->rowCount() > 0) {
                $idLastEmployee = $statement->fetchColumn();
            }
        } catch (PDOException $e) {
            print_r("¡Error to run query getIdLastEmployeeInsert ! " . $e->getMessage());
        }
        return $idLastEmployee;
    }
}
