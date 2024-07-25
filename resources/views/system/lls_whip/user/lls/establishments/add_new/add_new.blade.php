@extends('system.lls_whip.user.layout.user_master')
@section('title', $title)
@section('content')
@include('system.lls_whip.user.lls.establishments.add_new.sections.form')
@endsection
@section('js')
<script>
    $('#add_form').on('submit', function(e){
        e.preventDefault();
        table = null;
        $(this).find('button').prop('disabled',true);
        $(this).find('button').html('<span class="loader"></span>')
        var url = '/admin/act/lls/insert-es';
        let form = $(this);
        _insertAjax(url,form,table);
    });
</script>
@endsection

