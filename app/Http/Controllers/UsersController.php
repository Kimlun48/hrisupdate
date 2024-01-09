<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */

    /*
    
    */
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = " <a href='/users/$row->id/show' class='btn btn-info btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Show'><i class='fas fa-eye' style='color:#fff;'></i></a> 
                    &nbsp; <a href='/users/$row->id/edit' class='btn btn-primary btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit'><i class='fas fa-pencil-alt' style='color:#fff;'></i></a>
                    &nbsp; <a href='/users/$row->id/delete' class='btn btn-danger btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete'><i class='fas fa-trash-alt' style='color:#fff;'></i></a> ";
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index');

    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test' 
        ]));

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
	$kar = Karyawan::where('fk_user','=', $user->id)->first();
	$now = Carbon::now()->format('Y-m-d H:i:s');
        if ($kar){
            $kar->email = $request->email;
            $kar->save();
	}
	if ($user->email_verified_at == Null){
            $user->email_verified_at = $now;
            $user->save();
	}
	if($request->resetpass ="Yes"){
            $user->password = Hash::make('Qwerty123#');
            $user->confirm_password = Hash::make('Qwerty123#');
            $user->save();
        }
	if($request->aktif ="Aktif"){
            $user->status_aktif = 'Aktif';
            $user->save();
        }
        $user->update($request->validated());
	    $user->syncRoles($request->get('role'));
        return redirect()->route('users.index')
        ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
