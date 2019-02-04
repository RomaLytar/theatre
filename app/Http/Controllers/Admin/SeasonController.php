<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeason;
use App\Models\Season;
use App\Repositories\SeasonRepository;
use Illuminate\Support\Facades\Session;

class SeasonController extends Controller
{
    protected $seasonRepository;

    public function __construct(SeasonRepository $seasonRepository)
    {
        $this->middleware('permission:season-list');
        $this->middleware('permission:season-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:season-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:season-delete', ['only' => ['destroy']]);

        $this->seasonRepository = $seasonRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::paginate();
        return view('admin.seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeason $request)
    {
        $data = $request->all();
        $this->seasonRepository->createSeasons($data);
        Session::flash('message', 'Successfully created album category!');
        return redirect()->route('seasons.index');
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
        $season = Season::find($id);
        if (empty($season)) {
            abort(404);
        }
        return view('admin.seasons.edit', compact('season'));
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
        $data = $request->all();
        $this->seasonRepository->editSeason($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('seasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Season::find($id)->delete();
        return redirect()->route('seasons.index');
    }
}
