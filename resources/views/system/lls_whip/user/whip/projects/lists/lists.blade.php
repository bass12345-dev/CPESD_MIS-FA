@extends('system.lls_whip.user.whip_layout.whip_master')
@section('title', $title)
@section('content')
@include('system.lls_Whip.user.whip.projects.lists.sections.table')
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
            buttons: datatables_buttons(),
            ajax: {
                url: base_url + "/admin/act/whip/g-a-p",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                dataSrc: ""
            },
            columns: [{
                    data: 'project_id'
                },
                {
                    data: 'project_title'
                },
                {
                    data: 'contractor'
                },
                {
                    data: 'project_cost'
                },
                {
                    data: 'project_location'
                },
                {
                    data: null
                }
            ],
            'select': {
                'style': 'multi',
            },
            columnDefs: [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                },
                {
                    targets: 1,
                    data: null,
                    render: function(data, type, row) {
                        return '<a href="' + base_url + '/admin/whip/project-information/' + row.project_id + '" data-toggle="tooltip" data-placement="top" title="View ' + row.project_title + '">' + row.project_title + '</a>';
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return row.project_status == 'completed' ? 
                        '<span class="badge notika-bg-success">Completed</span>' :
                        '<span class="badge notika-bg-danger">Ongoing</span>';
                    }
                }
            ]

        });
    });


    $('button#multi-delete').on('click', function() {
        var button_text = 'Delete selected items';
        var text = '';
        var url = '/admin/act/whip/d-p';
        let items = get_select_items_datatable();
        var data = {
            id: items,
        };

        if (items.length == 0) {
            toast_message_error('Please Select at Least One')
        } else {
            delete_item(data, url, button_text, text, table);


        }

    });
</script>
@endsection