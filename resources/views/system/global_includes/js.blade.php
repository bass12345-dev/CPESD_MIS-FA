<script>
var base_url = '<?php echo url(''); ?>';
var table;

function loader() {

    JsLoadingOverlay.show({
        'overlayBackgroundColor': '#666666',
        'overlayOpacity': 0.6,
        'spinnerIcon': 'square-loader',
        'spinnerColor': '#000',
        'spinnerSize': '3x',
        'overlayIDName': 'overlay',
        'spinnerIDName': 'spinner',
        'offsetY': 0,
        'offsetX': 0,
        'lockScroll': false,
        'containerID': null,
        'spinnerZIndex': 99999,
        'overlayZIndex': 99998
    });

}

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

function reload_page() {
    location.reload();
}


function http_post_i_u(data, url,table) {

    $.ajax({
        url: base_url + url,
        method: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            loader();
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
            JsLoadingOverlay.hide();
            if (data.response) {
                alert(data.message);
                if (table != null) {
                    table.ajax.reload();
                }
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert('something Wrong');
            JsLoadingOverlay.hide();
        }

    });

}
</script>