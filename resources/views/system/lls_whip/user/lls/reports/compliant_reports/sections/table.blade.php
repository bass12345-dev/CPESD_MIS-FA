    <!-- Data Table area Start-->

    <div class="data-table-list">
        <div class="basic-tb-hd">
            <h2>{{$title}}</h2>
            <div class="row">
                <div class="col-md-6" style="display:flex;">
                    <input id='calendar' class="form-control yearpicker" />
                    <button class="btn btn-success" id="by-month" style="margin-left:5px; padding-right: 46px;">Generate Report</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>Establishment</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>