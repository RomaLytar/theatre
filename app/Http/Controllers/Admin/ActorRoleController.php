<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActorRole;
use App\Models\ActorRole;
use App\Repositories\ActorRoleRepository;
use Illuminate\Support\Facades\Session;

class ActorRoleController extends Controller
{
  protected $actorRoleRepository;

  public function __construct(ActorRoleRepository $actorRoleRepository) {
      $this->middleware('permission:actor-role-list');
      $this->middleware('permission:actor-role-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:actor-role-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:actor-role-delete', ['only' => ['destroy']]);

      $this->actorRoleRepository = $actorRoleRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actorRoles = ActorRole::paginate();
    return view('admin.actor_roles.index', compact('actorRoles'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.actor_roles.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreActorRole $request)
  {
    $data = $request->all();
    $this->actorRoleRepository->createActorRole($data);
    Session::flash('message', 'Successfully created nerd!');
    return redirect()->route('actor-roles.index');
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
    $actorRole = ActorRole::find($id);
    if(empty($actorRole)){
      abort(404);
    }
    return view('admin.actor_roles.edit', compact('actorRole'));
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
    $this->actorRoleRepository->editActorRole($data, $id);
    Session::flash('message', 'Successfully updated actorRole!');
    return redirect()->route('actor-roles.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    ActorRole::find($id)->delete();
    return redirect()->route('actor-roles.index');
  }



}
