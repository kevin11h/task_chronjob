<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Messages;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use PDF;
use Illuminate\Support\Facades\Mail;
class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $my_id = $request->my_id;
        $to_id = $request->to_id;

            $select2 = Messages::select('sms','file_name','from_id','created_at')
                ->where(['to_id'=>$to_id,'from_id'=>$my_id])
                ->orwhere(['to_id'=>$my_id,'from_id'=>$to_id])
                        ->get();

             echo json_encode($select2);exit;
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'my_id'=>'required',
            'to_id'=>'required'
        ]);

        $sms = $request->sms;
        $my_id = $request->my_id;
        $to_id = $request->to_id;
        $file = $request->file;

        if($file != 'undefined' && $sms == ''){
            $filename = time().'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($file));

            $message = Messages::firstOrCreate([
                'from_id' => $my_id,
                'to_id' => $to_id,
                'show_sms' => 0,
                'file_name'=>$filename
            ]);
            return $message;

        }else if(isset($sms) && $file == 'undefined'){

            $message = Messages::firstOrCreate([
                'sms' => $sms,
                'from_id' => $my_id,
                'to_id' => $to_id,
                'show_sms' => 0,
            ]);
            return $message;

        }else {
            $filename = time().'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($file));

            $message = Messages::firstOrCreate([
                'sms' => $sms,
                'from_id' => $my_id,
                'to_id' => $to_id,
                'show_sms' => 0,
                'file_name'=>$filename
            ]);
            return $message;
        }
    }

    public function select()
    {

        $id = Auth::user()->id;

        $select2 = Messages::where('to_id', $id)->where('show_sms',0)
                         ->get();

        Messages::where(['to_id'=>$id])
            ->update(['show_sms' => 1]);

        return json_encode($select2);
    }

    public function getall()
    {
        $data = Messages::limit(10)->get();

//        dd($data);

        return view('indexpdf')->with('data',$data);
    }

        public function pdfview(Request $request)
        {

            $my_id = $request->my_id;
            $to_id = $request->to_id;

            $items = Messages::select('sms','file_name','from_id','created_at')
                ->where(['to_id'=>$to_id,'from_id'=>$my_id])
                ->orwhere(['to_id'=>$my_id,'from_id'=>$to_id])
                ->get();


            $user_email = User::select('email')->where('id',$to_id)->first();
            $user_email->email;

            view()->share('items',$items);

            if($request->has('send')){
                $pdf = PDF::loadView('pdfview');
                $aar = $pdf->download('pdfview.pdf');

                Mail::send(['pdfview'=>$aar],['items'=>$items],function ($messages)use($aar){
                    $messages->to('movsesyan-narek@mail.ru','Narek');
                    $messages->attachData($aar,'chat.pdf');
                    $messages->from('narmovsesyan@gmail.com')->subject('test');
                });
            }

            if($request->has('downloade')){

                $pdf = PDF::loadView('pdfview');

               return $pdf->download('pdfview.pdf');
            };


        return back();

    }
}


