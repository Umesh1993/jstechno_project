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
                    <h1 class="page-header">Salary</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"><a href="{{url('create-salary')}}" class="btn btn-primary">ADD NEW</a></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Salary List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Position Name</th>
                                                    <th>Basic Salary</th>
                                                    <th>HRA</th>
                                                    <th>DA</th>
                                                    <th>Other Allowance</th>
                                                    <th>Gross Salary</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($salary->count() > 0)
                                                     @foreach($salary as $s)
                                                        <tr>
                                                           <td>{{ucwords($s->position->name)}}</td>
                                                            <td>{{$s->basic_salery}}</td>
                                                            <td>{{$s->hra}}</td>
                                                            <td>{{$s->da}}</td>
                                                            <td>{{$s->other_allowances}}</td>
                                                            <td>{{$s->gross_salary}}</td>
                                                            <td><a href="{{url('edit-salary/'.$s->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                            <a href="{{url('delete-salary/'.$s->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
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