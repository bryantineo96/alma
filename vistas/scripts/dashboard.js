window.setInterval(function () {
        updateLabels();
    }, 2000);

    function updateLabels() {
        jQuery.get(
            '../ajax/dashboard.php?op=total_botellas',
            function (data) {
                $('#total_botellas').text(data);
            }
        );
        jQuery.get(
            '../ajax/dashboard.php?op=pendientes_devolucion',
            function (data) {
                $('#tb_pendientes_devolucion').text(data);
            }
        );
    }
