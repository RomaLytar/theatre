<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repositories\MessageRepository;
use App\Http\Requests\StoreMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class MessageController extends Controller
{
    protected $fileRepository;

    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:feed-back-list');
        $this->middleware('permission:feed-back-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:feed-back-delete', ['only' => ['destroy']]);

        $this->messageRepository = $messageRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::paginate();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessage $request)
    {
        $data = $request->all();
        $this->messageRepository->createMessage($data);
        Session::flash('message', 'Successfully send message');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        {
            $message = Message::where('id', $id)->first();
            return view('admin.messages.edit', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        if (empty($message)) {
            abort(404);
        }

        $this->messageRepository->changeStatus($id);

        return view('admin.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$message = Message::find($id)) {
            throw new NotFoundHttpException('Message plans not found');
        }
        $data = $request->all();

        $this->messageRepository->sendForm($request, $data, $id);

        return redirect()->route('messages.edit', ['id' => $message->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            Message::find($id)->delete();
            return redirect()->route('messages.index');
        }
    }
}
