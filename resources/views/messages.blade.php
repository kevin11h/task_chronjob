@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/45e03a14ce.js"></script>

    <a href="/showtable" style="margin-left: 120px"><strong>My product</strong></a>
    <a href="/profile" style="margin-left: 40px"><strong>My profile</strong></a>

    <div class="main_section">
        <div class="container">
            <div class = "col-sm-9" style="border-top:2px solid #bfbfbf;">
                <table  class = "table table-bordred ">
                    <tr><h3>All my friend</h3></tr>
                    <tr>
                        {{-----------------------send messages form--------------------------------------------}}
                       @foreach($req_data as $data)
                            @if(Auth::user()->id == $data->to_id && $data->status == 1 or Auth::user()->id == $data->from_id && $data->status == 1)
                                <td class = "col-sm-2 col-md-2">
                                    <img src = "{{$data->avatar}}" style="width: 100px;height: 100px;" class = "img-thumbnail"/>
                                </td>
                                <td>
                                    <h3>{{$data->name}}</h3><br>

                                </td>

                                <td>
                                    @foreach($count as $i)
                                        @if($data->id == $i['id'])
                                            <button type="button" style="border-radius: 35px" class="btn btn-danger btn-circle">{{count($i['messages_count'])}}</button>
                                        @endif
                                    @endforeach

                                    @if(Auth::user()->id == $data->to_id)
                                        <?php $sms_class = $data->from_id ?>
                                    @elseif(Auth::user()->id != $data->to_id)
                                        <?php  $sms_to_id = $data->to_id   ?>
                                    @endif

                                    <button type="button" class="btn btn-default  sms_button messages_box"   data-sms = "{{$data->id}}"  data-token = "{{csrf_token()}}" data-my_id = "{{Auth::user()->id}}" data-to_id = "{{$data->to_id}}" data-from_id = "{{$data->from_id}}" value = "Message">
                                        <span class="glyphicon glyphicon-envelope">  </span> Personal Message

                                    </button>

                                    <button type="button" class="btn btn-default Delete" data-token = "{{csrf_token()}}" data-my_id = "{{Auth::user()->id}}" data-to_id = "{{$data->to_id}}" data-from_id = "{{$data->from_id}}" value = "Delete">&#10006; Delete friend</button>
                                </td>
                            @endif
                            {{csrf_field()}}

                            <td>
                                <div id="{{$data->id.'m'}}"  class="big_div" style="display:none;z-index: 200;">
                                    <div class="modal-content ">
                                        <div class="modal-header" >
                                            <button type="button" class="close close_sms_window" data-dismiss="modal">Close</button>
                                            <h5 class="modal-title">Private</h5>
                                        </div>
                                        <div class="modal-body messages_{{$data->id}}">
                                        </div>
                                        <div class="modal-footer">
                                            <textarea class="form-control custom-control textarea" rows="2" style="resize:none;"></textarea>

                                            <button type="button" class="btn btn-default send_sms" data-token = "{{csrf_token()}}"
                                                    data-my_id = "{{Auth::user()->id}}" data-sms = "{{$data->id}}">Send
                                            </button>

                                            {{--Send Pdf File in her mail--}}
                                            <a href="{{ route('pdfview',['send'=>'pdf','my_id'=>Auth::user()->id,'to_id'=>$data->id]) }}">Send PDF</a>

                                            {{--Downloade Pdf File--}}
                                            <a href="{{ route('pdfview',['downloade'=>'downloade','my_id'=>Auth::user()->id,'to_id'=>$data->id])}}">Downloade PDF</a>



                                            <input type="file" name="file" id="input_{{$data->id}}"  class="btn btn-default send_file pull-left" data-token = "{{csrf_token()}}"
                                                    data-my_id = "{{Auth::user()->id}}" data-sms = "{{$data->id}}">
                                            </input>
                                        </div>
                                    </div>
                                </div>
                            </td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
     </div>
    </div>

@endsection
