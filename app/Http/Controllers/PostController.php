<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function wyswietlPosty(){
        return Post::with('User')->get();
    }
    public function dodajPost(Request $request){
        $this->validate($request, [
            'user_ID'=> 'required',
            'title'=> 'required',
            'user_nickname'=> 'required',
            'content'=> 'required',
        ]);
        return Post::create([
            'user_ID'=> $request -> user_ID,
            'title'=> $request -> title,
            'user_nickname'=> $request -> user_nickname,
            'content'=> $request -> content
        ]);
    }
    public function edytujPost(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'title'=> 'required',
            'content'=> 'required',
        ]);
        $data =[
            'title'=> $request -> title,
            'content'=> $request -> content
        ];
        return Post::where('id', $request->id)->update($data);
    }
    public function usunPost(Request $request){
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Post::where('id', $request->id)->delete();
    }
    public function search(Request $request)
    {
        $search= $request->get('q');
        return Post::where('title', 'like','%'.$search.'%')->get();
         
    }
    public function sortujPostyup(){
        return Post::with('User')->orderBy('id','asc')->get();
    }
    
    public function sortujPostydown(){
        return Post::with('User')->orderBy('id','desc')->get();
    }
    public function filtrujPostID(Request $request){
        $filtr= $request->get('q');
        return Post::where('user_ID', 'like','%'.$filtr.'%')->get();
    }
}
