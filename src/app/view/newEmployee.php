  <button type="button" id="btnNewEmployee" data-toggle="modal" data-target="#newEmployeeModal" class="btn btn-primary"> Nuevo Empleado </button>


  <div class="modal fade" id="newEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="newEmployeeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newEmployeeModalLabel"> Nuevo Empleado</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="contentModalNewEmployee" id="contentModalNewEmployee">
                  <span class="my-title" id="msmerror"></span>
                  <form action="" method="POST" id="formNewEmployee">
                      <div class="modal-body">
                          <div class="sp">
                              <label class="control-label lPass col-md-4" for="firstName">
                                  <b>Nombre</b>
                              </label>
                              <input type="text" name="firstName" id="firstName" class="form-control" autocomplete="off" require>
                          </div>
                          <div class="sp">
                              <label class="control-label lPass col-md-4" for="lastName">
                                  <b>Apellido</b>
                              </label>
                              <input type="text" name="lastName" id="lastName" class="form-control" autocomplete="off" require>
                          </div>
                          <div class="sp">
                              <label class="control-label lPass col-md-4" for="birthDate">
                                  <b>Fecha Nacimiento</b>
                              </label>
                              <input type="date" name="birthDate" id="birthDate" class="form-control" autocomplete="off" require>
                          </div>
                          <div class="sp-number">
                              <label class="control-label lPass col-md-4" for="birthDate">
                                  <b>Salario</b>
                              </label>
                              <input type="number" name="salary" id="salary" min="0" class="form-control" autocomplete="off" require>
                          </div>
                          <div class="">
                              <label class="control-label lPass col-md-4">
                                  <b>Genero</b></label>
                              <div class="radius">
                                  <input class="" type="radio" name="gender" id="gender1" value="M" checked="">
                                  <label class="" for="gender1">Masculino</label>
                                  <input class="" type="radio" name="gender" id="gender2" value="F"><label class="" for="gender2">
                                      Femenino
                                  </label>
                              </div>
                          </div>
                          <div class="sp">
                              <label class="control-label lPass col-md-4" for="deptNo">
                                  <b> Departamento </b>
                              </label>
                              <select class="miselectTabla" name="deptNo" id="deptNo" require>
                                  <option selected disabled>-- DEPARTAMENTO --</option>
                                  <?php foreach ($params['dataDep'] as $depart) { ?>
                                      <option value="<?= $depart['dept_no'] ?>"><?= $depart['dept_name'] ?> </option>
                                  <?php  }  ?>
                              </select>
                          </div>
                          <div class="sp">
                              <label class="control-label lPass col-md-4" for="title">
                                  <b> Cargo </b>
                              </label>
                              <select class="miselectTabla" name="title" id="title" require>
                                  <option selected disabled>-- CARGO --</option>
                                  <?php foreach ($params['dataTitle'] as $title) { ?>
                                      <option value="<?= $title['title'] ?>"><?= $title['title'] ?> </option>
                                  <?php  } ?>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary" id="btnSaveNewEmployee">Crear</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>