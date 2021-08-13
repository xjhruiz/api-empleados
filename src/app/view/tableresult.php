<table id="tableEmployees" class="table table-hover">
    <thead class="thead-dark">
        <th>Número Empleado</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha Contratación</th>
        <th>Nombre Departamento</th>
        <th>Cargo</th>
        <th>Salario</th>
    </thead>
    <tbody id="tdBodyTableEmployees">
        <?php $cont = 0;
        foreach ($params['data'] as $employee) : ?>
            <tr>
                <td><a id="btnProfile<?= $cont ?>" style="color:#1d2124" rel="tooltip" data-toggle="modal" data-target="#exampleModal" title="ver Detalles" href="javascript:;" onclick="verPerfil('<?php echo $employee['idEmployee']; ?>');" title="Ver perfil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                    </a>&nbsp
                    <?php echo $employee['idEmployee'] ?></td>
                <td><?= $employee['name'] ?></td>
                <td><?= $employee['lastName'] ?></td>
                <td><?= $employee['hireDate'] ?></td>
                <td><?= $employee['deptName'] ?></td>
                <td><?= $employee['title'] ?></td>
                <td><?= $employee['salary'] ?></td>

            </tr>
        <?php $cont++;
        endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perfil del usuario <span id="profileEmployee"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="contenidoModal" id="contenidoModal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>