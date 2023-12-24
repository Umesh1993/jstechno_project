@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    @if($errors->any())
                        <div class="alert alert-danger" style="margin-top:25px">
                        {{$errors->first()}}
                        </div>
                    @endif
                    <h1 class="page-header">Attendance</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"><a href="{{url('create-attendance')}}" class="btn btn-primary">ADD IN & OUT </a></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Attendance List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <th>IN Time</th>
                                                    <th>OUT Time</th>
                                                    <th>Created at</th>
                                                    <th>Modified at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($attendance->count() > 0)
                                                     @foreach($attendance as $a)
                                                        <tr>
                                                           <td>{{ucwords($a->employee->name)}}</td>
                                                           <td>{{isset($a->in_time) ? date('H:i A',strtotime($a->in_time)):''}}</td>
                                                            <td>{{isset($a->out_time) ? date('H:i A',strtotime($a->out_time)):''}}</td>
                                                            <td>{{date('d-m-Y H:i:s',strtotime($a->created_at))}}</td>
                                                            <td>{{date('d-m-Y H:i:s',strtotime($a->updated_at))}}</td>
                                                            <td><a href="{{url('delete-attendance/'.$a->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6">No Data Found</td>
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