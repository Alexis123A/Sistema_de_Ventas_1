if (document.getElementById('ventas')) {
    reporte();
    reporteVentas();
} else if (document.getElementById('cajas')) {
    reporteCajas();
}
function reporte() {
    const url = base_url + "Empresa/reportesStock";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];

            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['cantidad']);
            }
            var ctx = document.getElementById("productos");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });

        }
    }
}
function reporteVentas() {
    const url = base_url + "Empresa/masVendidos";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];

            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['total']);
            }
            var ctx = document.getElementById("ventas");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });

        }
    }
}
function reporteCajas() {
    const url = base_url + "Caja/movimientoCaja";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let monto = [];
            let total = [];
            let nombre = ['Movimientos'];

            for (let i = 0; i < res.length; i++) {
                monto.push(res[i]['monto']);
                total.push(res[i]['total']);
            }
            var ctx = document.getElementById("cajas");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: total,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                        label: 'Total'
                    }, {
                        data: monto,
                        backgroundColor: ['#28a745'],
                        label: 'Monto'
                    }],
                },
            });

        }
    }
}



