<?php

namespace App\Http\Controllers;
use App\Models\Role;


use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function dodajRole(Request $request)
    {
        // validate request
        $this->validate($request, [
            'Nazwa' => 'required',
        ]);
        return Role::create([
            'Nazwa' => $request->Nazwa,
        ]);
    }
    public function edytujRole(Request $request)
    {
        // validate request
        $this->validate($request, [
            'Nazwa' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'Nazwa' => $request->Nazwa,
        ]);
    }
    public function wyswietlRole()
    {
        return Role::all();
    }
}
