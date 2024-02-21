

let tblCaja;
document.addEventListener("DOMContentLoaded", function () {
    tblCaja = $('#tblCaja').DataTable({
        ajax: {
            url: base_url + "Caja/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
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
function frmCaja() {
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmCaja").reset();
    $("#nueva_caja").modal("show");
    document.getElementById("idies").value = "";
}

let t_arqueo;
document.addEventListener("DOMContentLoaded", function () {
    tblCaja = $('#t_arqueo').DataTable({
        ajax: {
            url: base_url + "Caja/listarArqueo",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'monto_inicial'
        },
        {
            'data': 'monto_final'
        },
        {
            'data': 'fecha_apertura'
        },
        {
            'data': 'fecha_cierre'
        },
        {
            'data': 'total_ventas'
        },
        {
            'data': 'monto_total'
        },
        {
            'data': 'estado'
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
function frmCaja() {
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmCaja").reset();
    $("#nueva_caja").modal("show");
    document.getElementById("idies").value = "";
}

function registrarCaja(e) {
    e.preventDefault();
    const caja = document.getElementById("caja");
    if (caja.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Caja/registrar";
        const frm = document.getElementById("frmCaja");
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
                        title: "CAJA REGISTRADA",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nueva_caja").modal("hide");
                    tblCaja.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'CAJA MODIFICADA',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nueva_caja").modal("hide");
                    tblCaja.ajax.reload();
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

function btnEditarCaja(id) {
    document.getElementById("title").innerHTML = "Actualizar Caja";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Caja/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("caja").value = res.caja;
            console.log(this.responseText);
            console.log(id);
            $("#nueva_caja").modal("show");

        }
    }

}

function btnEliminarCaja(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTA CAJA?",
        text: "LA CAJA NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Caja/eliminar/" + id;
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
                            "CAJA INHABILITADA",
                            "success"
                        )
                        tblCaja.ajax.reload();
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

function btnReingresarCaja(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE REINGRESAR LA CAJA?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Caja/reingresar/" + id;
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
                            "LA CAJA FUE REINGRESADA.",
                            "success"
                        )
                        tblCaja.ajax.reload();
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

function frmarqueo() {
    document.getElementById("title").innerHTML = "Abrir Caja";
    document.getElementById("btnAcion").innerHTML = "Abrir";
    document.getElementById("frmarqueo").reset();
    document.getElementById("ocultar_campos").classList.add('d-none');
    $("#abrir_caja").modal("show");
    document.getElementById("idies").value = "";
}

function abrirArqueo(e) {
    e.preventDefault();
    const monto = document.getElementById('monto').value;
    if (monto == "") {
        alert("Campos Vacios");
    } else {
        const form = document.getElementById('frmarqueo');
        const url = base_url + "Caja/abrirArqueo";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(form));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                alert(res);
                t_arqueo.ajax.reload();
                $('#abrir_caja').modal('hide');

            }
        }
    }
}

function Cerrarcaja() {
    const url = base_url + "Caja/getVentas";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById('monto_final').value = res.monto_total.total;
            document.getElementById('total_ventas').value = res.total_ventas.total;
            document.getElementById('monto').value = res.inicial.monto_inicial;
            document.getElementById('monto_general').value = res.monto_general;
            document.getElementById('id').value = res.inicial.id;
            document.getElementById("ocultar_campos").classList.remove('d-none');
            document.getElementById("title").innerHTML = "Cerrar Caja";
            document.getElementById("btnAcion").innerHTML = "Cerrar";
            $('#abrir_caja').modal('show');
        }

    }
}


/*

  Swal.fire({
        title: "¿ESTÁS SEGURO DE CERRAR LA CAJA?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Caja/cerrar';
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
                            "CAJA INHABILITADA",
                            "success"
                        )
                        t_arqueo.ajax.reload();
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
*/