<div class="modal animated bounce" id="add_employee_modal" role="dialog">
    <div class="modal-dialog modal-lg">
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
                                    <h2>Add Employee</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-support"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="hidden" value="{{$row->establishment_id}}"
                                                    class="form-control" name="establishment_id" required>
                                                <input type="hidden" class="form-control" name="employee_id"
                                                    placeholder="ID" required>
                                                <div id="the-basics">
                                                    <input class="typeahead form-control" type="text" name="employee"
                                                        placeholder="Search Employee" required style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-map"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control" name="employment_nature" required>
                                                    <option value="" selected>Select Nature of Employment</option>
                                                    <?php foreach($nature_of_employment as $row):?>
                                                    <option value="{{$row[0]}}">{{$row[1]}}</option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                <select class="form-control" name="position" required>
                                                    <option value="" selected>Select Position</option>
                                                    <?php foreach($positions as $row):?>
                                                    <option value="{{$row->position_id}}">{{$row->position}}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-mail"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control" name="employment_status" required>
                                                    <option value="" selected>Select Employment Status</option>
                                                    <?php foreach($employment_status as $row):?>
                                                    <option value="{{$row->employ_stat_id}}">{{$row->status}}</option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                <select class="form-control" id="year_employed" name="year_employed"
                                                    required>
                                                    <option value="" selected>Select Year of Employed</option>
                                                    <?php
                                                        for ($i=2021; $i <= 2050; $i++) { 
                                                            $selected = $i == $year_now ? 'selected' : '';
                                                        echo ' <option '.$selected.'>'.$i.'</option>';
                                                        }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-map"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <select class="form-control" name="employment_level" required>
                                                    <option value="" selected>Select Level of Employment</option>
                                                    <?php foreach($level_of_employment as $row):?>
                                                    <option value="{{$row[0]}}">{{$row[1]}}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-example-int mg-t-15">
                                    <button type="submit" class="btn btn-primary notika-btn-success">Submit</button>
                                </div>


                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>