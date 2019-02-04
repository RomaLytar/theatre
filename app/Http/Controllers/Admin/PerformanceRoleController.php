<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use App\Models\ActorRole;
use App\Models\Performance;
use App\Models\PerformanceActor;
use App\Models\PerformanceCalendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PerformanceRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:performance-actor-role-edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$performance = Performance::find($id)) {
            abort(404);
        }

        $actorIds = $performance->actorIds();
        $actorRoleIds = $performance->actorRoleIds();
        $actors = Actor::whereIn('id', $actorIds)->get();
        foreach ($actors as $actor) {
            foreach ($actorRoleIds as $item) {
                foreach ($item as $actorId => $roleId) {
                    if ($actor->id === $actorId) {
                        $actor->role_id = $roleId;
                        break;
                    }
                }
            }
        }

        $actorRoles = ActorRole::all();
        $actorRoles = array_multilanguage_formatter($actorRoles, 'id', 'title');

        return view('admin.performance_roles.edit', compact('performance', 'actors', 'actorRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $performance_id = $data['performance_id'];
        $data = array_except($request->all(), ['_method', '_token']);

        $performance = Performance::find($performance_id);

        $dates = $performance->dateIds();

        $actors = PerformanceActor::whereIn('performance_calendar_id', $dates)->get();

        foreach ($actors as $actor) {
            foreach ($data as $actorId => $roleId) {
                if ($actor->actor_id === $actorId) {
                    $actor->update(['actor_role_id' => $roleId]);
                }
            }
        }

        return redirect()->route('performance.index');
    }
}
