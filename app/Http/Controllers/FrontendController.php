<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailable;
use App\Ticket;



class FrontendController extends Controller
{
    public function clientSearch( $phone ) {
    	$client = Ticket::where('phone', $phone)->first();

    	return $client;
    }

    public function addTicket( Request $request )
    {
        $data = array();
        $files = array();


            $files = $request->file('files');
            if ( is_array($files) ) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('files');
                    $data[] = $path;
                }
            } 

    	$ticket = new Ticket;
    	$ticket->ticket_article = mt_rand(100000, 999999);
        $ticket->fio = $request->fio;
        $ticket->phone = $request->phone;
        $ticket->city = $request->city;
        $ticket->email = $request->email;
        $ticket->adress = $request->adress;
        $ticket->type = $request->type;
    	$ticket->brand = $request->brand;
    	$ticket->model = $request->model;
    	$ticket->serial_number = $request->serial_number;
    	$ticket->date_sale = $request->date_sale;
    	$ticket->description = $request->description;
    	$ticket->files = $data;
        $ticket->status = 'Відкрита';

		$ticket->save();

        $clientEmail = $request->email;

        if ( $ticket->ticket_article ) 
        {
            $status = $ticket->ticket_article;
            \Mail::send('emails.manager', 
                ['ticket' => $ticket, 'data' => $data ],
                function($message)
                use ($files)
            {
                $message->from('service@pr.km.ua', 'Сервісний центр');
                if ( is_array($files) ) {
                    foreach ($files as $file) {
                        $message->attach($file, ['as' => $file->getClientOriginalName()]);
                    }
                }
                $message->to(env('MANAGER_MAIL'))->subject('TicketService: Нова заявка.');
            });

            if ( $request->email ) 
            {
                \Mail::send('emails.client', 
                    ['ticket' => $ticket, 'data' => $data ],
                    function($message)
                    use($clientEmail)
                    {
                        $message->from(env('MANAGER_MAIL'), 'Сервісний центр');

                        $message->to($clientEmail)->subject('TicketService: заявка прийнята.');
                    });
            }
        }
        else $status = 'Щось пішло не так. Спробуйте пізніше';

        return redirect()->back()->with('status', [$status]);  
    }

    public function ticketStatus(Request $request)
    {
        
        if ( $ticket = Ticket::where('ticket_article',$request->ticketCode )->first() )
        {
            $status = $ticket;
        }
        else
        {
            $status = 'Заявки під номером '.$request->ticketCode.' не знайдено у базі.';
        }

        return redirect()->back()->with('status', [$status]);
    }
}
