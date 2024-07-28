<script>
function _insertAjax(url, form, table) {
    form.find('span[class=error]').remove();
    $.ajax({
        url: base_url + url,
        method: 'POST',
        data: form.serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
            if (data.response) {
                toast_message_success(data.message);
                form[0].reset();

                if (table != null) {
                    table.ajax.reload();
                }
            } else {
                toast_message_error(data.message);
            }

            form.find('button').prop('disabled', false);
            form.find('button').text('Submit');
        },
        error: function(err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                form.find('button').prop('disabled', false);
                form.find('button').text('Submit');
                // $('.submit-loader').addClass('d-none');
                // // display errors on each form field
                $.each(err.responseJSON.errors, function(i, error) {
                    var el = form.find('[name="' + i + '"]');
                    el.after($('<span style="color: red;" class="error">' + error[0] +
                        '</span>'));

                });
            }
        }


    });
}

function delete_item(id, url, button_text = '', text = '',table) {

    Swal.fire({
        title: "Are you sure?",
        text: text != '' ? text : "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: button_text != '' ? button_text : "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                method: 'POST',
                url: base_url + url,
                data: {
                    id: id
                },
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
                        toast_message_error(data.message)
                        table.ajax.reload();
                    } else {
                        toast_message_error('Something Wrong')
                    }

                },
                error: function() {
                    toast_message_error('Something Wrong')
                    // location.reload();
                    JsLoadingOverlay.hide();

                }

            });
        }
    });

}
</script>