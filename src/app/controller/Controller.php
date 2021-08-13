<?php
class Controller
{
    private $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function init()
    {
        $params = array(
            'mensaje' => "Buenas, espero les guste mi prueba técnica de php",
            'mensaje2' => "Apliqué lo que hasta ahora conozco, llevando 12 meses como programador php , 
            8 meses como programador java y 6 como becario",
            'mensaje3' => "Para cualquier cosa o feedback sobre la prueba mi linkedin es el siguiente: ",
            'linkedin' => "https://www.linkedin.com/in/jhonatanruiz97/"
        );

        require __DIR__ . '../../view/init.php';
    }
    public function showTableListEmployees()
    {
        $params = array(
            'mensaje' => "Para esta funcionalidad hice una llamada ajax con Fetch con javascript",
            'mensaje2' => "Y otra llamada al modelo para que pintara la tabla desde servidor",
            'mensaje3' => "Si pulsa en el botón se cargará la tabla mediante la api con Fetch"
        );
        $pdo = $this->model->getListEmployeesByCurrentSalaryLimit50OrderByHireDate();
        $titles = $this->model->selectListTable("titles", "GROUP BY title");
        $depts = $this->model->selectListTable("departments");

        $params['data'] = array();
        $params['dataTitle'] = array();
        $params['dataDep'] = $depts;

        if ($pdo->rowCount()) {
            while ($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
                //Para no crear una instancia de cada  tabla, y hacerlo más rapido hice que json sea con unos claves de un array asociativo
                // y no con propiedades de un objeto
                $employee = array(
                    "idEmployee" => $row['emp_no'],
                    "name" => $row['first_name'],
                    "lastName" => $row['last_name'],
                    "deptName" => $row['dept_name'],
                    "title" => $row['title'],
                    "salary" => $row['salary'],
                    "hireDate" => $row['hire_date']
                );
                array_push($params['data'], $employee);
            }
        } else {
            $params['data'] = "No hay empleados";
        }
        foreach ($titles as $title) {
            $element = array("title" => $title['title']);
            array_push($params['dataTitle'], $element);
        }

        require __DIR__ . '../../view/showtableemployees.php';
    }
}
