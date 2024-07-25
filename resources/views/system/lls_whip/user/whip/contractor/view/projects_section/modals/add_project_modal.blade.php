<div class="modal animated bounce" id="myModalfour" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-element-list">
                                <div class="basic-tb-hd">
                                    <h2>Add Project</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-support"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="hidden" name="contractor_id" value="{{$row->contractor_id}}">
                                                <input type="text" class="form-control" name="project_title"
                                                    placeholder="Project Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-mail"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="project_cost"
                                                    placeholder="Project Cost">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-map"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control province_select" name="province"
                                                    id="province_select" disabled></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-map"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control" id="city_select" name="city"
                                                    disabled></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-travel"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control" id="brgy_select" name="barangay"
                                                    disabled></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-mail"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="street"
                                                    placeholder="Street">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>