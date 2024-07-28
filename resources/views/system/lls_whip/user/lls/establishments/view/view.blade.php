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
@include('system.lls_whip.user.lls.establishments.view.modals.add_update_employee')
@include('system.lls_whip.user.lls.employees_records.lists.modals.add_employee_modal')

@endsection
@section('js')
@include('system.lls_whip.includes._js.location_js')
<script>
var information_table = $('#table-information');
var year_now;
var survey_table = $('table.survey-information');
$(document).ready(function() {
    $('button.edit-information').prop('disabled', false);
    $('button.edit-survey').prop('disabled', false);
    year_now = $('select#select_year :selected').val();
    survey(year_now);

});
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



$('button#multi-delete').on('click', function() {
    var button_text = 'Delete selected items';
    var text = '';
    var url = '/admin/act/lls/d-e-e';
    let items = get_select_items_datatable();
    var data = {
        id: items,
    };

    if (items.length == 0) {
        toast_message_error('Please Select at Least One')
    } else {
        delete_item(data, url, button_text, text, table);
        year_now = $('select#select_year :selected').val();
        setTimeout(() => {
            survey(year_now);
        }, 1000);
    }

});


$(document).on('click', 'button.add-employee', function() {
    $('h2.title').text('Add Employee');
});


$('#add_form').on('submit', function(e) {
    e.preventDefault();

    $(this).find('button[type="submit"]').prop('disabled', true);
    $(this).find('button[type="submit"]').html('<span class="loader"></span>')
    var url = '/admin/act/lls/i-u-e-e';
    let form = $(this);
    _insertAjax(url, form, table);
    setTimeout(() => {
        survey(year_now);
    }, 1000);


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
        url: base_url + '/admin/act/lls/g-e-s',
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

        });

    }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('Something Wrong! Please Reload The Page')
    });
}


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
        buttons: datatables_buttons(),
        ajax: {
            url: base_url + "/admin/act/lls/g-a-e-e",
            method: 'POST',
            data: {
                id: $('input[name=establishment_id]').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },
        columns: [{
                data: 'establishment_employee_id'
            },

            {
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
        'select': {
            'style': 'multi',
        },
        columnDefs: [{
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            },

            {
                targets: 1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<a href="' + base_url + '/admin/lls/employee/' + row.employee_id +
                        '">' + row.full_name + '</a>';

                }
            },

            {
                targets: 4,
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
                                <div ><button class="btn btn-success update-establishment-employee" data-toggle="modal" data-target="#add_employee_modal" \
                                data-id="' + row.establishment_employee_id + '"\
                                data-employee-id="' + row.employee_id + '"\
                                data-employee-name="' + row.full_name + '"\
                                data-nature="' + row.nature_of_employment + '"\
                                data-position="' + row.position_id+ '"\
                                data-status="' + row.status_id + '"\
                                data-year="' + row.year_employed + '"\
                                data-level="' + row.level_of_employment + '"\
                                ><i class="fas fa-pen"></i></button> </div>\
                                </div>\
                                ';
                }
            }
        ]

    });
});

$(document).on('click', 'button.update-establishment-employee', function() {
    $('form#add_form').find('input[name=establishment_employee_id]').val($(this).data('id'));
    // $('.name_section').remove();
    $('input[name=employee_id]').val($(this).data('employee-id'))
    $('input[name=employee]').val($(this).data('employee-name')).attr('disabled',true);
    $('h2.title').text($(this).data('employee-name'));
    $('select[name=employment_nature]').val($(this).data('nature'));
    $('select[name=position]').val($(this).data('position'));
    $('select[name=employment_status]').val($(this).data('status'));
    $('select[name=year_employed]').val($(this).data('year'));
    $('select[name=employment_level]').val($(this).data('level'));
    
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
            '<div class="tt-suggestion tt-selectable">No Record <i class="fa-regular fa-face-sad-tear"></i> <a href="javascript:;" data-toggle="modal" data-target="#add_employee_modal1">Add New Record</a></div>'
        ].join('\n'),
        suggestion: function(data) {
            return '<li>' + data.full_name + '</li>'
        }
    },
}).bind('typeahead:selected', function(obj, data, name) {
    $('input[name="employee_id"]').val(data.employee_id);
    $('input[name="employee"]').val(data.full_name);
});



$('#add_employee_form').on('submit', function(e) {
    e.preventDefault();
    $(this).find('button').prop('disabled', true);
    $(this).find('button').html('<span class="loader"></span>')
    var url = '/admin/act/lls/i-e';
    let form = $(this);
    _insertAjax(url, form, table);
});
</script>
@endsection