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
                    <h1 class="page-header">Add Salary</h1>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      ADD NEW
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{url('update-salary')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <label>Position Name</label>
                                        <select class="form-control" name="position_id" required>
                                            <option value="">Please select position</option>
                                            @foreach($position as $p)
                                             <option value="{{$p->id}}"{{$salary->position_id == $p->id ? "selected":''}}>{{$p->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Gross Salary</label>
                                        <input type="text" name="gross_salary" value="{{isset($salary->gross_salary) ? $salary->gross_salary:''}}" class="form-control gross_salary" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Basic Salary</label>
                                        <input type="text" name="basic_salary" value="{{isset($salary->basic_salery) ? $salary->basic_salery:''}}" class="form-control basic_salary" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>HRA</label>
                                        <input type="text" name="hra" value="{{isset($salary->hra) ? $salary->hra:''}}" class="form-control hra" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>DA</label>
                                        <input type="text" name="da" value="{{isset($salary->da) ? $salary->da:''}}" class="form-control da" required="required">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Other Allowance</label>
                                        <input type="text" name="other_allowances" value="{{isset($salary->other_allowances) ? $salary->other_allowances:''}}" class="form-control other_allowances" required="required">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="hidden" name="id" value="{{isset($salary->id) ? $salary->id:''}}">
                                        <button type="submit" name="submit" value="submit" class="btn btn-success">Update</button>
                                        <a href="{{url('salary')}}" class="btn btn-default">Back</a>
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
<script>
    $(document).ready(function(){
        $('.gross_salary').keyup(function(){
            var gross = $('.gross_salary').val();
            var value = gross*10/100;
            var basic = gross - (value * 3);
            $('.hra,.da,.other_allowances').val(value);
            $('.basic_salary').val(basic);
        });

    });
</script>
