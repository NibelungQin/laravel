@extends('app')
@section('content')
    <div style="background-color:#5cb860">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="text-center">
                <div id="validation-errors"></div>
                <br>
                <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
                <br><br><br>
                <form action="/user/avatar" id="avatars" method="POST">
                    {{csrf_field()}}
                    <div class="text-center">
                        <div class="text-center">
                            <button type="button" onclick="F_Open_dialog()" class="btn btn-danger avatar-button" id="upload-avatar">上传新的头像</button>
                        </div>
                        <input type="file" class="avatar" name="avatar" id="image" style="display:none">
                    </div>
                </form>
                <div class="span5">
                    <div id="output" style="display:none">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/user/crop" method="POST" onsubmit="checkCoords()">
                    {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="crop-image-wrapper">
                            <img
                                    src="/images/default_avatar.jpg"
                                    class="ui centered image" id="cropbox" >
                            <input type="hidden" id="photo" name="photo" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">裁剪头像</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
<script>
    function F_Open_dialog()
    {
        document.getElementById("image").click();
    }
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        $('#image').on('change', function(){
            $('#upload-avatar').html('正在上传...');
            $('#avatars').ajaxForm(options).submit();
        });
    });
    function showRequest() {
        $("#validation-errors").hide().empty();
        $("#output").css('display','none');
        return true;
    }

    function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {
            var cropBox = $("#cropbox");
            cropBox.attr('src',response.avatar);
            $('#photo').val(response.avatar);
            $('#upload-avatar').html('更换新头像');
            $('#exampleModal').modal('show');
            cropBox.Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords,
                setSelect: [120,120,10,10]
            });
            $('.jcrop-holder img').attr('src',response.avatar);
        }
        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }
        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            alert('请选择图片.');
            return false;
        }
    }
</script>
@endsection