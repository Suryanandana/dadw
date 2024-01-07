<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Customer;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function getAdmin()
    {
        $data = User::where('level', 'admin')->get();
        return view('admin.account.admin', compact('data'));
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        
        try {
            $password = "password123";
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => 'admin',
                'password' => bcrypt($password),
            ]);
    
            // send an email to the email entered
            event(new Registered($data));
            // provides login access when verifying email
            Auth::login($data);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return redirect('/admin-account')->with('error', $error);
        }

        return redirect('/admin-account')->with('success', 'successfully added data, the default password is "password123" please change it later.');
    }

    // update user data
    public function updateUser(Request $request, $id)
    {
        $data = User::find($id);

        // update admin to customer level
        if($data->level == 'admin' && $request->level == 'customer'){
            try {
                DB::beginTransaction();

                $user = User::find($id);

                $user->update([
                    'name' => $request->name,
                    'level' => $request->level,
                ]);

                Customer::create([
                    'id_users' => $id,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $error = $th->getMessage();
                return redirect('/admin-account')->with('error', $error);
            }
        }elseif($data->level == 'admin' && $request->level == 'staff'){
            try {
                DB::beginTransaction();

                $user = User::find($id);

                $user->update([
                    'name' => $request->name,
                    'level' => $request->level,
                ]);

                Staff::create([
                    'id_users' => $id,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $error = $th->getMessage();
                return redirect('/admin-account')->with('error', $error);
            }
        }elseif($data->level == 'customer' && $request->level == 'staff'){
            try {
                DB::beginTransaction();

                $user = User::find($id);

                $user->update([
                    'name' => $request->name,
                    'level' => $request->level,
                ]);

                Staff::create([
                    'id_users' => $id,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $error = $th->getMessage();
                return redirect('/admin-account')->with('error', $error);
            }

        }
        return redirect('/admin-account')->with('success', 'successfully updated data.');
    }
}
