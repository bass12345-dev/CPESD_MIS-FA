<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card flex-fill p-3">
        <div class="card-header ">
            <h5 class="card-title mb-0">Latest Report/Survey</h5>
            <div class="row">
                <div class="col-md-9" style="margin-bottom: 10px;" >
                    <button class="btn btn-primary edit-survey " disabled>Edit Survey</button>
                    <button class="btn btn-danger cancel-edit-survey hidden" >Cancel Edit</button>
                    <button class="btn btn-success submit-survey hidden" >Submit</button>
                </div>
                
                <div class="col-md-3" >
                    <select class="form-control" id="select_year" onchange="load_survey_data(this)">
                    <?php
                            for ($i=2021; $i <= 2050; $i++) { 
                                $selected = $i == $year_now ? 'selected' : '';
                              echo ' <option '.$selected.'>'.$i.'</option>';
                            }
                    ?>
                </select>
                </div>
            </div>
         
        </div>
        <table class="table table-hover table-striped survey-information"  id="survey-information" style="width: 100%;margin-top: 10px; ">
       
            <tr class="info">
                <td></td>
                <td><strong>Inside</strong></td>
                <td><strong>Outside</strong></td>
            </tr>
            <tr>
                <td>Permanent</td>
                <td class="text-start">
                    <span class="title1 inside_permanent"></span>
                    <div class="inside_permanent1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_permanent"></span>
                    <div class="outside_permanent1"></div>
                </td>
            </tr>

            <tr>
                <td>Probationary</td>
                <td class="text-start">
                    <span class="title1 inside_probationary"></span>
                    <div class="inside_probationary1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_probationary"></span>
                    <div class="outside_probationary1"></div>
                </td>
            </tr>

            <tr>
                <td>Contractuals</td>
                <td class="text-start">
                    <span class="title1 inside_contractuals"></span>
                    <div class="inside_contractuals1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_contractuals"></span>
                    <div class="outside_contractuals1"></div>
                </td>
            </tr>

            <tr>
                <td>Project Based</td>
                <td class="text-start">
                    <span class="title1 inside_project_based"></span>
                    <div class="inside_project_based1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_project_based"></span>
                    <div class="outside_project_based1"></div>
                </td>
            </tr>

            <tr>
                <td>Seasonal</td>
                <td class="text-start">
                    <span class="title1 inside_seasonal"></span>
                    <div class="inside_seasonal1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_seasonal"></span>
                    <div class="outside_seasonal1"></div>
                </td>
            </tr>
            <tr>
                <td>Job Order</td>
                <td class="text-start">
                    <span class="title1 inside_job_order"></span>
                    <div class="inside_job_order1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_job_order"></span>
                    <div class="outside_job_order1"></div>
                </td>
            </tr>
            <tr>
                <td>Mgt</td>
                <td class="text-start">
                    <span class="title1 inside_mgt"></span>
                    <div class="inside_mgt1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_mgt"></span>
                    <div class="outside_mgt1"></div>
                </td>
            </tr>
           
            <tr>
                <td><strong>Total</strong></td>
                <td><strong class="inside_total"></strong></td>
                <td><strong class="outside_total"></strong></td>
            </tr>
        </table>
    </div>
</div>
<script>
    var year_now;
var information_table = $('#table-information');
var survey_table = $('table.survey-information');
$(document).on('click', 'button.edit-information', function() {

    information_table.find('input[type=hidden]').prop("type", "text");
    information_table.find('select').attr('hidden', false)
    information_table.find('span.title').attr('hidden', true);
    $('.cancel-edit').removeClass('hidden');
    $('.submit').removeClass('hidden');
    $(this).addClass('hidden');
});

$(document).on('click', 'button.cancel-edit', function() {
    information_table.find('input[type=text]').prop("type", "hidden");
    information_table.find('span.title').attr('hidden', false);
    information_table.find('select').attr('hidden', true)
    $(this).addClass('hidden');
    $('.submit').addClass('hidden');
    $('button.edit-information').removeClass('hidden');
});


$(document).on('click', 'button.edit-survey', function() {
    survey_table.find('span.title1').attr('hidden', true);
    survey_table.find('input[type=hidden]').prop("type", "text");
    $('#select_year').attr('disabled', 'disabled');
    $('.cancel-edit-survey').removeClass('hidden');
    $('.submit-survey').removeClass('hidden');
    $(this).addClass('hidden');

});

$(document).on('click', 'button.cancel-edit-survey', function() {

    survey_table.find('input[type=text]').prop("type", "hidden");
    survey_table.find('span.title1').attr('hidden', false);
    survey_table.find('select#select_year').attr('disabled', false);
    $('#select_year').removeAttr('disabled');
    $('.cancel-edit-survey').removeClass('hidden');
    $('.submit-survey').addClass('hidden');
    $(this).addClass('hidden');
    $('button.edit-survey').removeClass('hidden');
});


