
if (document.getElementById('tblDetalleVenta')) {
    cargarDetalleVenta();
} else {

}

function tot() {
    $total = document.getElementById("totalVenta").value;

}
function cli() {
    $clist = document.getElementById("cliente").value;
}


function buscarCodigoVenta(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = document.getElementById("codigo").value;
        const url = base_url + "Ventas/buscarCod/" + cod;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("descripcion").value = res.descripcion;
                    document.getElementById("precio").value = res.precio_compra;
                    document.getElementById("id").value = res.id;
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

function buscarCli(e) {
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
                            document.getElementById("cliente").value = "000000000"
                        }

                    });

                }
            }
        }
    }
}

function calcularProV(e) {

    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    if (e.which == 13) {
        if (cant > 0) {
            document.getElementById("sub_total").value = cant * precio;
            const url = base_url + "Ventas/ingresar";
            const frm = document.getElementById("frmVenta");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res) {
                        alert(res);
                        frm.reset();
                        cargarDetalleVenta();
                    }
                }
            }
        }
    }
}

function cargarDetalleVenta() {
    const url = base_url + "Ventas/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td><input class="form-control" placeholder="Desc" type="text"" onkeyup="calcularDesc(event, ${row['id']})"></td>
                <td>${row['descuento']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteProVenta(${row['id']});"><i class="fas fa-trash-alt"></i></button></td>
                </tr>`
            });
            document.getElementById("tblDetalleVenta").innerHTML = html;
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

function deleteProVenta(id) {
    const url = base_url + "Ventas/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: "center",
                    title: "Producto Eliminado",
                    showConfirmButton: false,
                    timer: 2000
                });
                cargarDetalleVenta();
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

function generarVenta() {
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
                const client = document.getElementById("cliente").value;
                const url = base_url + "Ventas/registrarVenta/" + client;
                const http = new XMLHttpRequest();
                const frm = document.getElementById("frmVentaInfo");
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
                            const ruta = base_url + 'Ventas/generarPdf/' + res.id_compra;
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

function resivoVenta(e) {
    e.preventDefault();
    if (e.which == 13) {
     $abonado = document.getElementById("resivo").value;
     $total = document.getElementById("totalVenta").value;
     $cambio = $total - $abonado;
     $final = document.getElementById("total").value = $cambio;
    }
}

