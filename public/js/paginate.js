var user_id ;

$.ajax({
    url:"/get_userid",
    type:"GET",
    success: function(result){
        console.log(result);
        user_id = result;
    }
});

$(document).on('click','.pagination li',function(e) {
    e.preventDefault();

    $(".trid").remove();

    var pagenumber = $(this).text();
    var token = $('#_token').val();
    location.hash = pagenumber;

    console.log(pagenumber);

    $.ajax({
        url:"http://fruits.com/showtable?page=" + pagenumber,
        type:"GET",

        success: function(result){
            console.log(result);

            $.each(result.data, function(i,l){

            $('#product_table #appen').after('<tr class="trid"><td><img style="width: 70px;height: 50px" src="fruits/fruits_image/'+l.filename+'"></td><td style = "text-align: center" class="'+l.user_id+' editname ">'+l.name+'</td><td class="'+l.user_id+' editprice" style = "text-align: center" >'+l.price+'</td><td><button data-id="'+l.id+'"  data-userid ="'+l.user_id+'" id="post_'+l.id+'" class="edit btn-link"  data-token="'+token+'">Edit</button><button  class="delete btn-link" id="del_'+l.id+'"  data-token="'+token+'">Delete</button></td>' +

                '<td><img style="width: 70px;height: 50px" src="'+l.avatar+'"></td><td><a href="/profile"><h6>creator name:' + l.users_name + '</h6></a></td><input type = "hidden" id = "'+l.user_id+'" name = "id"></tr>');

            $("." + user_id ).attr("contenteditable",true);

            var x = $(".edit").attr("data-userid");

            // console.log(x+'---'+user_id);
            if(x != user_id){

                $("#post_"+l.id).attr("disabled", true).attr('style',  'color:aaaabc');

                $("#del_"+l.id).attr("disabled", true).attr('style',  'color:aaaabc');
            }
            });
        },
    })
});





