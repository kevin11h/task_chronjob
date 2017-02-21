

$(document).ready(function(){
    $(document).on("click",".edit",function(){

        var id=$(this).attr("data-id");
        var name=$(this).parent().parent().children('.editname').text();
        var price=$(this).parent().parent().children('.editprice').text();

         token = $(this).attr('data-token');

        // token = $("input[name=_token]").val();



        $.ajax( {
            url:"/edit",
            type:"POST",
            dataType:'json',
            data:{id:id,name:name,price:price,_token:token},
            success:function(data){
                console.log("ljhklj"+data)
            }
        })
    })

    $('.delete').click(function(){
        var id=$(this).parent().parent().children('input').attr('id');
        token = $(this).attr('data-token');

        $.ajax( {
            url:"/delete",
            type:"POST",
            data:{id:id,_token:token},
            success:function(data){
                if(data == '1'){
                    $("#"+id).parent().hide();
                }
                else{
                    alert("not")
                }

            }
        })
    })
});

