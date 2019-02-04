<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Repositories\SeatRepository;
use App\Transformers\HallTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\HallTranslation;
use App\Repositories\HallRepository;
use App\Http\Requests\StoreHall;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class HallController extends Controller
{
    protected $fileRepository;

    protected $hallRepository;

    protected $seatRepository;

    public function __construct(HallRepository $hallRepository, FileRepository $fileRepository, SeatRepository $seatRepository)
    {
        $this->middleware('permission:hall-list');
        $this->middleware('permission:hall-seat-best-choice-edit', ['only' => ['show', 'updateHallSeats']]);
        $this->middleware('permission:hall-seat-image-edit', ['only' => ['showImages', 'updateHallSeatPosters']]);
        $this->middleware('permission:hall-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:hall-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hall-delete', ['only' => ['destroy']]);

        $this->hallRepository = $hallRepository;
        $this->fileRepository = $fileRepository;
        $this->seatRepository = $seatRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::with('translate', 'media')->paginate();
        return view('admin.hall_plans.index', compact('halls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hall_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHall $request)
    {
        $data = $request->all();
        $hall = $this->hallRepository->createHall($data);
        if ($img = $request->file('poster')) {
            $hall->addMedia($img)->toMediaCollection('posters');
        }

        if ($request->file('photo')) {
            $hall->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('hall-images');
                });
        }

        Session::flash('message', 'Successfully created hall plans!');
        return redirect()->route('halls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$hall = Hall::with('translate')->find($id)) {
            throw new NotFoundHttpException('Зал не знайдено!');
        }

        return view('admin.hall_plans.show', compact('hall'));
    }

    public function showImages($id)
    {
        if (!$hall = Hall::with('translate')->find($id)) {
            throw new NotFoundHttpException('Зал не знайдено!');
        }

        return view('admin.hall_plans.show-images', compact('hall'));
    }

    public function getHallSeats($id)
    {
        if (!$hall = Hall::find($id)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        return fractal()
            ->item($hall)
            ->parseIncludes(['sections', 'rows', 'seats'])
            ->transformWith(new HallTransformer)
            ->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hall = Hall::find($id);
        if (empty($hall)) {
            abort(404);
        }

        return view('admin.hall_plans.edit', compact('hall'));
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
        if (!$hall = Hall::find($id)) {
            throw new NotFoundHttpException('Hall plans not found');
        }
        $data = $request->all();
        if ($request->file('poster')) {
            if ($hall->getMedia('posters')->first()) {
                $hall->getMedia('posters')->first()->delete();
            }
            $hall->addMediaFromRequest('poster')->toMediaCollection('posters');
        }
        $this->hallRepository->editHall($data, $id);

        if (isset($data['uploadedImages'])) {
            $ids = [];
            foreach ($data['uploadedImages'] as $id) {
                $ids[] = $id;
            }
            $images = $hall->getMedia('hall-images')->whereIn('id', $ids);
            $hall->clearMediaCollectionExcept('hall-images', $images);
        } else {
            $hall->clearMediaCollection('hall-images');
        }

        if ($request->file('images')) {
            $hall->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('hall-images');
                });
        }

        Session::flash('message', 'Successfully updated hall plans!');
        return redirect()->route('halls.index');
    }

    public function updateHallSeats(Request $request, $id)
    {
        if (!$hall = Hall::find($id)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        $data = $request->all();

        $seats = $data['seats'];

        foreach ($seats as $seat) {
            $data = [
                'recommended' => $seat['recommended'],
            ];
            $this->seatRepository->editSeat($data, $seat['id']);
        }

        return response()->json([
            'data' => $hall
        ]);
    }

    public function updateHallSeatPosters(Request $request, $id)
    {
        if (!$hall = Hall::find($id)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        $data = $request->all();
        $seats = $data['seats'];

        foreach ($seats as $seat) {
            $seatModel = Seat::find($seat['id']);
            $this->checkAndUploadImage($seat['poster'], 'posters', $seatModel);
        }

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hall::find($id)->delete();
        return redirect()->route('halls.index');
    }

    public function checkAndUploadImage($file, $collection, $model): void
    {
        if ($file != null) {
            if ($model->getMedia($collection)->first()) {
                $model->getMedia($collection)->first()->delete();
            }
            $model->addMedia($file)->toMediaCollection($collection);
        }
    }
}
