<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UploadBookController extends Controller
{
    //
    function check(){

       $token= md5(uniqid(rand(), true));
       
       $row= DB::table('auhorization')
       ->where('user_id',1)
        ->get();
        if(count($row)==0){
            DB::table('auhorization')
            ->insert([
                'user_id'=>1,
                'token'=>$token
            ]);
        }
        else{
            DB::table('auhorization')
            ->where('user_id',1)
            ->update([
                'token'=>$token

            ]);
           
        }
    }

    function test(){
        echo session('user_id');
      }
      function insertSession(Request $req,$id){
        echo $id;
       $req->session()->put('user_id',$id);
       
       return view('welcome');
  
      }
      function getMessages(){
        
       $user_id = 1;
       return DB::table('messages')
        ->join('users','users.id','msg_from')
        ->where('msg_to',$user_id)
        ->get();
      }
  
      function rejectReq(Request $request){
        
        DB::table('notification')
        ->where('send_to',$request->send_to)
        ->where('send_from',$request->send_from)
        ->where('req_book_title',$request->req_book_title)
        ->update([
          "status"=>0
        ]);
      }
      function acceptReq(Request $request){
        
        DB::table('notification')
        ->where('send_to',$request->send_to)
        ->where('send_from',$request->send_from)
        ->where('req_book_title',$request->req_book_title)
        ->update([
          "status"=>1
        ]
        );
        DB::table('messages')
        ->insert([
          "msg_from"=>"admin",
          "msg_to"=>$request->send_to,
          "message"=>"you can now send message to siscuss wehrer to meet"   
       ]);
      }
        function viewBooks(){
       return  $books = DB::table('books')
          ->join('users','books.email','=','users.email')
          ->get();
         // return view('home_page',['books'=>$books]);
        }
  
        function uploadBooks(Request $request){
  
         
  
        //     $request->file('bookImage')->store('img');
  
        //    echo $request->file('bookImage')->getClientOriginalName();
  
        //  echo    $extension = $request->file('bookImage')->getClientOriginalExtension();
          // return $request->file('bookImage')->getClientOriginalName();
          // echo  $request->file('error');
          //dd($request->file('bookImage'));
         $image_path = md5(uniqid(rand(), true));
         $userId = 1;
          // echo $request->bookTitle;
          // echo $request->description;
          // echo $request->bookAuthor;
          // echo $request->file('bookImage')->getClientOriginalExtension();
          // echo $request->file('bookImage')->getClientOriginalName();
  
          //return $request->bookTitle;
  
       
            
   $request->file('bookImage')->move('uploads',$image_path);
  
         
        return DB::table('books')
         ->insert([
           "book_name"=>$request->bookTitle,
           "email"=>$request->email,
           "author_name"=>$request->bookAuthor,
           "description"=>$request->description,
           "book_image"=>$image_path,
  
         ]);
          // $books = DB::table('books')
          //   ->get();
          // return view('home_page',['books'=>$books]);
  
        }
  
        function testsubmit(Request $request){
  
          echo $request->test;
          echo $request->test2;
        }
  
        function sendNotification(Request $req)
        {
         
        DB::table('notification')
        ->insert (
        ['req_book_title'=>$req->req_book_title,
        'req_book_authors_name' => $req->req_book_authors_name,
        'req_book_description'=>$req->req_book_description,
          'send_to'=>$req->send_to,
          'book_id'=>$req->book_id,
          'send_from'=>$req->send_from]);
  
          return "book inserted";
         
  
        }
  
        function getNotification (Request $request) {
        return  $notifications = DB::table('notification')
          ->join('books','books.id','book_id')
          ->join('users','users.email','send_from')
          ->where ('send_to', $request->email)
          -> get();
  
          // foreach($notifications as $notification){
          //   return $notification->book_id;
          // }
          //return view ('view_notification',['notifications'=>$notification]);
          //return view('view_notification');
        }
}
