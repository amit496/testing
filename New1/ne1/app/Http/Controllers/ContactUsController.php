<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validations\ContactUsRequest;
use App\Jobs\SendContactFromMessageToAdmin;
use App\Models\Message;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    private $model;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = trans('app.model.message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(ContactUsRequest $request)
    {
        $message = Message::create($request->all());

        // Dispatching SendContactFromMessageToAdmin job
        try {
            SendContactFromMessageToAdmin::dispatch($message);
        } catch (\Exception $exception) {
            Log::error('Mail Sending Error');
            Log::info(get_exception_message($exception));
        }

        if ($request->ajax()) {
            return response(trans('messages.sent', ['model' => $this->model]), 200);
        }

        return back()->with('success', trans('messages.sent', ['model' => $this->model]));
    }

    public function show_contact(Request $request)
    {        
        // $message_tbl = Message::all()->whereNull('deleted_at')->sortByDesc('id')->paginate(5)->onEachSide(2);
      
        // dd($message_tbl);
        // $contact_us_data = $message_tbl->whereNull('deleted_at')->orderBy('id', 'desc')->get()->paginate(30)->onEachSide(2);

        $contact_us_data = DB::table('messages')->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

        return view('admin.contact.index', compact('contact_us_data'));

        

    }   
    
    public function PermanentalyTrash(Request $request, $id)
    {
        if (config('app.demo') == true && $id <= config('system.demo.customers', 1)) {
            var_dump("if exicute");
            return back()->with('warning', trans('messages.demo_restriction'));
        }
        // dd($id);
          

        $update = DB::table('messages')->where('id',"$id")->update(            
            [
                'deleted_at' => Carbon::now(),
            ]
        );

        if ($update) {            
            return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
        }


    }
    public function readed(Request $request, $id)
    {   
        $update = DB::table('messages')->where('id',"$id")->update(            
            [
                'read_msg' => 1,
            ]
        );
        if ($update) {            
            return back()->with('success', trans('messages.read_msg_status', ['model' => $this->model]));
        }
    }
}
