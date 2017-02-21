$(document).ready(function(){

    $('.close_sms_window').click(function(){

        clearInterval(myInterval);

        $(this).parents().find('.big_div').hide("slow");
        $('.messages_box').show();
        $('.Delete').show();

        $(".messages_"+to_id).empty();              //Message box@ datarkuma

        $(this).parent().next().next().find('.textarea').val(""); //textareana datarkum

        $('#input_'+to_id).val('');                 //file uploadi inputna datarkum

    });


    $('.send_sms').click(function(){
        sms = $(this).parent().find('.textarea').val();//textareai mechi grac@
        my_id = $(this).attr('data-my_id');
        to_id = $(this).attr('data-sms');
        token = $(this).attr('data-token');
        file = document.getElementById('input_' + to_id).files[0];

        if (sms != '' || file) {

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
                    console.log(data);
                    console.log(data['file_name']+'*--111-----*');
                    console.log(data['sms']+'*--222-----*');

                    if(data['file_name'] != null){

                        // $(".messages_" + to_id).append("<p>" + 'I sent6/1:' + data['file_name']+"</p><hr>");

                        $(".messages_"+to_id).append("<p>I sent6/1:<img src='/fruits/fruits_image/"+data['file_name']+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+data['created_at']+"</sup></p><hr>");

                    }
                    if(data['sms'] != null ){

                        $(".messages_" + to_id).append("<p>" + 'I sent 15/5:' +data['sms']+"</p><hr>");

                    }

                }
            });
        }
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

                console.log(data);

                $(".messages_" + to_id).empty();


                $.each( data, function(){

                    if (this.from_id != my_id ){

                        if (this.sms != null){

                            $(".messages_" + to_id).append("<p>" + 'I got7-7:' + this.sms + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        }
                        if (this.file_name != null){

                            // $(".messages_" + to_id).append("<p>" + 'I got7-3:' + this.file_name + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                            $(".messages_"+to_id).append("<p>I got7-3:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                        }
                        // if (this.file_name != null && this.sms != null){
                        //verchi pakac
                        //     // $(".messages_" + to_id).append("<p>" + 'I got7-4:' + this.file_name + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        //     $(".messages_"+to_id).append("<p>I got7-4:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");
                        //
                        //
                        //
                        //     $(".messages_" + to_id).append("<p>" + 'I got7-5:' + this.sms + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        // }

                    }else{
                        if (this.sms != null){

                            $(".messages_" + to_id).append("<p>" + 'I sent7-7:' + this.sms + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        }
                        if (this.file_name != null){

                            // $(".messages_" + to_id).append("<p>" + 'I sent-7-3:' + this.file_name + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                            $(".messages_"+to_id).append("<p>I sent-7-3:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");

                        }
                        // if (this.file_name != null && this.sms != null){
                        //verchi pakac
                        //     // $(".messages_" + to_id).append("<p>" + 'I sent7-4:' + this.file_name + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        //     $(".messages_"+to_id).append("<p>I sent7-4:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");
                        //
                        //
                        //     $(".messages_" + to_id).append("<p>" + 'I sent7-5:' + this.sms + '<br>' + '<sup class="pull-right">' + this.created_at + '</sup>' + "</p><hr>");
                        // }
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

                // console.log(data);
                $.each(data, function(){


                    if (to_id != my_id ){

                        // console.log(this.sms);

                        if(this.file_name != null){

                            // $(".messages_" + to_id).append("<p>" + 'I got 6/1:' + this.file_name + "</p><hr>");

                            $(".messages_"+to_id).append("<p>I got6/1:<img src='/fruits/fruits_image/"+this.file_name+"' style='width:100px;height:100px;'><br><sup class='pull-right'>"+this.created_at+"</sup></p><hr>");


                        }

                        if(this.sms != null ){

                            $(".messages_" + to_id).append("<p>" + 'I got 15/5:' + this.sms + "</p><hr>");

                        }

                    }
                });
            },
        })
    }
});



