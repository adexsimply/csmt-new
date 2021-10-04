 
<div class="col-sm-12">
  <form method="post" onsubmit="oisForm(event)" action="{{url('sms/generate-pin')}}">
    {{csrf_field()}}
    <div class="formAlert"></div>
    <div class="form-group">
      <select name="group_class_id" class="form-control classOptions"></select>
    </div>

    <div class="form-group">
      <select name="category_id" class="form-control">
        <option value="0">All</option>
        <option value="1">{{App\Student::categoryName(1)}}</option>
        <option value="2">{{App\Student::categoryName(2)}}</option>
      </select>
    </div>

    <button class="btn btn-primary" type="submit">Generate Pin</button>
  </form>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    classOptions()
  });

</script>