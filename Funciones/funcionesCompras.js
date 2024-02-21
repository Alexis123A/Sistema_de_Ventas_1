
if (document.getElementById('tblDetalle')) {
    cargarDetalle();
} else {

}


function buscarCodigo(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = document.getElementById("codigo").value;
        const url = base_url + "Compras/buscarCod/" + cod;
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

function calcularPro(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    if (e.which == 13) {
        if (cant > 0) {
            document.getElementById("sub_total").value = cant * precio;
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == 'ok') {
                        alert('Ingresado');
                        frm.reset();
                        cargarDetalle();
                    } else if (res == 'modificado') {
                        alert('Actualizado');
                        frm.reset();
                        cargarDetalle();
                    }
                }
            }
        }
    }
}

function cargarDetalle() {
    const url = base_url + "Compras/listar";
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
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deletePro(${row['id']});"><i class="fas fa-trash-alt"></i></button></td>
                </tr>`
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function deletePro(id) {
    const url = base_url + "Compras/delete/" + id;
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
                cargarDetalle();
            }
        }
    }
}

function generarCompra() {
    Swal.fire({
        title: "¿Estas seguro de Realizar la Compra?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "ok") {
                        console.log(this.responseText);
                        Swal.fire(
                            "!Mensaje!",
                            "Compra Realizada",
                            "success"
                        )
                        const ruta = base_url + 'Compras/generarPdf/' + res.id_compra;
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

