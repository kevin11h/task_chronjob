
$(document).ready(function () {
   $('.Delete').click(function () {
       my_id = $(this).attr('data-my_id');
       to_id = $(this).attr('data-to_id');
       from_id = $(this).attr('data-from_id');
       token = $(this).attr('data-token');
       response = $(this).val();
       img_name = $(this).parent().parent();

       // alert(my_id+to_id+from_id+response);

       $.ajax({
           url:"/friend_del",
           type:"POST",
           data:{_token:token,response:response,to_id:to_id,my_id:my_id,from_id:from_id},
           success:function(data){
               $(img_name).hide();
           }
       })

   });
});

