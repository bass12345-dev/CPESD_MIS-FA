@extends('system.lls_whip.user.whip_layout.whip_master')
@section('title', $title)
@section('content')
@include('system.lls_whip.user.whip.contractor.add_new.sections.form')
@endsection
@section('js')
@include('system.lls_whip.includes._js.location_js')
<script>
    $('#add_form').on('submit', function(e){
        e.preventDefault();
        table = null;
        $(this).find('button').prop('disabled',true);
        $(this).find('button').html('<span class="loader"></span>')
        var url = '/admin/act/whip/insert-contr';
        let form = $(this);
        _insertAjax(url,form,table);

    });
    
</script>
@endsection
