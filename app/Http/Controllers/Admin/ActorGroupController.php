<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActorGroup;
use App\Models\ActorGroup;
use App\Repositories\ActorGroupRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ActorGroupController extends Controller
{

  protected $actorGroupRepository;

  public function __construct(ActorGroupRepository $actorGroupRepository)
  {
      $this->middleware('permission:actor-group-list');
      $this->middleware('permission:actor-group-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:actor-group-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:actor-group-delete', ['only' => ['destroy']]);

      $this->actorGroupRepository = $actorGroupRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actorGroups = ActorGroup::with('translate', 'children_groups', 'children_groups.translate', 'children_groups.children_groups', 'children_groups.children_groups.translate')->where('parent_id', null)->get();
    return view('admin.actor_groups.index', compact('actorGroups'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $actorGroups = ActorGroup::with('translate')->get();
    $actorGroups = array_multilanguage_formatter($actorGroups, 'id', 'title');
    return view('admin.actor_groups.create', compact('actorGroups'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreActorGroup $request)
  {
    $data = $request->all();
    $this->actorGroupRepository->createActorGroups($data);
    Session::flash('message', 'Successfully created nerd!');
    return redirect()->route('actor_groups.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $actor_group = ActorGroup::find($id);
    if(empty($actor_group)){
      abort(404);
    }
    $actorGroups = ActorGroup::with('translate')->where('id', '!=', $id)->get();
    $actorGroups = array_multilanguage_formatter($actorGroups, 'id', 'title');
    return view('admin.actor_groups.edit', compact('actor_group', 'actorGroups'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
    $this->actorGroupRepository->editActorGroup($data, $id);
    Session::flash('message', 'Successfully updated nerd!');
    return redirect()->route('actor_groups.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    ActorGroup::find($id)->delete();
    return redirect()->route('actor_groups.index');
  }
}
