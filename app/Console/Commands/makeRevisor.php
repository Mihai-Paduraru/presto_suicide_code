<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class makeRevisor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presto:makeRevisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rendi un utente revisore';

    /**
     * Execute the console command.
     *
     * @return int
     */

     public function __construct(){
         parent::__construct();
     }
    public function handle()
    {
        $email=$this->ask('inserisci la mail dell utente che vuoi rendere revisore');
        $user=User::where('email',$email)->first();
        if(!$user){
            $this->error('Nessun utente con questa mail');
            return;
               
        }else{
            $user->is_revisor=true;
            $user->save();
            $this->info('utente ' . $user->name . ' registrato');
            return;

        }

        
    }
}
