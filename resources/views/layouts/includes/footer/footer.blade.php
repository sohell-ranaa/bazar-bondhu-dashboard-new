<div class="page-footer" style=" background-color: #F8F6FA;">
  <div class="page-footer-inner"
       style="width: 100%; display: flex; justify-content: space-between; align-items: center">
    <span>&copy; <?=date('Y')?>. All right reserved</span>
    {{--<img src="{{asset('public/assets/img/footer.png')}}" alt=""
         style="height: 100px;display: inline-block"
    >--}}
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>
</div>
<script>
    $("#district").on('click',function (e){
        e.preventDefault();
        var district = $(this).val();
        $.ajax({
            url: "{{URL::to('getupazila')}}",
            method: "GET",
            data: {'district': district},
            dataType: "json",
            success: function (data) {
                if(data.status==200){
                    var result = data.response;
                    var str = '<option value="">--Select Upazila--</option>';
                    $.each(result, function (index, value) {
                        str += `<option value='${value}'>${value}</option>`;
                    });
                    $('#upazila').html(str);
                }else{

                }
            }
        });
    });
</script>
