<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use App\Models\Project;
use SEO;

class ProjectController extends Controller
{
  public function show($id, $slug)
  {
    $projects = Project::with('translate')->limit(12)->get();
    $project = Project::with('translate')->where('id',$id)->first();
      if($project->translate->slug !== $slug) {
        return redirect()->route('front.projects.show', ['id' => $id, 'slug' => $project->translate->slug]);
      }
          return view('pages.theatre.pages.project',compact('project', 'projects'));
  }

  public function creative($id, $slug){
    $category = ProjectCategory::where('name', 'creative')->first();;
    $projects = Project::with('translate')->where('category_id', $category->id)->get();
    $project = Project::with('translate')->where('id', $id)->first();
    if($project->translate->slug !== $slug) {
      return redirect()->route('front.creative.show', ['id' => $id, 'slug' => $project->translate->slug]);
    }

    return view('pages.theatre.pages.creative_projects', compact('projects','project'));
  }

  public function contests($id,$slug){
    $category = ProjectCategory::where('name', 'contests')->first();
    $projects = Project::with('translate')->where('category_id', $category->id)->get();
    $project = Project::with('translate')->where('id', $id)->first();
    if($project->translate->slug !== $slug) {
      return redirect()->route('front.contests.contest', ['id' => $id, 'slug' => $project->translate->slug]);
    }
    return view('pages.theatre.pages.helpful_competition', compact('projects','project'));
  }
}
