$(document).ready(function() {
    $('#table_data').DataTable({
        "pageLength": 10,
        "lengthChange": false,
        "language": {
            "paginate": {
                "previous": "Anterior",
                "next": "Sgte"
            },
            "search": "Buscar:",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
        }
    });
});
