@extends('system.lls_whip.user.whip_layout.whip_master')
@section('title', $title)
@section('content')
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            @include('system.lls_whip.user.whip.projects.view.employee_section.tables.employee_table')
        </div>
    </div>
</div>
@include('system.lls_whip.user.whip.projects.view.employee_section.modals.add_update_employee')
@include('system.lls_whip.user.lls.employees_records.lists.modals.add_employee_modal')
@endsection
@section('js')
@include('system.lls_whip.includes._js.location_js')
<script>


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
            url: base_url + "/admin/act/whip/g-p-e",
            method: 'POST',
            data: {
                id: $('input[name=project_id]').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },

        columns: [{
                data: 'contractor_employee_id'
            },

            {
                data: null
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
                data: 'start_date'
            },
            {
                data: 'end_date'
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
                targets: 2,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return capitalizeFirstLetter(row.gender);

                }
            },

            {
                targets: 5,
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
                    var result = row.level_of_employment.replaceAll('_', ' ');
                    return capitalizeFirstLetter(result);

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
                                data-start="' + row.start_date + '"\
                                data-end="' + row.end_date + '"\
                                data-level="' + row.level_of_employment + '"\
                                ><i class="fas fa-pen"></i></button> </div>\
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


$('#add_update_form').on('submit', function(e) {
    e.preventDefault();
        $(this).find('button[type="submit"]').prop('disabled', true);
        $(this).find('button[type="submit"]').html('<span class="loader"></span>')
        var url = '/admin/act/whip/i-u-e-e';
        let form = $(this);
        var status = $('select[name=employment_status] :selected').val();
        
        if(!form.find('input[name=establishment_employee_id]').val()){
        _insertAjax(url, form, table);
        
        }else {
            _updatetAjax(url, form, table);
        }
        setTimeout(() => {
            survey(year_now);
        }, 1000);        
});


$('#add_employee_form').on('submit', function(e) {
    e.preventDefault();
    $(this).find('button').prop('disabled', true);
    $(this).find('button').html('<span class="loader"></span>')
    var url = '/admin/act/lls/i-e';
    let form = $(this);
    _insertAjax(url, form, table);
});

$(document).on('change' , 'select[name=employment_status]', function(){
    var status = $('select[name=employment_status] :selected').val();
    if(status == 5){
        $('input[name=end]').prop('required' , false);
        $('input[name=end]').val('');
    }else {
        $('input[name=end]').prop('required' , true);
    }
});

</script>


@endsection