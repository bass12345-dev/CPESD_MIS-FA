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
@include('system.lls_whip.includes._js.new_location')
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
    $('select[name=province]').val('<?php echo $row->province; ?>');
    $('select[name=city]').val('<?php echo $row->city; ?>');
    $('select[name=barangay]').val('<?php echo $row->barangay; ?>');
});

$(document).on('click', 'button.cancel-edit', function() {
    $(this).addClass('hidden');
    $('.submit').addClass('hidden');
    $('button.edit-information').removeClass('hidden');
    $('input.title').prop('type','hidden');

});


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


    var province_options    = $("#province_select");
    var city_options        = $("#city_select");
    var brgy_options        = $("#brgy_select");

    function load_provinces(){
        province_options.append(new Option('Select Province', ''));
        $.ajax({url: 'https://psgc.cloud/api/provinces',method: 'GET',dataType :'json',beforeSend :  function(){province_options.after('<span class="text-warning loading_provinces" >Loading Provinces...</span><a href="javascript:;" class="refetch_provinces"></a>');}
        }).done(function(data) {
            $('span.loading_provinces').remove(); 
            $.each(data, function(i, row) {
                province_options.append(new Option(row.name, row.code+'-'+row.name));
            });    
            province_options.removeAttr('disabled');
        });
    }

    function load_cities(){
       

        $.ajax({url: 'https://psgc.cloud/api/cities-municipalities',method: 'GET',dataType :'json',beforeSend :  function(){city_options.after('<span class="text-warning loading_provinces" >Loading Provinces...</span><a href="javascript:;" class="refetch_provinces"></a>');}
        }).done(function(cities) {
            $('span.loading_cities').remove(); 
            var filteredMun = $(cities).filter(function(idx){
                return cities[idx].type === "Mun" 
            });
            var filteredCities = $(cities).filter(function(idx){
                return cities[idx].type === "City" 
            });
            var optgroup = "<optgroup label='Cities'>";
            $(filteredCities).each(function(){
                    name = this.name;
                    optgroup += "<option value='" + this.code + "-"+name+"'>" + name + "</option>"
            });
            optgroup += "</optgroup>"
            city_options.append(optgroup);

            var optgroup = "<optgroup label='Municipalities'>";
            $(filteredMun).each(function(){
                name = this.name;
                optgroup += "<option value='" + this.code + "-"+name+"'>" + name + "</option>"
            });
             optgroup += "</optgroup>"
             city_options.append(optgroup);
             city_options.prepend(new Option('Select City Or Municipalities', ''));
             $(`#city_select option[value='']`).prop('selected', true);
             city_options.removeAttr('disabled');
        });
    }
    load_cities();
    load_provinces();
</script>
@endsection