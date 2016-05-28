<! DOCTYPE HTML>
<html>
<head>
    <title>he</title>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
</head>
<body>
<form enctype="multipart/form-data">
    <input name="file" type="file"/>
    <input type="button" value="Upload"/>
</form>
<progress></progress>
</body>
<script>
    $(':file').change(function(){
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
        //your validation
    });

    $(':button').click(function(){
        var formData = new FormData($('form')[0]);
        $.ajax({
            url: 'upload.php',  //server script to process data
            type: 'POST',
            //Ajax事件
            success: 'completeHandler',
            error: 'errorHandler',
            // Form数据
            data: formData,
            //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false
        });
    });

    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded,max:e.total});
        }
    }
</script>
</html>

