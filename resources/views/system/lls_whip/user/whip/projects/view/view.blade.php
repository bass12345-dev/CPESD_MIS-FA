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
@include('system.lls_whip.includes._js.typeahead_search_employee')
@include('system.lls_whip.includes._js.add_employee_ajax')
@include('system.lls_whip.includes._js.employment_is_required')
<script>


//Table
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
                    return '<a href="' + base_url + '/admin/whip/employee/' + row.employee_id +
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
                                <div ><button class="btn btn-success update-project-employee" data-toggle="modal" data-target="#add_employee_modal" \
                                data-id="' + row.contractor_employee_id + '"\
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


//UpdateoNClick
$(document).on('click', 'button.update-project-employee', function() {
    $('form#add_update_form').find('input[name=contractor_employee_id]').val($(this).data('id'));
    var status = $(this).data('status');
    var employee_name = $(this).data('employee-name');
    $('input[name=employee_id]').val($(this).data('employee-id'))
    $('input[name=employee]').val(employee_name).attr('disabled',true);
    $('h2.title').text(employee_name);
    $('select[name=employment_nature]').val($(this).data('nature'));
    $('select[name=position]').val($(this).data('position'));
    $('select[name=employment_status]').val(status);
    $('select[name=employment_level]').val($(this).data('level'));
    $('input[name=start]').val(moment($(this).data('start')).format('YYYY-MM'));
    var end = $(this).data('end') === '-' ? '' : $(this).data('end');
    $('input[name=end]').val(moment(end).format('YYYY-MM'));
    if(status != 5){
        $('input[name=end]').prop('required' , true);
    }else {
        $('input[name=end]').prop('required' , false);
    }
});

//Add Update Project Employee
$('#add_update_form').on('submit', function(e) {
    e.preventDefault();
        $(this).find('button[type="submit"]').prop('disabled', true);
        $(this).find('button[type="submit"]').html('<span class="loader"></span>')
        var url = '/admin/act/whip/i-u-p-e';
        let form = $(this);
        var status = $('select[name=employment_status] :selected').val();
        
        if(!form.find('input[name=contractor_employee_id]').val()){
        _insertAjax(url, form, table);
        }else {
            _updatetAjax(url, form, table);
        }
});

$('button#multi-delete').on('click', function() {
    var button_text = 'Delete selected items';
    var text = '';
    var url = '/admin/act/whip/d-p-e';
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

</script>


@endsection