<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;



class clientAnswersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clientAnswer:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send answers to clients email';

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
	 $tickets = \DB::table('tickets')->where('updated_at', '>=', Carbon::now()->subHours(1)->toDateTimeString())->get();
	 
	 foreach ( $tickets as $ticket )
	 {
	    if ( isset( $ticket->email ) ) 
	    {
            $clientEmail = $ticket->email;
            if ( strlen($ticket->answer) > 5 )
            {
            \Mail::send('emails.clientAnswer', 
                ['ticket' => $ticket],
                function($message)
                use($ticket)
                {
                    $message->from(env('MANAGER_MAIL'), 'Сервісний центр');

                    $message->to($ticket->email)->subject('TicketService: Відповідь по заявці №'.$ticket->ticket_article);
                });
		  $this->info($ticket->email);
	    }
	    }
	}
    }
}
