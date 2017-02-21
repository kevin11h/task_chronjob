$(document).ready(function(){

    $('.close_sms_window').click(function(){

        clearInterval(myInterval);

        $(this).parents().find('.big_div').hide("slow");
        $('.messages_box').show();
        $('.Delete').show();
        $(".messages_"+to_id).empty();
    });

    $('.send_sms').click(function(){
        sms = $(this).parent().find('.textarea').val();
        my_id = $(this).attr('data-my_id');
        to_id = $(this).attr('data-sms');
        token = $(this).attr('data-token');
        file = document.getElementById('input_' + to_id).files[0];

        // filename = 'you sent file';


            if (file != '' && sms != '') {


                $(".messages_" + to_id).append("<p>" + 'I sent4-96:' + filename + '<br>' + '<sup class="pull-right"></sup>' + "</p><hr>");

                $(".messages_"+to_id).append("<p>"+'I sent4-2:'+sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
            } else if (file != '' && sms == '') {

                $(".messages_" + to_id).append("<p>" + 'I sent5:' + filename + "</p><hr>");

            } else if (file == '' && sms != '') {

                $(".messages_" + to_id).append("<p>" + 'I sent6:' + sms + "</p><hr>");
            }


        var formData = new FormData();
        formData.append('to_id',to_id);
        formData.append('my_id',my_id);
        formData.append('sms',sms);
        formData.append('file',file);

        $.ajax({
            url:'/send_messages',
            type:"POST",
            cache: false,
            enctype: 'multipart/form-data',
            data:formData,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN':  token},
            success:function(data){
            }
        });
        $(this).parent().find('.textarea').val("");

       $('#input_'+to_id).val('');
    });


    $('.messages_box').click(function(){
        sms = $(this).attr('data-sms');
        $('#'+sms+'m').show(400);
        $('.messages_box').hide();
        $('.Delete').hide();

        my_id = $(this).attr('data-my_id');
        to_id = $(this).attr('data-sms');
        token = $(this).attr('data-token');
        $(".messages_"+to_id).empty();

        $.ajax({
                url:"/get_messages",
                type:"POST",
                data:{my_id:my_id,to_id:to_id,_token:token},
                dataType: "json",

            success:function(data){
                $.each( data, function(){

                    if (this.from_id != my_id ){

                        if (this.file_name != '' && this.sms == ''){
                            // $(".messages_"+to_id).append("<p>"+'I got7:'+this.file_name+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
                            $(".messages_"+to_id).append("<p>I got7:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");
                        }else if(this.file_name == '' && this.sms != ''){
                            $(".messages_"+to_id).append("<p>"+'I got7-2:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");

                        }else if(this.file_name != '' && this.sms != ''){

                            $(".messages_"+to_id).append("<p>I got7-3:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                            $(".messages_"+to_id).append("<p>"+'I got7-4:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");

                        }
                    }else{
                         if (this.sms != '' && this.file_name == ''){
                            // $(".messages_"+to_id).append("<p>"+'I sent8:'+this.sms+'<br>'+this.created_at+"</p><hr>");
                            $(".messages_"+to_id).append("<p>"+'I got8:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
                        }
                        else if(this.sms == '' && this.file_name != ''){
                            // $(".messages_"+to_id).append("<p>"+'I sent8:'+this.file_name+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
                            $(".messages_"+to_id).append("<p>I got8-2:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                         }else if(this.file_name != '' && this.sms != ''){

                        $(".messages_"+to_id).append("<p>I sent 4-3:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                        $(".messages_"+to_id).append("<p>"+'I sent4-4:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");

                    }



                    }
                });
            }
        });
        myInterval = setInterval(function (){
            select(to_id,my_id)
        },2000);
    });

    function select(to_id,my_id){

        token = $("input[name=_token]").val();

        $.ajax({
            url:"/select_messages",
            type:"POST",
            data:{_token:token},
            dataType: "json",

            success:function(data){

                $.each(data, function(){

                    if (to_id != my_id ){

                        if (this.file_name != '' && this.sms == ''){
                            // $(".messages_"+to_id).append("<p>"+'I got7:'+this.file_name+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
                            $(".messages_"+to_id).append("<p>I got11:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");
                        }else if(this.file_name == '' && this.sms != ''){
                            $(".messages_"+to_id).append("<p>"+'I got11-2:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");

                        }else if(this.file_name != '' && this.sms != ''){

                            $(".messages_"+to_id).append("<p>I got11-3:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                            $(".messages_"+to_id).append("<p>"+'I got11-4:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");

                        }


                        // $(".messages_"+to_id).append("<p>"+'I got9:'+this.sms+'<br>'+'<sup class="pull-right">'+this.created_at+'</sup>'+"</p><hr>");
                    }
                });

            },

            // error: function(jqXHR, textStatus, errorThrown) {
            //     console.log('ajax error! ' + errorThrown.message + "\n status: " + textStatus);

                // window.setInterval(endlessJob, delay);
            // }



        })
    }




});


