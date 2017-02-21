@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <div class = "container">
        <a href="/messages" style="text-decoration: none;">
             <strong>My messages <button type="button" class="btn btn-danger btn-circle btn-xs">{{$count}}</button>
            </strong>
        </a>
        <a href="/showtable" style="margin-left: 40px"><strong>My Product</strong></a>
        <a href="#" style="margin-left: 40px" class="btn-info btn-sm" data-toggle="modal" data-target="#myModal"><strong>Calendar</strong></a>
        {{--<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Calendar</button>--}}
{{----- My profile data -------------------------------------------------------------------------}}
        @foreach($user_profile_all_info as $profile_info)
            @if(Auth::user()->id == $profile_info->id)
                <div class="container-fluid" style="border-bottom: 3px solid #eeeeee;" >
                    <div class="row" style="border-top: 3px solid #eeeeee;">
                        <div class="col-sm-3 col-md-7" style="z-index:100;background-color:#ffffff;min-height: 450px;">

                            <h2> <p style="text-align: center">Welcome Your profile <strong>{{$profile_info->name}}</strong></p></h2>
                            <div class="col-sm-2 col-md-2">
                                <img src="{{$profile_info->avatar}}" alt="" class="img-thumbnail"/>
                            </div>

                            <div class="col-sm-4 col-md-4">
                                <blockquote>
                                    <p>{{$profile_info->name}}</p> <small><cite >Welcome</cite></small>
                                </blockquote>
                                <p>&#128231; {{$profile_info->email}}</p>
                            </div>
                @endif
            @endforeach
                            {{--<div class = "col-sm-9" style="border-top:2px solid #bfbfbf;margin-top: 140px;">--}}
                                {{--------------------------------------------------}}

                                {{--<table  class = "table table-bordred ">--}}

                                            {{--<tr>--}}

            {{-----------------------send messages form--------------------------------------------}}
                                        {{--@foreach($req_data as $data)--}}

                                                {{--<td>--}}

                                                    {{--<div id="{{$data->id.'m'}}"  class="big_div" style="display:none;z-index: 200;">--}}

                                                        {{--<button type="button" class="close close_sms_window" data-dismiss="modal"><h3>Close</h3></button>--}}

                                                        {{--<div class="modal-content ">--}}

                                                            {{--style="width:250px;height:220px;overflow-x:auto;"--}}
                                                            {{--<div class="modal-header" >--}}
                                                                {{--<button type="button" class="close close_sms_window" data-dismiss="modal">Close</button>--}}
                                                                {{--<h5 class="modal-title">Private</h5>--}}
                                                            {{--</div>--}}

                                                            {{--<div class="modal-body messages_{{$data->id}}">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-footer">--}}
                                                                {{--<textarea class="form-control custom-control textarea" rows="2" style="resize:none;"></textarea>--}}
                                                                {{--<button type="button" class="btn btn-default send_sms" data-token = "{{csrf_token()}}"--}}
                                                                {{--data-my_id = "{{Auth::user()->id}}" data-sms = "{{$data->id}}">Send--}}
                                                                {{--</button>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        </div>
                        {{--787878--}}

    {{-----------------------All users panel-----------------------------------------------------------------------------}}
                        <div class = "col-sm-9 col-md-5 " style="background-color:#ffffff;border-left: 2px solid #eeeeee;">
                            <table  class = "table table-bordred">

                                <h1>All users</h1>

                                @foreach($req_data as $data)
                                    @if(Auth::user()->id != $data->id)
                                        <tr>
                                            <td class = "col-sm-2 col-md-2">
                                                <img src ="{{$data->avatar}}" alt = "" class = "img-thumbnail"/>
                                            </td>
                                            <td>{{$data->name}}<br>

                                                @if($data->isOnline())

                                                    <img style="width: 15px;height: 15px" src="http://img0.liveinternet.ru/images/attach/c/4/82/86/82086634_7.gif" />
                                            @endif

                                            </td>
                                              {{-----Friend request form -----1-auth_user_id----------2-send_request_id----------}}
                                            <form  method = "POST"  action = "{{route('/add_friend_request')}}">
                                                <td>
                                                    @if(Auth::user()->id == $data->from_id)
                                                            @if($data->status == 1)

                                                            <div>friend</div>
                                                        @elseif($data->status == null)
                                                                <button type="button" class="btn btn-default disabled">Please wait</button>
                                                            @endif
                                                    @elseif(Auth::user()->id == $data->to_id)
                                                            @if($data->status == 1)
                                                            <div>friend</div>

                                                            @elseif($data->status == null)
                                                            <a href="my_friend_page"><button type="submit" class="btn btn-success">{{$data->name}} send request</button></a>

                                                                <input type = "hidden" name = "send_request_id" class="data_id"  value = "{{$data->id}}"></br>
                                                                <button type="button" class="btn btn-default Yes" data-token = "{{csrf_token()}}" data-to_id = "{{$data->from_id}}" value = "Yes">Yes</button>
                                                                <button type="button" class="btn btn-default Yes" data-token = "{{csrf_token()}}" data-to_id = "{{$data->from_id}}" value = "No" >No</button>
                                                            @endif
                                                    @else
                                                            <a href="my_friend_page"><button type="submit" class="btn btn-primary">&#10010; Add Friend</button></a>
                                                            <input type = "hidden" name = "send_request_id" value = "{{$data->id}}" >
                                                        <input type = "hidden" name = "auth_user_id" value = "{{Auth::user()->id}}">
                                                    @endif
                                                    {{csrf_field()}}
                                                </td>
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                {{ $req_data->links() }}
                            </table>
                        </div>
                    </div>
                </div>
    </div>
    <!-- Trigger the modal with a button -->


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                    <div id="calendar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


@endsection



