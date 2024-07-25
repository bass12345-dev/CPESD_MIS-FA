<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card flex-fill p-3">
        <div class="card-header ">
            <h5 class="card-title mb-0">Latest Report/Survey</h5>
            <div class="row">
                <div class="col-md-9" style="margin-bottom: 10px;" >
                    <button class="btn btn-primary edit-survey " disabled>Edit Survey</button>
                    <button class="btn btn-danger cancel-edit-survey hidden" >Cancel Edit</button>
                    <button class="btn btn-success submit-survey hidden" >Submit</button>
                </div>
                
                <div class="col-md-3" >
                    <select class="form-control" id="select_year" onchange="load_survey_data(this)">
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
        <table class="table table-hover table-striped survey-information"  id="survey-information" style="width: 100%;margin-top: 10px; ">
       
            <tr class="info">
                <td></td>
                <td><strong>Inside</strong></td>
                <td><strong>Outside</strong></td>
            </tr>
            <tr>
                <td>Permanent</td>
                <td class="text-start">
                    <span class="title1 inside_permanent"></span>
                    <div class="inside_permanent1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_permanent"></span>
                    <div class="outside_permanent1"></div>
                </td>
            </tr>

            <tr>
                <td>Probationary</td>
                <td class="text-start">
                    <span class="title1 inside_probationary"></span>
                    <div class="inside_probationary1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_probationary"></span>
                    <div class="outside_probationary1"></div>
                </td>
            </tr>

            <tr>
                <td>Contractuals</td>
                <td class="text-start">
                    <span class="title1 inside_contractuals"></span>
                    <div class="inside_contractuals1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_contractuals"></span>
                    <div class="outside_contractuals1"></div>
                </td>
            </tr>

            <tr>
                <td>Project Based</td>
                <td class="text-start">
                    <span class="title1 inside_project_based"></span>
                    <div class="inside_project_based1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_project_based"></span>
                    <div class="outside_project_based1"></div>
                </td>
            </tr>

            <tr>
                <td>Seasonal</td>
                <td class="text-start">
                    <span class="title1 inside_seasonal"></span>
                    <div class="inside_seasonal1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_seasonal"></span>
                    <div class="outside_seasonal1"></div>
                </td>
            </tr>
            <tr>
                <td>Job Order</td>
                <td class="text-start">
                    <span class="title1 inside_job_order"></span>
                    <div class="inside_job_order1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_job_order"></span>
                    <div class="outside_job_order1"></div>
                </td>
            </tr>
            <tr>
                <td>Mgt</td>
                <td class="text-start">
                    <span class="title1 inside_mgt"></span>
                    <div class="inside_mgt1"></div>
                </td>
                <td class="text-start">
                    <span class="title1 outside_mgt"></span>
                    <div class="outside_mgt1"></div>
                </td>
            </tr>
           
            <tr>
                <td><strong>Total</strong></td>
                <td><strong class="inside_total"></strong></td>
                <td><strong class="outside_total"></strong></td>
            </tr>
        </table>
    </div>
</div>
