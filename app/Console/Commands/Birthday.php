<?php

namespace App\Console\Commands;

use App\Messages;
use Illuminate\Console\Command;
use App\FriendRequest;

use App\User;
class Birthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();

     foreach ($users as $user)
//         dd($user->birthday);

//         echo($user->id);

         if($user->birthday == date("Y-m-d")){


                Messages::insert([

                    ['from_id' => '6', 'to_id' => $user->id,
                        'sms'=>'Уважаемый '.$user->name.' , от имени администрации форума поздравляем Вас с Днём Рождения!',
                        'show_sms' => '0',
                        'created_at' =>date("Y-m-d").' 00:00:01',
                        'updated_at' =>date("Y-m-d").' 00:00:01'
                    ],
                ]);

             FriendRequest::insert([
                    ['from_id' => '6', 'to_id' => $user->id,
//                        'sms'=>'Уважаемый '.$user->name.' , от имени администрации форума поздравляем Вас с Днём Рождения!',
                        'status' => '1',
                        'created_at' =>date("Y-m-d").' 00:00:01',
                        'updated_at' =>date("Y-m-d").' 00:00:01'
                    ],
                ]);
//
         }
    }
}
