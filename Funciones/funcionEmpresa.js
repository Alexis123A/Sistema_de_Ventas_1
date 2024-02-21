function guardarEmpresa(id) {
    const frm = document.getElementById('frmEmpresa');
    const url = base_url + "Empresa/modificar/" + id;
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: "center",
                    icon: "succes",
                    title: "Datos Modificados",
                    showConfirmButton: false,
                    timer: 3000     
                });
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }else{
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error al Modificar los Dartos",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    }
}