$(document).ready(function() {
    $('#CompteTable').DataTable({
        "order": [
            [ 4, "asc" ]
        ],
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.7/i18n/French.json" }
    });
});