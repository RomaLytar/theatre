<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePricePattern;
use App\Models\Color;
use App\Models\PerformanceCalendar;
use App\Models\PricePattern;
use App\Repositories\PricePatternRepository;
use App\Repositories\PriceZoneRepository;
use App\Transformers\PricePatternTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PricePatternController extends Controller
{
    protected $pricePatternRepository;
    protected $priceZoneRepository;

    public function __construct(PricePatternRepository $pricePatternRepository, PriceZoneRepository $priceZoneRepository)
    {
        $this->middleware('permission:price-pattern-list');
        $this->middleware('permission:price-pattern-show', ['only' => ['show']]);
        $this->middleware('permission:price-pattern-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:price-pattern-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:price-pattern-delete', ['only' => ['destroy']]);

        $this->pricePatternRepository = $pricePatternRepository;
        $this->priceZoneRepository = $priceZoneRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricePatterns = PricePattern::latest()->paginate();

        return view('admin.price_patterns.index', compact('pricePatterns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.price_patterns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePricePattern $request)
    {
        $data = $request->all();

        $pricePattern = $this->pricePatternRepository->createPricePattern($data);

        $colors = Color::all();

        foreach ($colors as $color) {
            $dataPricePattern = [
                'price_pattern_id' => $pricePattern->id,
                'color_id' => $color->id,
            ];
            $this->priceZoneRepository->createPriceZone($dataPricePattern);
        }

        return response()->json([
            'data' => $pricePattern
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
        if (!$pricePattern = PricePattern::find($id)) {
            abort(404);
        }

        // It is necessary to check the attachment for performances
        $hallPricePatternIds = $pricePattern->hallPricePatterns()->pluck('id');
        $performanceCalendars = PerformanceCalendar::whereIn('hall_price_pattern_id', $hallPricePatternIds)->get();

        return view('admin.price_patterns.show', compact('pricePattern', 'performanceCalendars'));
    }

    public function getPricePattern($id)
    {
        if (!$pricePattern = PricePattern::with(
            'priceZones',
            'priceZones.color'
        )->find($id)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        }

        return fractal()
            ->item($pricePattern)
            ->parseIncludes(['priceZones'])
            ->transformWith(new PricePatternTransformer())
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
        if (!$pricePattern = PricePattern::find($id)) {
            abort(404);
        }

        return response()->json([
            'data' => $pricePattern
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePricePattern $request, $id)
    {
        if (!$album = PricePattern::find($id)) {
            throw new NotFoundHttpException('Ціновий шаблон не знайдено');
        }

        $data = $request->all();

        $pricePattern = $this->pricePatternRepository->editPricePattern($data, $id);

        return response()->json([
            'data' => $pricePattern
        ]);
    }

    public function updatePriceZones(Request $request, $pricePatternId)
    {
        if (!$pricePattern = PricePattern::find($pricePatternId)) {
            abort(404);
        }

        $data = $request->all();

        foreach ($pricePattern->priceZonesAll as $priceZone) {
            $this->priceZoneRepository->editPriceZone($data, $priceZone->id);
        }

        Session::flash('message', 'Оновлено успішно');
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
        if (!$pricePattern = PricePattern::find($id)) {
            abort(404);
        }
        $pricePattern->delete();
    }
}
