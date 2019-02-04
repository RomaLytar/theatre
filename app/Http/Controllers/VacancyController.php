<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Mail\ProfileEmail;
use Illuminate\Support\Facades\Mail;

class VacancyController extends Controller
{
  public function show($id, $slug)
  {
    $vacancy = Vacancy::with('translate')->where('id',$id)->first();
    if($vacancy->translate->slug !== $slug) {
      return redirect()->route('front.vacancies.show', ['id' => $id, 'slug' => $vacancy->translate->slug]);
    }

    return view('pages.theatre.pages.helpful_vacancy',compact('vacancy'));
  }

    public function sendProfile(Request $request)
    {
        $profile = [
            'email' => $request['email'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'file' => $request['file'],
        ];
        $prof = $this->create($profile);

        Mail::to('RomaLytar@gmail.com')->send(new ProfileEmail($prof));
    }
}
