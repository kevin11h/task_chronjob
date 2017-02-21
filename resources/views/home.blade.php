<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <div class = "container">
        <div class = "row">

            <input type="hidden" id="_token" value="{{ csrf_token() }}">

            <div class = ".col-lg-8 col-md-offset-2">
                <div class = "panel panel-default">

                        <div class = "panel panel-default">
                            <!-- Default panel contents -->
                                <div class = "panel-body">
                                    <p>Welcome Fruts page </p>
                                </div>

                                <!-- Table -->
                                <table class = "table table-striped" id="product_table">
                                    <tr style="colspam :3" id="appen">
                                        <td ><h3>Image</h3></td>

                                        <td style = "text-align: center"><h3>Name</h3></td>
                                        <td style = "text-align: center"><h3>Price</h3></td>
                                        <td style = "text-align: center"></td>
                                        <td style = "text-align: center"></td>
                                    </tr>

                                @foreach($users as $user)

                                            @if(Auth::user()->id == $user->user_id)

                                                <tr class="trid {{Auth::user()->id}}">
                                                    <td><img  style="width: 70px;height: 50px;" src="{{'fruits/fruits_image/'.$user->filename}}"></td>
                                                    <td contenteditable class = "editname" style = "text-align: center">
                                                        {{$user->name}}
                                                    </td>

                                                    <td contenteditable class = "editprice" style = "text-align: center">{{$user->price}}</td>
                                                    <input type = "hidden" id = "{{$user->id}}" name = "id">
                                                    <td>
                                                        <button  class="edit btn-link"  data-token = "{{csrf_token()}}" data-id="{{$user->id}}" >Edit</button>
                                                        <button  class="delete btn-link"  data-token = "{{csrf_token()}}" >Delete</button>

                                                    <td><img style="width: 70px;height: 50px" src="{{$user->avatar}}"></td>

                                                    </td>

                                                    <td><a href="{{route('/profile')}}"><h6>{{ 'creator name: '. $user->users_name}}

                                                            </h6></a>
                                                        <img style="width: 15px;height: 15px" src="http://img0.liveinternet.ru/images/attach/c/4/82/86/82086634_7.gif" /></td>
                                                </tr>
                                            @else
                                                <tr class="trid {{$user->user_id}}">
                                                    <td><img style="width: 70px;height: 50px" src="{{'fruits/fruits_image/'.$user->filename}}"></td>

                                                    <td  class = "editname" style = "text-align: center">{{$user->name}}</td>
                                                    <td  class = "editprice" style = "text-align: center">{{$user->price}}</td>
                                                    <td>
                                                        <button class="btn-link disabled" style="color: #aaa" disabled="disabled">Edit</button>
                                                        <button  class="btn-link" style="color: #aaa" disabled="disabled">Delete</button>
                                                    </td>

                                                    <td><img style="width: 70px;height: 50px" src="{{$user->avatar}}"></td>
                                                    <td><h6>{{ 'creator name: '. $user->users_name}}</h6>

                                                    </td>

                                                    <input type = "hidden" id = "{{$user->id}}" name = "id">
                                                </tr>
                                            @endif
                                    @endforeach

                                    {{ $users->links() }}

                                    <tr>
                                        <form  action="{{route('/addfrutsdata')}}" enctype="multipart/form-data" method="Post">
                                            <td ><input type="text" placeholder="Fruts Name" name="name" class="form-control"></td>

                                            <td ><input type="text" placeholder="Fruts Price" name="price" class="form-control"></td>

                                            <td><input type="file" name="file" class="form-control" id="image"></td>

                                            <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" >

                                            <td>
                                                <input type="submit"class="form-control col-md-4" value="Add Fruit">
                                            </td>
                                            {{csrf_field()}}
                                        </form>
                                    </tr>


                          </table>
                            {{--<div class="panel-heading">--}}
                            <div class="alert-danger">
                                @if ($errors->has('name'))
                                    {{$errors->first('name')}}
                                @endif

                                @if ($errors->has('price'))
                                    {{$errors->first('price')}}
                                @endif

                                @if ($errors->has('file'))
                                    {{$errors->first('file')}}
                                @endif

                            </div>
                            {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
