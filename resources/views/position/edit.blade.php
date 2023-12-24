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
                        <form method="POST" action="{{url('update-position')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                   <div class="form-group col-lg-6">
                                        <label>Department Name</label>
                                        <select class="form-control" name="department_id" required>
                                            <option value="">Please select department</option>
                                            @foreach($department as $d)
                                             <option value="{{$d->id}}" {{$position->department_id == $d->id ? 'selected':''}}>{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{isset($position->name) ? $position->name:''}}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="hidden" name="id" value="{{isset($position->id) ? $position->id:''}}">
                                        <button type="submit" name="update" value="update" class="btn btn-success">Update</button>
                                        <a href="{{url('position')}}" class="btn btn-default">Back</a>
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
