let tblUsuarios;
document.addEventListener("DOMContentLoaded", function () {
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'usuario'
        },
        {
            'data': 'correo'
        },
        {
            'data': 'nombre'
        },
        {
            'data': 'caja'
        },
        {
            'data': 'estado'
        },
        {
            'data': 'acciones'
        }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para PDF
        {
            extend: 'copyHtml5',
            footer: true,
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
        },
        //Botón para print
        {
            extend: 'csvHtml5',
            footer: true,
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });
})

function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("idies").value = "";
}

function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const correo = document.getElementById("correo");
    const nombre = document.getElementById("nombre");
    const pass = document.getElementById("pass");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || caja.value == "" || correo.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $si = console.log("Respuesta", this.responseText);

                const res = JSON.parse(this.responseText);
                if (res == "Si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "USUARIO REGISTRADO",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'USUARIO MODIFICADO',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });

                }


            }
        }
    }
}

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("correo").value = res.correo;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            console.log(this.responseText);
            console.log(id);
            $("#nuevo_usuario").modal("show");

        }
    }

}

function btnEliminarUser(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTE USUARIO?",
        text: "EL USUARIO NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        console.log(this.responseText);
                        Swal.fire(
                            "!Mensaje!",
                            "USUARIO INHABILITADO",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            "!Mensaje!",
                            res,
                            "error"
                        )
                    }
                }
            }

        }
    })
}

function btnReingresarUser(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE REINGRESAR EL USUARIO?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        console.log(this.responseText);
                        Swal.fire(
                            "!Mensaje!",
                            "EL USUARIO FUE REINGRESADO.",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            "!Mensaje!",
                            res,
                            "error"
                        )
                    }
                }
            }

        }
    })
}

function registrarPermisos(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermisos";
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
           const res = JSON.parse(this.responseText);
            console.log(this.responseText);
            if (res != '') {
                alert(res);
            }else{
                alert("Error no Identificado");
            }
        }
    }

}



//Fin Usuarios ---------------------------------------------------------------------------------------------
