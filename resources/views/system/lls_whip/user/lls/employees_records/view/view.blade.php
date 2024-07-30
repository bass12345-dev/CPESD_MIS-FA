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
    $('button.edit-information').prop('disabled', false);
    $('button.edit-survey').prop('disabled', false);
});
$(document).on('click', 'button.edit-information', function() {
    $('.cancel-edit').removeClass('hidden');
    $('.submit').removeClass('hidden');
    $(this).addClass('hidden');
    $('input.title').prop('type','text');
    var province = '<?php echo $row->province; ?>'.split("-")[0];
    $('select[name=province]').val(province);
    // var city = '<?php echo $row->city; ?>'.split("-")[0];
    // $('select[name=city]').val(city);
    
});

$(document).on('click', 'button.cancel-edit', function() {
    $(this).addClass('hidden');
    $('.submit').addClass('hidden');
    $('button.edit-information').removeClass('hidden');
    $('input.title').prop('type','hidden');

});


$(document).ready(function() {
    table = $('#data-table-basic').DataTable({
        
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
                    return '<a href="'+base_url+'/admin/lls/establishment/'+row.establishment_id+'">'+row.establishment_name+'</a>';
                   
                }
            },
            {
                targets: -3,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    var result = row.level_of_employment.replaceAll('_', ' ');
                    return capitalizeFirstLetter(result);

                }
            },

            {
                targets: -2,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return moment(row.start_date).format('MMMM YYYY');

                }
            },
            {
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return row.end_date == null ? '-' :  moment(row.end_date).format('MMMM YYYY');

                }
            },
            
           
        ]

    });
});


var province_options    = $("#province_select");
var city_options        = $("#city_select");
var brgy_options        = $("#brgy_select");






function load_provinces(){
        province_options.append(new Option('Select Province', ''));
        $.ajax({url: 'https://psgc.cloud/api/provinces',method: 'GET',dataType :'json',beforeSend :  function(){province_options.after('<span class="text-warning loading_provinces" >Loading Provinces...</span><a href="javascript:;" class="refetch_provinces"></a>');}
        }).done(function(data) {
            $('span.loading_provinces').remove(); 
            $.each(data, function(i, row) {
                province_options.append(new Option(row.name, row.code));
            });    
            province_options.removeAttr('disabled');
        });
    }

// function load_mun_cit(){
//         city_options.append(new Option('Select City', ''));
//         $.ajax({url: 'https://psgc.cloud/api/cities',method: 'GET',dataType :'json',beforeSend :  function(){city_options.after('<span class="text-warning loading_provinces" >Loading Cities...</span><a href="javascript:;" class="refetch_provinces"></a>');}
//         }).done(function(data) {
//             $('span.loading_provinces').remove(); 
//             $.each(data, function(i, row) {
//                 city_options.append(new Option(row.name, row.code));
//             });    
//                 city_options.removeAttr('disabled');
//         });
// }

// function load_barangays(){
//         brgy_options.append(new Option('Select Barangays', ''));
//         $.ajax({url: 'https://psgc.cloud/api/barangays',method: 'GET',dataType :'json',beforeSend :  function(){brgy_options.after('<span class="text-warning loading_provinces" >Loading Barangays...</span><a href="javascript:;" class="refetch_provinces"></a>');}
//         }).done(function(data) {
//             $('span.loading_provinces').remove(); 
//             $.each(data, function(i, row) {
//                 brgy_options.append(new Option(row.name, row.code));
//             });    
//                 brgy_options.removeAttr('disabled');
//         });
// }

    
    
// load_barangays()
// load_provinces();
load_mun_cit();

</script>
@endsection