
$(document).ready(function(){
    $('.Yes').click(function(){
        response = $(this).val();
        data_id = $('.data_id').val();
        to_id = $(this).attr('data-to_id');
        token = $(this).attr('data-token');
        button = $(this).parent().parent();
        // alert(key);

        $.ajax({
            url:"/addFriend",
            type:"POST",
            data:{response:response,data_id:data_id,to_id:to_id,_token:token},
            success:function(data){
                $(button ).hide();
            }
        })
    })
});


// {{--$('.delete').click(function(){--}}
//     {{--var id=$(this).parent().parent().children('input').attr('id');--}}
//
//     {{--$.ajax( {--}}
//         {{--url:"{{route('/delete')}}",--}}
//         {{--type:"POST",--}}
//         {{--data:{id:id},--}}
//         {{--headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')},--}}
//         {{--success:function(data){--}}
//             {{--$("#"+id).parent().hide();--}}
//             {{--}--}}
//         {{--})--}}
// {{--})--}}
// {{--});--}}

