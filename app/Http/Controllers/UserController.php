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

    public function admin(Request $request)
    {
        $data = $request;

        $keywords = $data->input('keywords');
        $jobPrefectureId = $data->input('job_prefecture_id');
        $jobTypeId = $data->input('job_type_id');

        $prefs = config('prefectures');
        $jobTypes = config('jobTypes');

        if (Auth::check()) {
            $query = Entries::query();

            if (!empty($keywords)) {
                $search_split = mb_convert_kana($keywords, 's');
                $search_split2 = preg_split('/[\s]+/', $search_split);

                foreach ($search_split2 as $value) {
                    $query->where(function($query) use ($value) {
                        $query->where('name', 'LIKE', "%{$value}%")
                            ->orWhere('kana_name', 'LIKE', "%{$value}%");
                    });
                }
            }

            if(!empty($jobPrefectureId)) {
            $query->where('job_prefecture_id', 'LIKE', $jobPrefectureId);
            }

            if(!empty($jobTypeId)) {
                $query->where('job_type_id', 'LIKE', $jobTypeId);
            }

            $entries = $query->paginate(5);

            return view('admin.index', compact('data', 'entries', 'prefs', 'jobTypes'));
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
