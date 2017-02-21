<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" media="all" />
</head>
<body>
    <div class="container" >
        <br/>

        {{--<a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>--}}

        <div class="big_div">

            @foreach ($items as $key => $item)

                <div >
                    @if((Auth::user()->id != $item->from_id) && ($item->sms != ''))
                        <p>{{ 'I got: '.$item->sms}}<sup class="pull-right text-warning" style="margin-left: 200px">{{$item->created_at}}</sup></p><hr>

                    @elseif((Auth::user()->id == $item->from_id) && ($item->sms != ''))

                        <p >{{ 'I sent: '.$item->sms}}<sup class="pull-right text-warning" style="margin-left: 200px">{{$item->created_at}}</sup></p><hr>
                </div>
                @endif
            @endforeach

        </div>
</div>
</body>
</html>












