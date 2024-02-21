function frmPass(e) {
    e.preventDefault();
    const actual = document.getElementById('actual').value;
    const nueva = document.getElementById('nueva').value;
    const confirmar = document.getElementById('confirmarC').value;

    if (actual == "" || nueva == "" || confirmar == "") {
        alert("Los Campos estan Vacios");
        return false;
    } else {
        if (nueva != confirmar) {
            alert("Las Contraseñas no coinciden");
            return false;
        } else {
            const url = base_url + "Usuarios/change";
            const frm = document.getElementById("frmPass");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    $('#chamgePass').modal("hide");
                    alert(res.msg);
                    frm.reset();

                }
            }
        }
    }
}