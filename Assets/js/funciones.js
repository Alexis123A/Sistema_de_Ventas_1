let tblUsuarios;
document.addEventListener("DOMContentLoaded", function () {
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [{
            'data': 'id'
        },
        {
            'data': 'usuario'
        },
        {
            'data': 'nombre'
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
        ]
    });
})


function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAcion").innerHTML = "Guardar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("idies").value = "";
}

function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const pass = document.getElementById("pass");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || caja.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los Campos son Obligatorios",
            showConfirmButton: false,
            timer: 3000
        });

    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
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
                        title: "Usuario Regitrado con Exito",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: 'Usuario Modificado con Exito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
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

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAcion").innerHTML = "Actualizar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("idies").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            console.log(this.responseText);
            console.log(id);
            $("#nuevo_usuario").modal("show");

        }
    }

}

function btnEliminarUser(id) {
    Swal.fire({
        title: "¿Estas seguro de Eliminar el Usuario?",
        text: "El Usuario no sera Eliminado permanentemente, Estara Inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
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
                            "El Usuario Fue Eliminado.",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
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

function btnReingresarUser(id) {
    Swal.fire({
        title: "¿Estas seguro de Reingresar el Usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
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
                            "El Usuario Fue Reingresado.",
                            "success"
                        )
                        tblUsuarios.ajax.reload();
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

function aviso(){
Swal.fire("SweetAlert2 is working!");
}



//Fin Usuarios ------------------------------------------------------------------------------------------------
