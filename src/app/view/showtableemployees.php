<?php ob_start() ?>
<h1 class="text-center mt-4"> Tabla Empleados</h1>
<article>
    <p class="lead"> <?= $params['mensaje'] ?></p>
    <p class="lead"> <?= $params['mensaje2'] ?></p>
    <p class="lead"> <?= $params['mensaje3'] ?>
        <button type="button" id="btnUseApi" class="btn btn-success">
            <span class="glyphicon glyphicon-floppy-open"></span>Con Api
        </button>
    </p>
    <p>Con este endpoint <a href="http://api-empleados.com/api/getListEmployees">API Eempleados</a></p>
    <p>Para ver el perfil del empleado usé este otro endpoint <a href="http://api-empleados.com/api/getListEmployeesById?idEmployee=10014"> API Perfil </a></p>
    <em>Se tiene que pasar como query param para este endpoint api/getListEmployeesById? este parámetro <b>idEmployee=10031<b></em>
</article>

<hr>
<div class="newEmployee">
    <?php include 'newEmployee.php' ?>
</div>
<div class="container tableEmployees">
    <?php include 'tableresult.php' ?>
</div>
<?php $contenido = ob_get_clean() ?>
<?php include 'layoutmain.php' ?>
<?php include 'footer.php' ?>