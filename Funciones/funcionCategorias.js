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
            title: "Todos los Campos son Obligatorios",
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
                        title: "Categoria Regitrada con Exito",
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
                        title: 'Categoria Modificada con Exito',
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
        title: "¿Estas seguro de Eliminar la Categoria?",
        text: "La Categoria no sera Eliminado permanentemente, Estara Inactivo",
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
                            "La Categoria Fue Eliminada.",
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
        title: "¿Estas seguro de Reingresar la Categoria?",
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
                            "La Categoria Fue Reingresada.",
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