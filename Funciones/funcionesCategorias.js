let tblCategorias;
document.addEventListener("DOMContentLoaded", function () {
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'categorias'
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

function frmCategorias() {
    document.getElementById("title").innerHTML = "Nueva Categoria";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmCategorias").reset();
    $("#nueva_categorias").modal("show");
    document.getElementById("idies").value = "";
}

function registrarCategorias(e) {
    e.preventDefault();
    const categorias = document.getElementById("categorias");
    if (categorias.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategorias");
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
                        title: "CATEGORIA REGISTRADA",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nueva_categorias").modal("hide");
                    tblCategorias.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'CATEGORIA MODIFICADA',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nueva_categorias").modal("hide");
                    tblCategorias.ajax.reload();
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

function btnEditarCategorias(id) {
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Categorias/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("categorias").value = res.categorias;
            console.log(this.responseText);
            console.log(id);
            $("#nueva_categorias").modal("show");

        }
    }

}

function btnEliminarCategorias(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTA CATEGORIA?",
        text: "LA CATEGORIA NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/eliminar/" + id;
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
                            "CATEGORIA INHABILITADA.",
                            "success"
                        )
                        tblCategorias.ajax.reload();
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

function btnReingresarCategorias(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE REINGRESAR LA CATEGORIA?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/reingresar/" + id;
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
                            "LA CATEGORIA FUE REINGRESADA.",
                            "success"
                        )
                        tblCategorias.ajax.reload();
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