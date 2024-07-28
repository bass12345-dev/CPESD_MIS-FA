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
 $("#calendar").yearpicker({
  onChange : function(value){
   
  }
});


</script>

@endsection