@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @include('system.lls_whip.user.lls.reports.compliant_reports.sections.table')
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script>
var year;
 $("#calendar").yearpicker({
  onChange : function(value){
    year = value;
  }
});

$(document).on('click', 'button#by-year' , function(){
    $('#data-table-basic').DataTable().destroy();
    generate_compliant_report();
});


function generate_compliant_report(){

    $.ajax({
        url: base_url + '/admin/act/lls/generate-compliant-report',
        method: 'POST',
        data: {year : year},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend : function(){
            JsLoadingOverlay.show({
            'overlayBackgroundColor': '#666666',
            'overlayOpacity': 0.6,
            'spinnerIcon': 'pacman',
            'spinnerColor': '#000',
            'spinnerSize': '2x',
            'overlayIDName': 'overlay',
            'spinnerIDName': 'spinner',
         });
        },
        success: function(data) {
            JsLoadingOverlay.hide();
        $('#data-table-basic').DataTable({
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
        "data": data,
       
        columns: [
            {
                data: 'establishment_name'
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
                targets: 1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return row.is_compliant.percent;
                   
                }
            },
            {
                targets: 2,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return row.is_compliant.resp == true ? '<span class="badge notika-bg-success">Compliant</span>' : '<span class="badge notika-bg-danger">Not Compliant</span>';
                   
                }
            },

          

           
           
        ]

    });
        },
        error: function(err) {
            alert('Something Wrong')
        }


    });

}


</script>

@endsection