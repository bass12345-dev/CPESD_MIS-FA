<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card flex-fill p-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Contractor Information</h5>
            <button class="btn btn-primary edit-information" data-toggle="modal" data-target="#update_modal">Update</button>
        </div>
        <table class="table table-hover table-striped " style="width: 100%; ">
            <tr>
                <td>Contractor Name</td>
                <td class="text-start">{{$row->contractor_name}}<input type="hidden" name="con_id" value="{{$row->contractor_id}}"></td>
            </tr>
            <tr>
                <td>Proprietor</td>
                <td class="text-start">{{$row->proprietor}}</td>
            </tr>
            <tr>
                <td>Full Address</td>
                <td class="text-start">{{$full_address}}</td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td class="text-start">{{$row->phone_number}}</td>
            </tr>

            <tr>
                <td>Phone Number Owner</td>
                <td class="text-start">{{$row->phone_number_owner}}</td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td class="text-start">{{$row->telephone_number}}</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td class="text-start">{{$row->email_address}}</td>
            </tr>
           
            <tr>
                <td>Status</td>
                <td><span class="badge p-2 bg-danger">Pending</span></td>
            </tr>
        </table>
    </div>
</div>