$(document).on('click', 'button.submit', function() {
    let form = {
        establishment_id: $('input[name=establishment_id]').val(),
        establishment_code: $('input[name=establishment_code]').val(),
        establishment_name: $('input[name=establishment_name]').val(),
        street: $('input[name=street]').val(),
        barangay: $('select[name=barangay] :selected').val(),
        contact_number: $('input[name=phone_number]').val(),
        email_address: $('input[name=email_address]').val(),
        authorized_personnel: $('input[name=authorized_personnel]').val(),
        status: $('select#select_status :selected').val(),
        position: $('input[name=position]').val(),
    }

    $.ajax({
        url: base_url + '/admin/act/lls/u-e',
        method: 'POST',
        data: form,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function() {
            $('button.submit').prop('disabled', true);
            $('button.submit').html('<span class="loader"></span>')
        },
        success: function(data) {
            if (data.response) {
                toast_message_success(data.message);
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        },
        error: function(err) {
            alert('Something Wrong')
        }


    });
});

function load_survey_data($this) {
    survey($this.value);
}


function survey(year) {

    let items = {
        year: year,
        id: $('input[name=establishment_id]').val(),
    }

    $.ajax({
        url: base_url + '/admin/act/lls/get-survey',
        method: 'POST',
        data: items,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function() {
            $('#select_year').after('<span class="text-warning loading_survey" >Getting Survey...</span>');
        }
    }).done(function(resp) {
        $('span.loading_survey').remove();
        var table = $('table.survey-information');
        var result = Object.keys(resp).map((key) => [key, resp[key]]);
        $.each(result, function(i, row) {
            table.find('span.' + row[0]).text(row[1]);
            if (row[0] == 'inside_total' || row[0] == 'outside_total') {
                table.find('strong.' + row[0]).text(row[1]);
            }
            table.find('div.' + row[0] + '1').html('<input type="hidden" class="form-control" value="' +
                row[1] + '" name="' + row[0] + '"/>');;
        });

    }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('Something Wrong! Please Reload The Page')
    });
}



$(document).on('click', 'button.submit-survey', function() {
    let form = {
        establishment_id: $('input[name=establishment_id]').val(),
        year: $('select#select_year :selected').val(),
        inside_permanent: $('input[name=inside_permanent]').val(),
        inside_probationary: $('input[name=inside_probationary]').val(),
        inside_contractuals: $('input[name=inside_contractuals]').val(),
        inside_project_based: $('input[name=inside_project_based]').val(),
        inside_seasonal: $('input[name=inside_seasonal]').val(),
        inside_job_order: $('input[name=inside_job_order]').val(),
        inside_mgt: $('input[name=inside_mgt]').val(),
        outside_permanent: $('input[name=outside_permanent]').val(),
        outside_probationary: $('input[name=outside_probationary]').val(),
        outside_contractuals: $('input[name=outside_contractuals]').val(),
        outside_project_based: $('input[name=outside_project_based]').val(),
        outside_seasonal: $('input[name=outside_seasonal]').val(),
        outside_job_order: $('input[name=outside_job_order]').val(),
        outside_mgt: $('input[name=outside_mgt]').val(),
    }
    $.ajax({
        url: base_url + '/admin/act/lls/s-s',
        method: 'POST',
        data: form,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function() {
            $('button.submit-survey').prop('disabled', true);
            $('button.submit-survey').html('<span class="loader"></span>')
        },
        success: function(data) {
            if (data.response) {
                toast_message_success(data.message);
                year_now = $('select#select_year :selected').val();
                survey(year_now);
                survey_table.find('span.title1').attr('hidden', false);
                $('button.submit-survey').prop('disabled', false);
                $('button.submit-survey').text('Submit');
                // setTimeout(() => {
                //         location.reload();
                //     }, 1500);

            }
        },
        error: function(err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                $('button.submit-survey').prop('disabled', false);
                $('button.submit-survey').text('Submit');
                // $('.submit-loader').addClass('d-none');
                // // display errors on each form field
                $.each(err.responseJSON.errors, function(i, error) {
                    var el = survey_table.find('[name="' + i + '"]');
                    el.after($('<span style="color: red;" class="error">' + error[0] +
                        '</span>'));

                });
            }
        }
    });
});

$(document).ready(function() {
    $('button.edit-information').prop('disabled', false);
    $('button.edit-survey').prop('disabled', false);
    year_now = $('select#select_year :selected').val();
    survey(year_now);

});
</script>