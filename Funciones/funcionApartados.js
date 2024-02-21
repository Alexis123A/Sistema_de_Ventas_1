if (document.getElementById('tblDetalleApartado')) {
    cargarDetalleApartados();
} else {

}

function tot() {
    $total = document.getElementById("totalVenta").value;

}
function cli() {
    $clist = document.getElementById("cliente").value;
}


function buscarCodigoApartado(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = document.getElementById("codigo").value;
        const url = base_url + "Apartados/buscarCod/" + cod;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("descripcion").value = res.descripcion;
                    document.getElementById("precio").value = res.precio_compra;
                    document.getElementById("idPro").value = res.id;
                    document.getElementById("cantidad").focus();
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "El Producto no Existe",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();


                }
            }
        }
    }
}

function buscarCliA(e) {
    e.preventDefault();
    if (e.which == 13) {
        const client = document.getElementById("cliente").value;
        const url = base_url + "Clientes/bucarCli/" + client;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("telefonoCli").value = res.telefono;
                    document.getElementById("direcionCli").value = res.direccion;
                    avisoCli();
                } else {
                    Swal.fire({
                        title: "¿QUIERES CREAR UN NUEVO CLIENTE?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si",
                        cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("Clientes", '_self');
                        } else {
                            document.getElementById("cliente").value = "Nuevo Cliente"
                        }

                    });

                }
            }
        }
    }
}

function calcularProA(e) {

    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    if (e.which == 13) {
        if (cant > 0) {
            document.getElementById("sub_total").value = cant * precio;
            const url = base_url + "Apartados/ingresar";
            const frm = document.getElementById("frmApartado");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res) {
                        alert(res);
                        frm.reset();
                        cargarDetalleApartados();
                    }
                }
            }
        }
    }
}

function cargarDetalleA($id) {
    const url = base_url + "Apartados/buscar/" + $id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.forEach(row => {
                html += `<tr>
                <td>${row['cantidad']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['precio']}</td>
                <td>${row['descuento']}</td>
                <td>${row['sub_total']}</td>
                </tr>`
            });
            document.getElementById("tblApartadoDetalle").innerHTML = html;
        }
    }
}
function cargarDetalleApartados() {
    const url = base_url + "Apartados/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td><input class="form-control" placeholder="Desc" type="text"" onkeyup="calcularDescA(event, ${row['id']})"></td>
                <td>${row['descuento']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteProA(${row['id']});"><i class="fas fa-trash-alt"></i></button></td>
                </tr>`
            });
            document.getElementById("tblDetalleApartado").innerHTML = html;
            document.getElementById("totalVenta").value = res.total_pagar.total;
        }
    }
}

function calcularDesc(e, id) {
    e.preventDefault();
    if (e.target.value == '') {
        alert('Vasio');
    } else {
        if (e.which == 13) {
            const url = base_url + "Ventas/calcularDesc/" + id + "/" + e.target.value;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alert("Aplicado");
                    cargarDetalleVenta();

                }
            }
        }
    }
}

function deleteProA(id) {
    const url = base_url + "Apartados/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: "center",
                    title: "Producto Eliminado",
                    showConfirmButton: false,
                    timer: 2000
                });
                cargarDetalleApartados();
            }
        }
    }
}

function avisoCli() {
    const client = document.getElementById("cliente").value;
    const url = base_url + "Clientes/bucarCli/" + client;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            Swal.fire({
                title: "INFORMACION DEL CLIENTE",
                html: "Identificacion: " + res.cc + "<br>" +
                    "Nombre: " + res.nombre + "<br>" +
                    "Telefono: " + res.telefono + "<br>" +
                    "Direccion: " + res.direccion,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "!Mensaje!",
                        "Aceptado",
                        "success"

                    )
                } else {
                    Swal.fire(
                        "!Mensaje!",
                        "Cancelado",
                        "error"
                    )
                    document.getElementById("cliente").value = "";
                }
            }
            )
        }
    }
}

function generarApartado() {
    tot();
    cli();
    if ($total == "") {
        console.log("No hay ningun Producto");
    } else if ($clist == "") {
        console.log("No hay Cliente Asignado");
    } else {
        Swal.fire({
            title: "¿Estas seguro de Realizar la Venta?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = base_url + "Apartados/registrarApartado";
                const http = new XMLHttpRequest();
                const frm = document.getElementById("frmApartados2");
                http.open("POST", url, true);
                http.send(new FormData(frm));
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        const res = JSON.parse(this.responseText);
                        if (res.msg == "ok") {
                            console.log(this.responseText);
                            Swal.fire(
                                "!Mensaje!",
                                "Venta Realizada",
                                "success"
                            )
                            const ruta = base_url + 'Apartados/generarPdf/' + res.id_compra;
                            window.open(ruta);
                            setTimeout(() => {
                                window.location.reload();
                            }, 300);
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

}



let t_h_a;
document.addEventListener("DOMContentLoaded", function () {
    t_h_a = $('#t_historia_a').DataTable({
        ajax: {
            url: base_url + "Apartados/listar_historial",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'total'
        },
        {
            'data': 'cliente'
        },
        {
            'data': 'fecha'
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

function frmApartado(id) {
    document.getElementById("title").innerHTML = "Apartados";
    //document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("frmApartado").reset();
    $("#nueva_apartado").modal("show");
    //document.getElementById("idies").value = "";

    const url = base_url + "Apartados/buscarCli/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res) {
                document.getElementById("nombre").value = res.cli.nombre;
                document.getElementById("telefono").value = res.cli.telefono;
                document.getElementById("direccion").value = res.cli.direccion;
                document.getElementById("fechass").value = res.apar_f.fecha;
                $abonado = document.getElementById("abonado").value = res.apar_f.abonado;
                $total = document.getElementById("total").value = res.apar_f.total;
                document.getElementById("restante").value = $total - $abonado;
                cargarDetalleA(id);

            } else if(res == "") {
                document.getElementById("nombre").value = "Cliente no Asignado";
                document.getElementById("telefono").value = "Cliente no Asignado";
                document.getElementById("direccion").value = "Cliente no Asignado";
            }
        }
    }
}

