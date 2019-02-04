<?php

namespace App\Http\Controllers\Admin;

use App\Models\HallPricePattern;
use App\Http\Requests\StoreHallPricePattern;
use App\Models\Hall;
use App\Models\PricePattern;
use App\Repositories\HallPricePatternRepository;
use App\Repositories\SeatPriceRepository;
use App\Transformers\HallTransformer;
use App\Transformers\SeatPriceTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HallPricePatternController extends Controller
{
    protected $hallPricePatternRepository;
    protected $seatPriceRepository;

    public function __construct(HallPricePatternRepository $hallPricePatternRepository, SeatPriceRepository $seatPriceRepository)
    {
        $this->middleware('permission:hall-price-pattern-list');
        $this->middleware('permission:hall-price-pattern-show', ['only' => ['show']]);
        $this->middleware('permission:hall-price-pattern-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:hall-price-pattern-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hall-price-pattern-delete', ['only' => ['destroy']]);

        $this->hallPricePatternRepository = $hallPricePatternRepository;
        $this->seatPriceRepository = $seatPriceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hallPricePatterns = HallPricePattern::with('hall', 'hall.translate', 'pricePattern')->latest()->paginate();

        $halls = Hall::all();
        $halls = array_multilanguage_formatter($halls, 'id', 'title');

        $pricePatterns = PricePattern::pluck('title', 'id');

        return view('admin.hall_price_patterns.index', compact('hallPricePatterns', 'halls', 'pricePatterns'));
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
    public function store(StoreHallPricePattern $request)
    {
        $data = $request->all();

        $hallPricePattern = $this->hallPricePatternRepository->createHallPricePattern($data);

        $hall = Hall::find($data['hall_id']);

        foreach ($hall->sections as $section) {
            foreach ($section->rows as $row) {
                foreach ($row->seats as $seat) {
                    $dataSeatPrice = [
                        'seat_id' => $seat->id,
                        'hall_price_pattern_id' => $hallPricePattern->id,
//                        'price_zone_id' => 4, // Test id
                    ];
                    $this->seatPriceRepository->createSeatPrice($dataSeatPrice);
                }
            }
        }

//        dd($seatsCollection);

        return response()->json([
            'data' => $hallPricePattern
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$hallPricePattern = HallPricePattern::with('hall', 'hall.translate')->find($id)) {
            abort(404);
        }

        if ($hallPricePattern->hall->name === 'outdoor') {
            $priceZones = $hallPricePattern->pricePattern->priceZones()->pluck('price', 'id');
            return view('admin.hall_price_patterns.show-simple', compact('hallPricePattern', 'priceZones'));
        }

        return view('admin.hall_price_patterns.show', compact('hallPricePattern'));
    }

    public function getHallWithSeats($id)
    {
        if (!$hallPricePattern = HallPricePattern::with(
            'seats',
            'seats.priceZone',
            'seats.seat',
            'seats.seat.media',
            'seats.seat.row',
            'seats.seat.row.section',
            'seats.seat.row.section.translate'
        )->find($id)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        return response()->json([
            'data' => [
                'id' => $hallPricePattern->hall->id,
                'name' => $hallPricePattern->hall->name,
                'title' => $hallPricePattern->hall->translate->title,
                'view_name' => 'View name',
                'price_pattern_id' => $hallPricePattern->pricePattern->id,
                'seats' => fractal()
                    ->collection($hallPricePattern->seats)
                    ->transformWith(new SeatPriceTransformer)
                    ->toArray()
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$hallPricePattern = HallPricePattern::find($id)) {
            abort(404);
        }

        return response()->json([
            'data' => $hallPricePattern,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHallPricePattern $request, $id)
    {
        if (!$hallPricePattern = HallPricePattern::find($id)) {
            throw new NotFoundHttpException('Ціновий шаблон залу не знайдено');
        }

        $data = $request->all();

        $hallPricePattern = $this->hallPricePatternRepository->editHallPricePattern($data, $id);

        return response()->json([
            'data' => $hallPricePattern
        ]);
    }

    public function updateSeatPrice(Request $request, $id)
    {
        if (!$hallPricePattern = HallPricePattern::find($id)) {
            throw new NotFoundHttpException('Ціновий шаблон залу не знайдено');
        }
        $data = $request->all();

        $seatPrices = $data['seats'];

        foreach ($seatPrices as $seatPrice) {
            $data = [
                'price_zone_id' => $seatPrice['price_zone_id'],
            ];
            $this->seatPriceRepository->editSeatPrice($data, $seatPrice['id']);
        }

        return response()->json([
            'data' => $hallPricePattern
        ]);
    }

    public function updateSeatPriceSimple(Request $request, $id)
    {
        if (!$hallPricePattern = HallPricePattern::find($id)) {
            throw new NotFoundHttpException('Ціновий шаблон залу не знайдено');
        }
        $data = $request->all();

        $seatsCount = $data['seats_count'];
        $seatPrices = $hallPricePattern->seats;
        $counter = 0;

        foreach ($seatPrices as $seatPrice) {
            $data = [
                'price_zone_id' => $counter < $seatsCount ? $data['price_zone_id'] : null,
            ];
            $this->seatPriceRepository->editSeatPrice($data, $seatPrice['id']);
            $counter++;
        }

        Session::flash('message', 'Ціновий шаблон залу успішно оновлено');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$hallPricePattern = HallPricePattern::find($id)) {
            abort(404);
        }
        $hallPricePattern->delete();
    }
}
