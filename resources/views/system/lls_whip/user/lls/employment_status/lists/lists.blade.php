@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')

<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                @include('system.lls_whip.user.lls.employment_status.lists.sections.table')
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                @include('system.lls_whip.user.lls.employment_status.lists.sections.add_form')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
            url: base_url + "/admin/act/lls/a-e-s",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataSrc: ""
        },
        columns: [
                {
                    data: 'status'
                },
                {
                    data: 'created'
                },
                {
                    data: null
                },
            ],
            columnDefs: [{
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function (data, type, row) {
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

    
     $('#add_form').on('submit', function(e){
        e.preventDefault();
        $(this).find('button').prop('disabled',true);
        $(this).find('button').html('<span class="loader"></span>')
        var url = '/admin/act/lls/i-e-s';
        let form = $(this);
        _insertAjax(url,form,table);
    });

  


</script>
@endsection