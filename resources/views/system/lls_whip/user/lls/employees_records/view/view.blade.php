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


</script>
@endsection