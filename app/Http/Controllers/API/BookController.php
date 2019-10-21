<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Validator;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

  public function index()
 {
     $books = Book::all();
     $data = $books->toArray();

     $response = [
         'success' => true,
         'data' => $data,
         'message' => 'Books retrieved successfully.'
     ];

     return response()->json($response, 200);
 }


 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
     $input = $request->all();

     $validator = Validator::make($input, [
         'name' => 'required',
         'author' => 'required'
     ]);

     if ($validator->fails()) {
         $response = [
             'success' => false,
             'data' => 'Validation Error.',
             'message' => $validator->errors()
         ];
         return response()->json($response, 404);
     }

     $book = Book::create($input);
     $data = $book->toArray();

     $response = [
         'success' => true,
         'data' => $data,
         'message' => 'Book stored successfully.'
     ];

     return response()->json($response, 200);
 }


 /**
  * Display the specified resource.
  *
  * @param  int $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
   $book = Book::where('id',$id)->get();

   if (count($book) > 0){
     $response = [
       'success' => true,
       'data' => $book,
       'message' => 'Book retrieved successfully.'
     ];

     return response()->json($response, 200);
   }else {
     $response = [
       'success' => false,
       'message' => 'Bukunya Gaada Bos.'
     ];

     return response()->json($response, 400);
   }


 }


 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @param  int $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Book $book)
 {
     $input = $request->all();

     $validator = Validator::make($input, [
         'name' => 'required',
         'author' => 'required'
     ]);

     if ($validator->fails()) {
         $response = [
             'success' => false,
             'data' => 'Validation Error.',
             'message' => $validator->errors()
         ];
         return response()->json($response, 404);
     }

     $book->name = $input['name'];
     $book->author = $input['author'];
     $book->save();

     $data = $book->toArray();

     $response = [
         'success' => true,
         'data' => $data,
         'message' => 'Book updated successfully.'
     ];

     return response()->json($response, 200);
 }


 /**
  * Remove the specified resource from storage.
  *
  * @param  int $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {

   $data = DB::table('books')->where('id', $id)->delete();
   if($data){
     $res['status'] = "200";
     $res['message'] = "Success!";
     return response($res);
   }
   else{
       $res['status'] = "200";
       $res['message'] = "Failed!";
       return response($res);
   }

 }

}
