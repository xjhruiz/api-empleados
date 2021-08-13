const $id = (selectorById) => document.getElementById(selectorById);
$id("btnUseApi").addEventListener("click", () => {
  fetch("/api/getListEmployees", {
    method: "GET",
    mode: "cors",
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((res) => {
      let tbodyFetch = "";
      for (let i in res.data) {
        tbodyFetch += `<tr>
            <td class="tbodyFetch"><a href="/api/getListEmployeesById?idEmployee=${res.data[i].idEmployee}"</a>${res.data[i].idEmployee} </td>
            <td> ${res.data[i].name} </td>
            <td> ${res.data[i].lastName} </td>
            <td> ${res.data[i].hireDate} </td>
            <td> ${res.data[i].deptName} </td>
            <td> ${res.data[i].title} </td>
            <td> ${res.data[i].salary} </td>
        </tr>
        `;
      }
      $id("tdBodyTableEmployees").innerHTML = tbodyFetch;
    })
    .catch((error) => console.error(error));
});

function verPerfil(idEmployee) {
  let formDataProfile = $id("formUpdateDataEmployee");
  if (formDataProfile) {
    formDataProfile.parentNode.removeChild(formDataProfile);
  }
  fetch("/api/getListEmployeesById?idEmployee=" + idEmployee, {
    method: "GET",
    mode: "cors",
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((res) => {
      $id("contenidoModal").insertAdjacentHTML(
        "afterend",
        dataProfile(res.data)
      );
    });
}

$name = (selectorByName) => document.getElementsByName(selectorByName);

$id("btnNewEmployee").addEventListener("click", () => {
  $id("msmerror").innerHTML = "";
  $id("formNewEmployee").reset()
}
);

$id("formNewEmployee").addEventListener("submit", (event) => {
  event.preventDefault();
  console.log(event);
  let myDataForm = new FormData($id("formNewEmployee"));
  let nameEmployee = myDataForm.get("firstName");
  console.log(nameEmployee);
  let lastEmployee = myDataForm.get("lastName");
  let bithDate = myDataForm.get("birthDate");
  let salary = myDataForm.get("salary");
  let gender = myDataForm.get("gender");
  let deptNo = myDataForm.get("deptNo");
  let title = myDataForm.get("title");

  if (lastEmployee.length == 0
    || bithDate == 0
    || salary == 0
    || gender.length == 0
    || deptNo.length == 0
    || title.length == 0) {
    $id("msmerror").innerHTML = "Error!! Compruebe los campos";
    return null;
  }
  $id("msmerror").innerHTML = "";
  // console.log(this);
  //coger input por el nombre
  fetch("/api/addNewEmployee", {
    method: "post",
    mode: "cors",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      firstName: nameEmployee,
      lastName: lastEmployee,
      birthDate: bithDate,
      gender: gender,
      deptNo: deptNo,
      title: title,
      salary: salary,
    }),
  })
    .then((response) => response.json())
    .then((res) => {
      console.log(res.mensaje);
      if (res.mensaje == "Created") { location.href = "/tableListEmployees"; } else {
        $id("msmerror").innerHTML = "Error!! No se pudo crear el empleado";
      }
    })
    .catch((error) => console.error({ error }));
});

let dataProfile = (datos) => {
  template = `
              <form id="formUpdateDataEmployee">
                  <div class="form-group">
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="idEmployee">
                              <b>Id Empleado</b>
                          </label>
                          <input readonly type="text" class="form-control" name="idEmployee" id="idEmployee" value="${datos.idEmployee
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="nameEmployee">
                              <b>Nombre</b>
                          </label>
                          <input readonly type="text" class="form-control" name="nameEmployee" id="nameEmployee" value="${datos.name
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="lastNameEmployee">
                              <b>Apellido</b>
                          </label>
                          <input readonly type="text" class="form-control" name="lastNameEmployee" id="lastNameEmployee" value="${datos.lastName
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="genderEmployee">
                              <b>Género</b>
                          </label>
                          <input readonly type="text" class="form-control" name="genderEmployee" id="genderEmployee" value="${datos.gender == "F" ? "Female" : "Male"
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="depNoEmployee">
                              <b>Nombre Dep.</b>
                          </label>
                          <input readonly type="text" class="form-control" name="depNoEmployee" id="depNoEmployee" value="${datos.deptName
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="titleEmployee">
                              <b>Cargo</b>
                          </label>
                          <input readonly type="text" class="form-control" name="titleEmployee" id="titleEmployee" value="${datos.title
    }">
                      </div>
                      <div class="sp">
                          <label class="control-label lPass col-md-4" for="salaryEmployee">
                              <b>Salario</b>
                          </label>
                          <input readonly type="text" class="form-control" name="salaryEmployee" id="salaryEmployee" value="${datos.salary
    }">
                      </div>
              </form>
  `;
  return template;
};
let idiomaES = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
  },
};
$("#tableEmployees").DataTable({
  language: idiomaES,
});
