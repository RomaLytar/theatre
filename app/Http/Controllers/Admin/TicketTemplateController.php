<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTicketTemplate;
use App\Models\TicketTemplate;
use App\Repositories\TicketTemplateRepository;
use App\Transformers\TicketTemplateTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketTemplateController extends Controller
{
    protected $ticketTemplateRepository;

    public function __construct(TicketTemplateRepository $ticketTemplateRepository)
    {
        $this->middleware('permission:ticket-designer-manage');

        $this->ticketTemplateRepository = $ticketTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = TicketTemplate::all();

        return fractal()
            ->collection($templates)
            ->transformWith(new TicketTemplateTransformer)
            ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketTemplate $request)
    {
        $data = $request->all();
        $ticketTemplate = $this->ticketTemplateRepository->createTicketTemplate($data);

        $this->checkAndUploadImage($request, 'poster', 'posters', $ticketTemplate);

        return response()->json([
            'status' => true,
            'message' => 'The ticket template was successfully created'
        ]);
    }

    public function show($id) {
        $ticketTemplate = TicketTemplate::find($id);

        return fractal()
            ->item($ticketTemplate)
            ->transformWith(new TicketTemplateTransformer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTicketTemplate $request, $id)
    {
        if(!$ticketTemplate = TicketTemplate::find($id)) {
            return response()->json([
                'status' => false,
                'message' => 'This ticket template doesn\'t exist'
            ]);
        }
        $data = $request->all();

        $this->checkAndUploadImage($request, 'poster', 'posters', $ticketTemplate);

        $this->ticketTemplateRepository->editTicketTemplate($data, $id);

        return response()->json([
            'status' => true,
            'message' => 'The ticket template was successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ticketTemplateRepository->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'The ticket template was successfully deleted'
        ]);
    }

    public function checkAndUploadImage($request, $fileName, $collection, $model): void
    {
        if ($file = $request->file($fileName)) {
            if ($model->getMedia($collection)->first()) {
                $model->getMedia($collection)->first()->delete();
            }
            $model->addMedia($file)->toMediaCollection($collection);
        }
    }
}
