<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Repositories\PartnerRepository;
use App\Repositories\ImageRepository;
use App\Repositories\VideoRepository;
use App\Http\Requests\StorePartner;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PartnerController extends Controller
{

    protected $partnerRepository;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->middleware('permission:partner-list');
        $this->middleware('permission:partner-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:partner-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:partner-delete', ['only' => ['destroy']]);

        $this->partnerRepository = $partnerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::with('category', 'translate', 'category.translate', 'media')->latest()->paginate();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partnerCategories = PartnerCategory::all();
        $partnerCategories = array_multilanguage_formatter($partnerCategories, 'id', 'title');
        return view('admin.partners.create', compact('partnerCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePartner|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartner $request)
    {
        $data = $request->all();

        $partner = $this->partnerRepository->createPartners($data);

        if ($request->file('poster')) {
            $partner->addMediaFromRequest('poster')->toMediaCollection('posters');
        }

        Session::flash('message', 'Successfully created partner!');
        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$partner = Partner::find($id)) {
            abort(404);
        }
        $partnerCategories = PartnerCategory::all();
        $partnerCategories = array_multilanguage_formatter($partnerCategories, 'id', 'title');

        return view('admin.partners.edit', compact('partnerCategories', 'partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePartner|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StorePartner $request, $id)
    {
        if (!$partner = Partner::find($id)) {
            throw new NotFoundHttpException('Partner not found');
        }
        $data = $request->all();

        if ($request->file('poster')) {
            if ($partner->getMedia('posters')->first()) {
                $partner->getMedia('posters')->first()->delete();
            }
            $partner->addMediaFromRequest('poster')->toMediaCollection('posters');
        }

        $this->partnerRepository->editPartner($data, $partner);
        Session::flash('message', 'Successfully edited partner!');
        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        $partner->delete();
        return redirect()->route('partners.index');
    }
}
