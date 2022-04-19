// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable();
});

$(document).ready(function() {
    $('#dataTable2').DataTable();
});

$(document).ready(function() {
    $('#dataTableActivity').DataTable({
        "order": [[ 0, 'desc' ]]
    });
});
