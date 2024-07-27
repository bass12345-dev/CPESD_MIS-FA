<script>
function datatables_buttons() {
    return [{
            extend: 'copy',
            text: 'Copy',
            className: 'btn btn-warning rounded-pill ',
            footer: true,
            exportOptions: {
                columns: 'th:not(:last-child)',

            }
        },
        {
            extend: 'print',
            text: 'Print',
            className: 'btn btn-info rounded-pill  ms-2',
            footer: true,
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }, {
            extend: 'csv',
            text: 'CSV',
            className: 'btn btn-success rounded-pill ms-2',
            footer: true,
            exportOptions: {
                columns: 'th:not(:last-child)',
            }
        },
    ];

}
</script>