<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() && $request->path() != 'login') {
            return view('welcome');
        }
        $user = Auth::user();
        if ($request->path() == 'login') {
            return redirect('/');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            return response()->json([
                'msg'=> 'Zalogowałeś się',
                'user'=>$user
            ]);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function dodajUzytkownika(Request $request){
        $this->validate($request, [
            'nickname'=> 'required',
            'email'=> 'required|email',
            'password'=> 'requiremin6',
        ]);
        $password=md5($request-> password);
        return User::create([
            'nickname'=> $request -> nickname,
            'email'=> $request -> email,
            'password'=> $password,
        ]);
    }
    public function edytujUzytkownika(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'nickname'=> 'required',
            'email'=> 'required|email',
        ]);
        //$password=md5($request-> password);
        $data =[
            'nickname'=> $request -> nickname,
            'email'=> $request -> email,
            //'password'=> $password,
        ];
        return User::where('id', $request->id)->update($data);
    }
        public function usunUzytkownika(Request $request){
        $this->validate($request, [
            'id' => 'required',
        ]);
        return User::where('id', $request->id)->delete();
    }
    public function wyswietlUzytkownikow(Request $request){
        $total =1;
        return User::paginate($request->$total);
    }
}
