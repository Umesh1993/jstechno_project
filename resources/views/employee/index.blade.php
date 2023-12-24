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
                    <h1 class="page-header">Employee</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"><a href="{{url('create-employee')}}" class="btn btn-primary">ADD NEW</a></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Employee List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Department Name</th>
                                                    <th>Position Name</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($employee->count() > 0)
                                                     @foreach($employee as $e)
                                                        <tr>
                                                           <td>{{ucwords($e->department->name)}}</td>
                                                           <td>{{ucwords($e->position->name)}}</td>
                                                            <td>{{ucwords($e->name)}}</td>
                                                            <td>{{$e->email}}</td>
                                                            <td>{{$e->phone_number}}</td>
                                                            <td>{{nl2br($e->address)}}</td>
                                                            <td><a href="{{url('edit-employee/'.$e->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                            <a href="{{url('delete-employee/'.$e->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7">No Data Found</td>
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