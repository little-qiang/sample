<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class SendEmails extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'email:send {user}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send e-mails to a user';


	/**
	 * Create a new command instance.
	 *
	 * @param  DripEmailer  $drip
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
        $userId = $this->argument('user');

        $user = \App\Models\User::find($userId);
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        $a = Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });

        var_dump($a);
	}
}
