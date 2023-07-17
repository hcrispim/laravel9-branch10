<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUpdateUserFormRequest;
              

class UserController extends Controller
{

    public function index(Request $request)
    {
       // dd('UserController@index');
       //$users = User::where('name', 'LIKE', "%{$request->search}%")->get();
       // dd($users);
       $search = $request->search;
       $users = User::where( function ($query) use ($search) {
        if ($search) {
          $query->where('email', $search);
          $query->orWhere('name','LIKE',"%{$search}%");
        }
       })->get();

       return view('users.index',compact('users'));
    }

    public function show($id)
    {
       // dd('UserController@index');
      // $user = User::where('id',$id)->first();
      if (!$user = User::find($id))
          return redirect()->route('users.index');
       return view('users.show', compact('user'));
    }


    public function create()
    {
          return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        //return view('users.store');
        //dd($request->all());
/*         dd($request->only([
          'name','email','password'
        ])); */
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create( $data);
        return redirect()->route('users.index'); 
    }

    public function edit($id)
    {
      if (!$user = User::find($id))
          return redirect()->route('users.index');
      return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest  $request, $id)
    {
      if (!$user = User::find($id))
          return redirect()->route('users.index');
      //return view('users.edit', compact('user'));
      //dd( $request->all());
      //$user->name = $request->get('name'); ou
      //$user->save(); ou 
      $data = $request->only('name','email');
      if ($request->password)
          $data['password'] = bcrypt($request->password);
      $user->update($data);
      return redirect()->route('users.index'); 
    }
    public function destroy($id)
    {
       // dd('UserController@index');
      // $user = User::where('id',$id)->first();
      if (!$user = User::find($id))
          return redirect()->route('users.index');

       $user->delete();
       return view('users.show', compact('user'));
    }
}
