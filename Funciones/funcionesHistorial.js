let t_h_v;
document.addEventListener("DOMContentLoaded", function () {
    t_h_v = $('#t_historia_v').DataTable({
        ajax: {
            url: base_url + "Ventas/listar_historial",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'total'
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

let t_h_vc;
document.addEventListener("DOMContentLoaded", function () {
    t_h_v = $('#t_historia_vc').DataTable({
        ajax: {
            url: base_url + "Ventas/listar_ventas_credito",
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
            'data': 'abonado'
        },
        {
            'data': 'restante'
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

function btnAnularV($id) {


    Swal.fire({
        title: "¿Estas seguro de Anular la Venta?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Ventas/anularVenta/" + $id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alert("Anulado");
                    t_h_v.ajax.reload();
                }
            }

        }
    })
}

function frmCredito(id) {

    document.getElementById("title").innerHTML = "Nuevo Abono";
    document.getElementById("btnAcion").innerHTML = "Cancelar";
    document.getElementById("frmCredito").reset();
    $("#nuevo_credito").modal("show");
    document.getElementById("idies").value = "";


    const url = base_url + "Ventas/getVentasCs/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res) {
                console.log(res.id)
                document.getElementById("cliente").value = res.cliente;
                document.getElementById("total").value = res.total;
                document.getElementById("abonado").value = res.abonado;
                document.getElementById("restante").value = res.restante;
                document.getElementById("idies").value = res.id;


            }
        }
    }
}

function abonarVenta(e) {
    e.preventDefault();
    if (e.which == 13) {
        $id = document.getElementById("idies").value;
        const url = base_url + "Ventas/abonar/" + $id;
        const frm = document.getElementById("frmCredito");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
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