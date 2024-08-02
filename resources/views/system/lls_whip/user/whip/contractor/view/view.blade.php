@extends('system.lls_whip.user.whip_layout.whip_master')
@section('title', $title)
@section('content')
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            @include('system.lls_whip.user.whip.contractor.view.sections.information')
            @include('system.lls_whip.user.whip.contractor.view.projects_section.tables.projects_table')
        </div>
        
    </div>
</div>
@include('system.lls_whip.user.whip.contractor.view.projects_section.modals.add_project_modal')
@include('system.lls_whip.user.whip.contractor.view.sections.modals.update_contractor_modal')
@endsection
@section('js')
@include('system.lls_whip.includes._js.location_js')
<script>
     $(document).ready(function() {
		table =  $('#data-table-basic').DataTable({
            responsive: true,
            ordering: false,
            processing: true,
            searchDelay: 500,
            pageLength: 25,
            language: {
                "processing": '<div class="d-flex justify-content-center "><img class="top-logo mt-4" src="{{asset("assets/img/dts/peso_logo.png")}}"></div>'
            },
            "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
            {
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
            }, ],
            ajax: {
            url: base_url + "/admin/act/whip/g-c-p/"+$('input[name=con_id]').val(),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },
        columns: [
                {
                    data: 'project_title'
                }, {
                    data: 'project_cost'
                }, 
                {
                    data: 'project_location'
                },
                {
                    data: null
                }
            ],
            columnDefs: [
                {  targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return '<div class="progress">\
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
                            <span class="sr-only">100% Complete (success)</span>\
                        </div>\
                        </div>';
                }
            }]
           
         });
	});
$('#add_form').on('submit', function(e) {
    e.preventDefault();
    $(this).find('button').prop('disabled', true);
    $(this).find('button').html('<span class="loader"></span>');
    var url = '/admin/act/whip/insert-proj';
    let form = $(this);
    _insertAjax(url, form, table);

});



    


</script>

@endsection