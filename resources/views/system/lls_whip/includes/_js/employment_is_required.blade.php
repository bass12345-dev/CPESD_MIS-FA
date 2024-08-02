<script>

    $(document).on('change', 'select[name=employment_status]', function () {
        var status = $('select[name=employment_status] :selected').val();
        if (status == 5) {
            $('input[name=end]').prop('required', false);
            $('input[name=end]').val('');
        } else {
            $('input[name=end]').prop('required', true);
        }
    });
    $(document).on('click', 'button.add-employee', function () {
        $('h2.title').text('Add Employee');
        $('form#add_update_form')[0].reset();
        $('input[name=employee]').val($(this).data('employee-name')).attr('disabled', false);
    });

</script>