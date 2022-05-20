<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class makeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presto:makeAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rende un utente amministratore';

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
        $email=$this->ask('inserisci la mail dell utente che vuoi rendere amministratore');
        $user=User::where('email',$email)->first();
        if(!$user){
            $this->error('Nessun utente con questa mail');
            return;
               
        }else{
            $user->is_revisor=true;
            $user->is_admin=true;
            $user->save();
            $this->info('utente ' . $user->name . ' è ora un amministratore del sito');
            return;

        }

        
    }
}
