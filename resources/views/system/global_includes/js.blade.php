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
function reload_page() {
    location.reload();
}

function capitalizeFirstLetter(string) {
           return string.charAt(0).toUpperCase() + string.slice(1);
       }



// function http_post_i_u(data, url,table) {

//     $.ajax({
//         url: base_url + url,
//         method: 'POST',
//         data: data,
//         dataType: 'json',
//         beforeSend: function() {
//             loader();
//         },
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//         },
//         success: function(data) {
//             JsLoadingOverlay.hide();
//             if (data.response) {
//                 alert(data.message);
//                 if (table != null) {
//                     table.ajax.reload();
//                 }
//             } else {
//                 alert(data.message);
//             }
//         },
//         error: function() {
//             alert('something Wrong');
//             JsLoadingOverlay.hide();
//         }

//     });

// }
</script>