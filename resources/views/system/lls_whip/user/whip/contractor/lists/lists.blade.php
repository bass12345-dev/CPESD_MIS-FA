@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')
@include('system.lls_whip.user.whip.contractor.lists.sections.table')
@endsection
@section('js')
<script>
   $(document).ready(function() {
		 $('#data-table-basic').DataTable({
            responsive: true,
            ordering: false,
            processing: true,
            searchDelay: 500,
            pageLength: 10,
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
            url: base_url + "/admin/act/whip/g-a-c",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },
        columns: [{
                    data: null
                }, {
                    data: 'proprietor'
                }, 
                {
                    data: 'full_address'
                },
                {
                    data: 'phone_number'
                },{
                    data: 'phone_number_owner'
                }, {
                    data: 'telephone_number'
                }, {
                    data: 'email_address'
                }, 
                {
                    data: 'status'
                },
                {
                    data: null
                },
            ],
            columnDefs: [
                {
                    targets: 0,
                    data: null,
                    render: function (data, type, row) {
                        return '<a href="'+base_url+'/admin/whip/contractor-information/'+row.contractor_id+'" data-toggle="tooltip" data-placement="top" title="View ' + row.contractor_name + '">' + row.contractor_name + '</a>';
                    }
                },
                {
                    targets: -2,
                    data: null,
                    render: function (data, type, row) {
                        return row.status == 'active' ? '<span class="badge notika-bg-success">Active</span>' : '<span class="badge notika-bg-danger">InActive</span>';
                    }
                },
                {  targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return '<div class="dropdown">\
                            <button class="btn btn-primary" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                                Actions\
                                <span class="caret"></span>\
                            </button>\
                            <ul class="dropdown-menu bg-danger" aria-labelledby="dLabel">\
                                <li class="bg-danger"><a href="'+base_url+'/whip/user/contractor-information/'+row.contractor_id+'" ><i class="notika-icon notika-plus-symbol"></i> Add Projects</a></li>\
                            </ul>\
                            </div>';
                }
            }]

         });
	});
</script>
@endsection