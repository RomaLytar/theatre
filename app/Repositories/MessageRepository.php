<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Mail\SendEmail;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;




class MessageRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Message';
  }

  public function createMessage($data)
  {
    $message = [
      'read' => $data['read'] ?? null,
      'name' => $data['name'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'description' => $data['description'] ?? null,
      'answer' => $data['answer'] ?? null,
    ];
    $message = $this->create($message);
    return $message;
  }

  public function sendForm($request,$data,$id){
    $answer = $request->answer;
    $email = $request->email;
    $name = $request->name;
    Mail::to($email)->send(new SendEmail($answer,$name));
    $message = [
      'answer' => $data['answer'] ?? null,
      'send' => true
    ];
    $this->update($message, ['id' => $id]);
  }

  public function changeStatus($id)
  {
    $this->update(['read' => true], ['id' => $id]);
  }
}
