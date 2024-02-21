

let tblProveedor;
document.addEventListener("DOMContentLoaded", function () {
    tblProveedor = $('#tblProveedor').DataTable({
        ajax: {
            url: base_url + "Proveedor/listar",
            dataSrc: ''
        },
        columns: [{ 
            'data': 'id'
        },
        {
            'data': 'cc'
        },
        {
            'data': 'nombre'
        },
        {
            'data': 'telefono'
        },
        {
            'data': 'direccion'
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
        buttons : [{
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

function frmProveedor() {
    document.getElementById("title").innerHTML = "Nuevo Proveedor";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmProveedor").reset();
    $("#nuevo_proveedor").modal("show");
    document.getElementById("idies").value = "";
}

function registrarProv(e) {
    e.preventDefault();
    const identificacion = document.getElementById("identificacion");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if (identificacion.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Proveedor/registrar";
        const frm = document.getElementById("frmProveedor");
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
                        title: "Proveedor REGISTRADO",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_proveedor").modal("hide");
                    tblProveedor.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'Proveedor MODIFICADO',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_proveedor").modal("hide");
                    tblProveedor.ajax.reload();
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

function btnEditarPro(id) {
    document.getElementById("title").innerHTML = "Actualizar Proveedor";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Proveedor/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("identificacion").value = res.cc;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            console.log(this.responseText);
            console.log(id);
            $("#nuevo_proveedor").modal("show");

        }
    }

}

function btnEliminarPro(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTE CLIENTE?",
        text: "EL CLIENTE NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proveedor/eliminar/" + id;
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
                            "Proveedor INHABILITADO",
                            "success"
                        )
                        tblProveedor.ajax.reload();
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

function btnReingresarPro(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE REINGRESAR EL CLIENTE?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proveedor/reingresar/" + id;
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
                            "EL Proveedor FUE REINGRESADO.",
                            "success"
                        )
                        tblProveedor.ajax.reload();
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