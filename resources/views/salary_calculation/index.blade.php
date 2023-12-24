@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if($errors->any())
                        <div class="alert alert-danger" style="margin-top:25px">
                        {{$errors->first()}}
                        </div>
                    @endif
                    <h1 class="page-header">Salary Register</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"><a href="{{url('salary-calculation')}}" class="btn btn-primary">Salary Calculation</a></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Salary List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table  id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <th>Calculation Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 
                                                @if($salarycalc->count() > 0)
                                                 @foreach($salarycalc as $s)
                                                 <?php 
                                                 $date = explode('to',$s->calculation_date); ?>
                                                    <tr>
                                                        <td>{{ucwords($s->employee->name)}}</td>
                                                        <td>{{date('d-m-Y',strtotime($date[0])).' To '.date('d-m-Y',strtotime($date[1]))}}</td>
                                                        <td>{{$s->status}}</td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                 <tr>
                                                    <td colspan="3">No Data Found</td>
                                                 </tr>
                                                @endif
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