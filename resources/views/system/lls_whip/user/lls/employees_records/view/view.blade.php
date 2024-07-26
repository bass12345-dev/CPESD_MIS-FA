@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')

<div class="notika-status-area">
    <div class="container">
        <div class="row">
                @include('system.lls_whip.user.lls.employees_records.view.sections.employee_information')
                @include('system.lls_whip.user.lls.employees_records.view.sections.employment_history')
        </div>
    </div>
</div>
@endsection
@section('js')
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
            url: base_url + "/admin/act/lls/g-e-i",
            method: 'POST',
            data : {
                id : $('input[name=employee_id]').val(),
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
                data: 'position'
            },
            {
                data: 'nature_of_employment'
            },
            {
                data: 'status'
            },
            {
                data: 'level_of_employment'
            },
            {
                data: 'year_employed'
            },
           
           
           
           
        ],
        columnDefs: [

            {
                targets: 0,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<a href="'+base_url+'/admin/lls/establishment/'+row.establishment_id+'">'+row.establishment_name+'</a>';
                   
                }
            },

          

           
        ]

    });
});

</script>
@endsection