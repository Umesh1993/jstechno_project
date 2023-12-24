@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Attendance Register</h1>
                </div>
            </div>
            <form method="POST" action="{{url('dashboard')}}">
                @csrf
             <div class="row">
                <div class="col-lg-2">
                   <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-lg-2">
                   <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
                <button class="btn btn-success" type="submit" name="submit">Search</button>
            </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Attendance
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <?php 
                                                    if(!empty($days)){
                                                        foreach($days as $d){
                                                            ?>
                                                            <th><?php echo $d;?></th>
                                                     <?php  }
                                                    }?>
                                                    <th>Present Day</th>
                                                    <th>Absent Day</th>
                                                    <th>Working Day</th>
                                                    <th>Total Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                               if(!empty($attendanceSummary)){
                                                foreach($attendanceSummary as $a){
                                                  ?>
                                                            <tr>
                                                           <td>{{ucwords($a['employee_name'])}}</td>
                                                           <?php 
                                                            if(!empty($a['data'])){
                                                                foreach($a['data'] as $d){ ?>
                                                                    <td>{{$d['in_time'].'-'.$d['out_time']}}</td>
                                                            <?php  }
                                                            }?>
                                                           
                                                           <td>{{$a['presentDays']}}</td>
                                                           <td>{{$a['absentDays']}}</td>
                                                           <td>{{$a['working_day']}}</td>
                                                           <td>{{number_format($a['total_salary'],2)}}</td>
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
                                    </div>
                                   
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')