<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;



class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:user.create')->only(['create','store']);
    //     $this->middleware('permission:user.index')->only('index');
    //     $this->middleware('permission:user.edit')->only(['edit','update']);
    //     $this->middleware('permission:user.show')->only('show');
    //     $this->middleware('permission:user.destroy')->only('destroy');
    // }
  
    public function index()
    {
        // return response()
        // ->json([
        //     'model' => User::filterPaginateOrder()
        // ]);
        //  return User::orderBy('id','DESC')->get();
         return User::all();
    }

    public function create()
    {
        return response()
            ->json([
                'form' => User::initialize(),
                'option' => []
            ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]); 

        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->save();
        // $create = Post::create($request->all());
        return response()
        ->json([
            'saved' => true
        ]);
        // return response()->json(['status' => 'success','msg'=>'post created successfully']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()
            ->json([
                'model' => $user
            ]);
    }

    public function edit($id)
    {
        $User = User::findOrFail($id);
        // dd($User);

        return response()
            ->json([
                'form' => $User,
                'option' => []
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $User = User::findOrFail($id);
        // dd($user);
        $User->update($request->all());

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);

        // TODO: delete customer's invoices first

        $User->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
