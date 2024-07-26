<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card flex-fill p-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Employee Information</h5>
            <button class="btn btn-primary edit-information" disabled>Edit Info</button>
            <button class="btn btn-danger cancel-edit hidden">Cancel Edit</button>
            <button class="btn btn-success submit hidden">Submit</button>
        </div>
        <input type="hidden" name="employee_id" value="{{$row->employee_id}}">
        <table class="table table-hover table-striped table-information " id="table-information" style="width: 100%; ">

            <tr>
                <td>Full Name</td>
                <td class="text-start"><span class="title">{{$title}} </span>
                    <input type="hidden" class="form-control mb-5" name="first_name" placeholder="First Name"
                        value="{{$row->first_name}}">
                    <input type="hidden" class="form-control mb-5" name="middle_name" placeholder="Middle Name"
                        value="{{$row->middle_name}}">
                    <input type="hidden" class="form-control mb-5" name="last_name" placeholder="Last Name"
                        value="{{$row->last_name}}">
                    <input type="hidden" class="form-control mb-5" name="extension" placeholder="Extension"
                        value="{{$row->extension}}">
                </td>
            </tr>

            <tr>
                <td>Full Address</td>
                <td class="text-start"><span class="title">{{$full_address}} </span>
                    <input type="hidden" class="form-control mb-5" name="province" placeholder="Province"
                        value="{{explode("-", $row->province)[1]}}">
                    <input type="hidden" class="form-control mb-5" name="city" placeholder="City"
                        value="{{explode("-", $row->city)[1]}}">
                    <input type="hidden" class="form-control mb-5" name="barangay" placeholder="Barangay"
                        value="{{ $row->barangay == NULL  ? '' : explode("-", $row->barangay)[1]}}">
                    <input type="hidden" class="form-control mb-5" name="street" placeholder="Street"
                        value="{{$row->street}}">
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td class="text-start"><span class="title">{{$row->contact_number}}</span>
                    <input type="hidden" class="form-control" name="contact_number" value="{{$row->contact_number}}">
                </td>
            </tr>

        </table>
    </div>
</div>