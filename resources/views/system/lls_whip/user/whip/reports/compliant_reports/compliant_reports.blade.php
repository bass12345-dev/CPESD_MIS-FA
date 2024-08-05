@extends('system.lls_whip.user.whip_layout.whip_master')
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

//  $("#calendar").yearpicker({
//   onChange : function(value){
//     year = value;
//   }
// });

$(document).on('click', 'button#by-year' , function(){
    $('#data-table-basic').DataTable().destroy();
    var date = $('input[name=select_month]').val();
    if(!date){
        toast_message_error('Please Select Month and Year');
    }else{
        generate_compliant_report(date);
    }
   
});


function generate_compliant_report(date){

    $.ajax({
        url: base_url + '/admin/act/lls/generate-compliant-report',
        method: 'POST',
        data: {date : date},
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
                data: null
            },
            {
                data: null
            },
            {
                data: null
            },
            
            {
                data: null
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
                targets: 0,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<a href="' + base_url + '/admin/lls/establishment/' + row
                        .establishment_id + '">' + row.establishment_name + '</a>'
                }
            },
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
            {
                targets: -3,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return row.is_compliant.total_inside;
                   
                }
            },

            {
                targets: -2,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return row.is_compliant.total_employee;
                   
                }
            },
            {
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<a href="javascript:; data-toggle="modal" data-target="#survey_modal">View Survey</a>';
                   
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