<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create','store']);
        $this->middleware('permission:update_users')->only(['edit','update']);
        $this->middleware('permission:delete_users')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //whereRoleNot('super_admin')->
        $roles = Role::whereRoleNot(['super_admin'])->get();
        $users = User::whereRoleNot(['super_admin'])
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('roles')
            ->paginate(5);
        return view('dashboard.users.index', compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'status' => 'required',
            'role_id' => 'required|numeric',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);


        $user = User::create($request->all());
        $user->attachRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data Added successfully');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $request->validate([
            'name' => 'required',
          //  'email' =>[ 'required','email', Rule::unique('users','email') ->ignore($user->id)],
            'email' => 'required|email|unique:users,email,'.$user->id,
            'status' => 'required',
            'role_id' => 'required|numeric',
        ]);

        $user->update($request->all());
        $user->syncRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data Added successfully');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //////////////////////////////
        $user->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        // return response()->json(['message' => 'User status updated successfully.']);
        return response()->json(['success' => 'Status change successfully.']);
       // return session()->flash('success', 'Status change successfully');
    }

}
