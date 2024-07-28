@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')

<div class="notika-status-area">
    <div class="container">
        <div class="row">
                @include('system.lls_whip.user.lls.employees_records.lists.sections.table')
        </div>
    </div>
</div>
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
            url: base_url + "/admin/act/lls/g-a-em",
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
                data: 'contact_number'
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
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    //return '<button class="btn btn-success">Update</button> <button class="btn btn-success">Delete</button>';
                    return '<div class="actions">\
                                <div ><button class="btn btn-danger">Delete</button> </div>\
                                </div>\
                                ';
                }
            }
        ]

    });
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