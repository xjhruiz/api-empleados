<?php

class ApiEmployees
{
    private $model;
    //Patron injeccion de dependencias 
    public function __construct(Model $newModel)
    {
        $this->model = $newModel;
    }

    public function getEmployees()
    {
        header('Content-Type: application/json');
        $employees = array();
        $employees['data'] = array();
        $response = $this->model->getListEmployeesByCurrentSalaryLimit50OrderByHireDate();
        if ($response->rowCount()) {
            while ($row = $response->fetch(PDO::FETCH_ASSOC)) {
                //Para no crear una instancia de cada  tabla, y hacerlo más rapido 
                //hice que el json sea con unas claves de un array asociativo
                //y no con propiedades de un objeto
                $employee = array(
                    "idEmployee" => $row['emp_no'],
                    "name" => $row['first_name'],
                    "lastName" => $row['last_name'],
                    "deptName" => $row['dept_name'],
                    "title" => $row['title'],
                    "salary" => $row['salary'],
                    "hireDate" => $row['hire_date']
                );
                array_push($employees['data'], $employee);
            }
            echo json_encode($employees);
        } else {
            echo json_encode(array('mensaje' => 'Error, doesn\'t exist employee'));
        }
    }
    public function getProfileEmployeeById($idEmployees)
    {
        header('Content-Type: application/json');

        $dataProfile['data'] = array();
        $response = $this->model->getProfileEmployeeById($idEmployees);
        if ($response->rowCount()) {
            $row = $response->fetch(PDO::FETCH_ASSOC);
            $dataProfile['data'] = array(
                "idEmployee" => $row['emp_no'],
                "name" => $row['first_name'],
                "lastName" => $row['last_name'],
                "gender" => $row['gender'],
                "deptName" => $row['dept_name'],
                "title" => $row['title'],
                "salary" => $row['salary'],
                "hireDate" => $row['hire_date'],
                "birthDate" => $row['birth_date']
            );
            echo json_encode($dataProfile);
        } else {
            echo json_encode(array('mensaje' => 'Error, doesn\'t exist employee with this id'));
        }
    }

    public function addNewEmployees($dataEmployee)
    {
        header('Content-Type: application/json');
        if (is_null($dataEmployee) || empty($dataEmployee)) {
            json_encode(array('mensaje' => ' Fiel empty'));
        }
        try {
            $insertEmployee = $this->model->insertDataEmploye(
                $dataEmployee->firstName,
                $dataEmployee->lastName,
                $dataEmployee->birthDate,
                $dataEmployee->gender
            );
            $idLastEmployee = $this->model->getIdLastEmployeeInsert();
            // print_r($idLastEmployee);
            $this->model->insertSalary($idLastEmployee, $dataEmployee->salary);
            $this->model->insertTitle($idLastEmployee, $dataEmployee->title);
            $this->model->insertDept_Emp($idLastEmployee, $dataEmployee->deptNo);
            echo json_encode(array('mensaje' => 'Created'));
        } catch (Exception $e) {
            echo json_encode(array('mensaje' => 'Error !!! '));
        }
    }
}
