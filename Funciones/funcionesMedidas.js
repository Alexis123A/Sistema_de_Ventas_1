let tblMedidas;
document.addEventListener("DOMContentLoaded", function () {
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'medidas'
        },
        {
            'data': 'medidas_corto'
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

function frmMedidas() {
    document.getElementById("title").innerHTML = "Nueva Medida";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmMedidas").reset();
    $("#nueva_medidas").modal("show");
    document.getElementById("idies").value = "";
}

function registrarMedidas(e) {
    e.preventDefault();
    const medidas = document.getElementById("medidas");
    if (medidas.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedidas");
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
                        title: "MEDIDA REGISTRADA",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nueva_medidas").modal("hide");
                    tblMedidas.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'MEDIDA MODIFICADA',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nueva_medidas").modal("hide");
                    tblMedidas.ajax.reload();
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

function btnEditarMedidas(id) {
    document.getElementById("title").innerHTML = "Actualizar Medidas";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Medidas/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("medidas").value = res.medidas;
            document.getElementById("medidas_corto").value = res.medidas_corto;
            console.log(this.responseText);
            console.log(id);
            $("#nueva_medidas").modal("show");

        }
    }

}

function btnEliminarMedidas(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTA MEDIDA?",
        text: "LA MEDIDA NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/eliminar/" + id;
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
                            "MEDIDA INHABILITADA.",
                            "success"
                        )
                        tblMedidas.ajax.reload();
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

function btnReingresarMedidas(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE REINGRESAR LA MEDIDA?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/reingresar/" + id;
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
                            "LA CATEGORIA FUE MEDIDA.",
                            "success"
                        )
                        tblMedidas.ajax.reload();
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