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
                    <h1 class="page-header">Edit Position</h1>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Edit
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{url('update-employee')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <label>Department Name</label>
                                        <select class="form-control" name="department_id" required>
                                            <option value="">Please select department</option>
                                            @foreach($department as $d)
                                             <option value="{{$d->id}}" {{$employee->department_id == $d->id ? 'selected':''}}>{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Position Name</label>
                                        <select class="form-control" name="position_id" required>
                                            <option value="">Please select position</option>
                                            @foreach($position as $p)
                                             <option value="{{$p->id}}"  {{$employee->position_id == $p->id ? 'selected':''}}>{{$p->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{isset($employee->name) ? $employee->name:''}}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{isset($employee->email) ? $employee->email:''}}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Phone no</label>
                                        <input type="text" name="phone_number" value="{{isset($employee->phone_number) ? $employee->phone_number:''}}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required="required">{{isset($employee->address) ? $employee->address:''}}</textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="hidden" name="id" value="{{isset($employee->id) ? $employee->id:''}}">
                                        <button type="submit" name="update" value="update" class="btn btn-success">Update</button>
                                        <a href="{{url('employee')}}" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')
