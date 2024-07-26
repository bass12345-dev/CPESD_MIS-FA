@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')
<div class="notika-status-area">

    <div class="container">
        @include('components.lls.header_title_container')
        <div class="row">
            @include('system.lls_whip.user.lls.establishments.view.sections.information')
            @include('system.lls_whip.user.lls.establishments.view.sections.survey')
        </div>
        <hr>
        <div class="row">
            @include('system.lls_whip.user.lls.establishments.view.sections.employee_table')
        </div>
    </div>
</div>
@include('system.lls_whip.user.lls.establishments.view.modals.add_employee')
@endsection
@section('js')
@include('system.lls_whip.includes._js._js')
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
    table = $('#data-table-basic').DataTable({
        responsive: true,
        ordering: false,
        processing: true,
        searchDelay: 500,
        pageLength: 25,
        language: {
            "processing": '<div class="d-flex justify-content-center "><img class="top-logo mt-4" src="{{asset("assets/img/dts/peso_logo.png")}}"></div>'
        },
        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
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
        ],
        ajax: {
            url: base_url + "/admin/act/lls/g-a-e-e",
            method: 'POST',
            data : {
                id : $('input[name=establishment_id]').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },
        columns: [{
                data: null
            },
            {
                data: 'full_address'
            },
            {
                data: 'position'
            },
            {
                data: null
            },
            {
                data: 'status_of_employment'
            },
            {
                data: 'year_employed'
            },
            {
                data: null
            },
            {
                data: null
            },
        ],
        columnDefs: [

            {
                targets: 0,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<a href="'+base_url+'/admin/lls/employee/'+row.employee_id+'">'+row.full_name+'</a>';
                   
                }
            },

            {
                targets: 3,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return capitalizeFirstLetter(row.nature_of_employment);
                   
                }
            },
            {
                targets: -2,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return capitalizeFirstLetter(row.level_of_employment);
                   
                }
            },

            {
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    //return '<button class="btn btn-success">Update</button> <button class="btn btn-success">Delete</button>';
                    return '<div class="actions">\
                                <div ><button class="btn btn-success">Update</button> </div>\
                                <div ><button class="btn btn-danger">Delete</button> </div>\
                                </div>\
                                ';
                }
            }
        ]

    });
});


$('#the-basics .typeahead').typeahead({
    hint: true,
    highlight: true,
    minLength: 1
}, {
    name: 'states',
    source: function(query, process, processAsync) {

        return $.ajax({
            url: base_url + '/admin/act/lls/search-query?key=' + $('input[name="employee"]').val(),
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                /**
                 * Capitalize eveery first letter 
                 *
                 * @param {Object}  data from back end
                 *
                 * @returns {Object}
                 */
                processAsync($.map(data, function(row) {
                    var full_name = row.first_name + ' ' + row.middle_name + ' ' +
                        row.last_name + ' ' + row.extension;
                    full_name = capitalizeFirstLetter(full_name);


                    return [{
                        'employee_id': row.employee_id,
                        'full_name': full_name
                    }];
                }));
            },
            error: function(jqXHR, except) {}
        });

    },
    name: 'employee',
    displayKey: 'full_name',
    templates: {
        header: '<div class="header-typeahead">Employees</div>',
        empty: [
            '<div class="tt-suggestion tt-selectable">No Record <i class="fa-regular fa-face-sad-tear"></i> <a href="javascript:;">Add New Record</a></div>'
        ].join('\n'),
        suggestion: function(data) {
            return '<li>' + data.full_name + '</li>'
        }
    },
}).bind('typeahead:selected', function(obj, data, name) {
    $('input[name="employee_id"]').val(data.employee_id);
});


$('#add_form').on('submit', function(e) {
    e.preventDefault();
    $(this).find('button').prop('disabled', true);
    $(this).find('button').html('<span class="loader"></span>')
    var url = '/admin/act/lls/i-e-e';
    let form = $(this);
    _insertAjax(url, form, table);
});



$(document).ready(function() {
    $('button.edit-information').prop('disabled', false);
    $('button.edit-survey').prop('disabled', false);
    year_now = $('select#select_year :selected').val();
    survey(year_now);

});
</script>
@endsection