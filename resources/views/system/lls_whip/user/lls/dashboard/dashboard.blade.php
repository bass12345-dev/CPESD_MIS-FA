@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')
@include('system.lls_whip.user.lls.dashboard.sections.count1')
@include('system.lls_whip.user.lls.dashboard.sections.chart1')


@endsection

@section('js')

<script>



  function load_gender_inside_chart(){
    $.ajax({
      url: base_url +  "/admin/act/lls/c-b-g-i",
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        try {
            new Chart(document.getElementById("inside-gender-chart"), {
               type: 'pie',
               data: {
                  labels: data.label,
                  datasets: [{
                     label: '',
                     backgroundColor: data.color,
                     borderColor: 'rgb(23, 125, 255)',
                     data: data.total
                  }, ]
               },
              
            });
         } catch (error) {}
      },
      error: function (xhr, status, error) {},
   }); 
  }

  function load_gender_outside_chart(){
    $.ajax({
      url: base_url +  "/admin/act/lls/c-b-g-o",
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        try {
            new Chart(document.getElementById("outside-gender-chart"), {
               type: 'pie',
               data: {
                  labels: data.label,
                  datasets: [{
                     label: '',
                     backgroundColor: data.color,
                     borderColor: 'rgb(23, 125, 255)',
                     data: data.total
                  }, ]
               },
              
            });
         } catch (error) {}
      },
      error: function (xhr, status, error) {},
   }); 
  }
  load_gender_outside_chart()
  load_gender_inside_chart();
</script>

@endsection