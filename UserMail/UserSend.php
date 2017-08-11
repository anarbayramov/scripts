<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App;

class UserInvite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:invite {--email=} {--locale=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send reset link to user {--email=} {--locale=}';

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
        $email = $this->option('email');

        $user = User::where('email', '=', $email)->first();

        if ($user) {
            //instantiate what you want to do
            $user->sendEmail();
        } else {
            $this->error('User with email ' . $email . ' not found!');
        }
    }
}
