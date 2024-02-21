let tblProductos;
document.addEventListener("DOMContentLoaded", function () {
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'imagen'
        },
        {
            'data': 'codigo'
        },
        {
            'data': 'descripcion'
        },
        {
            'data': 'precio_venta'
        },
        {
            'data': 'cantidad'
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


function frmProductos() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    // document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmProductos").reset();
    $("#nuevo_producto").modal("show");
    deleteImg();
    document.getElementById("idies").value = "";
}

function registrarPro(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const descripcion = document.getElementById("descripcion");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const id_medida = document.getElementById("medidass");
    const id_categoria = document.getElementById("categorias");
    if (codigo.value == "" || descripcion.value == "" || precio_compra.value == "" || precio_venta.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "ALGUNOS CAMPOS ESTÁN VACÍOS",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProductos");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "Si") {
                 Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "PRODUCTO REGISTRADA",
                    showConfirmButton: false,
                    timer: 3000
                });
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'PRODUCTO MODIFICADA',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
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
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Productos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("descripcion").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("medidass").value = res.id_medida;
            document.getElementById("categorias").value = res.id_categoria;
            document.getElementById("img-preview").src = base_url + 'Img/'+ res.img;
            console.log(this.responseText);
            console.log(id);
            document.getElementById("icon-close").innerHTML = `<button  class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>`
            document.getElementById("icon-img").classList.add("d-none");
            document.getElementById("foto_actual").value = res.img;
            $("#nuevo_producto").modal("show");

        }
    }

}

function btnEliminarPro(id) {
    Swal.fire({
        title: "¿ESTÁS SEGURO DE ELIMINAR ESTE PRODUCTO?",
        text: "EL PRODUCTO NO SE ELIMINARA POR SIEMPRE, SOLO SE INACTIVARA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/" + id;
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
                            "PRODUCTO INHABILITADA.",
                            "success"
                        )
                        tblProductos.ajax.reload();
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
        title: "¿ESTÁS SEGURO DE REINGRESAR EL PRODUCTO?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/reingresar/" + id;
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
                        tblProductos.ajax.reload();
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

function prewiew(e) {
   const url = e.target.files[0];
   const urTmp = URL.createObjectURL(url);
   document.getElementById("img-preview").src = urTmp;
   document.getElementById("icon-img").classList.add("d-none");
   document.getElementById("icon-close").innerHTML = `<button  class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>
   ${url['name']}`

}

function deleteImg() {
    document.getElementById("icon-close").innerHTML = '';
    document.getElementById("icon-img").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
}