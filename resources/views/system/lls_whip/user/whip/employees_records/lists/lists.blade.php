@extends('system.lls_whip.user.whip_layout.whip_master')
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
        columns: [
            {
                data: 'employee_id'
            },
            {
                data: null
            },
            {
                data: 'full_address'
            },
            {
                data: 'contact_number'
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
                    return '<a href="'+base_url+'/admin/lls/employee/'+row.employee_id+'">'+row.full_name+'</a>';
                   
                }
            },

          

           
           
        ]

    });
});


$('button#multi-delete').on('click', function() {

var button_text = 'Delete selected items';
var text = '';
var url = '/admin/act/lls/d-em';
let items = get_select_items_datatable();
var data = {
    id: items,
};

if (items.length == 0) {
    toast_message_error('Please Select at Least One')
} else {
    delete_item(data, url, button_text, text, table);
    

}

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