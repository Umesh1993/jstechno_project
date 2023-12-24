@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Salary Register</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Salary Register List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <form action="{{url('insert-salarycalc')}}" method="post">
                                        @csrf
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <th>Month salary</th>
                                                    <th>Present Day</th>
                                                    <th>Absent Day</th>
                                                    <th>Working Day</th>
                                                    <th>Total Salary</th>
                                                    <th>Status</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                               if(!empty($attendanceSummary)){
                                                foreach($attendanceSummary as $key => $a){
                                                  ?>
                                                        <tr>
                                                           <td>{{ucwords($a['employee_name'])}}
                                                            <input type="hidden" name="salary_calc[{{$key}}][employee_id]" value="{{$a['employee_id']}}">
                                                            <input type="hidden" name="salary_calc[{{$key}}][calculate_date]" value="{{$a['start_month'].' to '.$a['end_month']}}">
                                                           </td>
                                                           <td>{{date('d-m-Y',strtotime($a['start_month'])).' TO '.date('d-m-Y',strtotime($a['end_month']))}}</td>
                                                           <td>{{$a['presentDays']}}</td>
                                                           <td>{{$a['absentDays']}}</td>
                                                           <td>{{$a['working_day']}}</td>
                                                           <td>{{number_format($a['total_salary'],2)}}</td>
                                                           <td>{{$a['status']}}</td>
                                                        </tr>  
                                          <?php   }
                                               }else{
                                               ?>
                                               <tr>
                                                        <td colspan="7">No Data Found</td>
                                                    </tr>
                                               <?php }?>
                                        
                                            </tbody>
                                        </table>
                                     <button type="submit" name="submit" value="submit" class="btn btn-success">Salary submit</button>
                                    </form>
                                    </div>
                                   
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')