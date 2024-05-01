<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Entries;
use App\Http\Requests\ExampleFormRequest;

class UserController extends Controller
{
    public function showCreate()
    {
        return view('admin.create');
    }

    public function create(Request $request)
    {
        $user = User::query()->create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password'])
        ]);

        Auth::login($user);

        return redirect()->route('admin.index');
    }

    public function admin()
    {
        if (Auth::check()) {
            $entries = Entries::all();
            return view('admin.index', compact('entries'));
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back();
    }

    public function showDetail($id)
    {
		$entry = Entries::find($id);
        
		return view("admin.detail", compact('entry'));
	}

    public function showEdit($id)
    {
		$entry = Entries::find($id);
        
        $prefs = config('prefectures');
        $years = config('years');
        $months = config('months');
        $days = config('days');
        $jobTypes = config('jobTypes');

        $data = 
        list($birthday_year, $birthday_month, $birthday_day) = explode('-', $entry->birthday);
        $data = [
            'birthday_year' => $birthday_year,
            'birthday_month' => $birthday_month,
            'birthday_day' => $birthday_day
        ];

        return view("admin.edit", compact('entry', 'data', 'years', 'months', 'days', 'prefs', 'jobTypes'));
	}

    public function update(ExampleFormRequest $request, $id)
    {
        $request->validated();
        $entry = Entries::find($id);
        $entry->update($request->except(['_token']));

        return redirect()->route('admin.index')->with('success', '更新しました');
    }

    public function delete($id)
    {
        $entry = Entries::find($id);
        $entry->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

}
