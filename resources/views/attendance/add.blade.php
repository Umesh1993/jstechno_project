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
                    <h1 class="page-header">ADD IN & OUT Attendance</h1>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    ADD IN & OUT
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{url('insert-attendance')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <label>Employee Name</label>
                                        <select class="form-control employee_id" name="employee_id" required>
                                            <option value="">Please select employee</option>
                                            @foreach($employee as $d)
                                             <option value="{{$d->id}}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 reason">
                                        <label>Reason/In-Out</label>
                                        <select name="reason" class="form-control reason" required="required">
                                             <option value="in">IN</option>
                                             <option value="out">OUT</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>DateTime</label>
                                        <input type="text" name="datetime" value="{{date('d/m/Y H:i:s')}}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <button type="submit" name="submit" value="submit" class="btn btn-success">Create</button>
                                        <a href="{{url('attendance')}}" class="btn btn-default">Back</a>
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
<!-- <script>
     $(document).ready(function(){
        $('.employee_id').change(function(){
            var employee_id = $(this).val();  
            var url_variable = '{{url("attendance-check")}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url_variable,
                data: { employee_id: employee_id },
                success: function (res) {      
                        // Handle other responses
                        $('.reason').html(res.html);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed:', textStatus, errorThrown);
                }
            });
        });
    });
</script> -->
