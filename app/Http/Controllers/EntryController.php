<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Mail\EntryAdminMail;
use App\Mail\EntryUserMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Entry;
use Carbon\Carbon;

class EntryController extends Controller
{
    public function index()
    {
        $prefs = config('prefectures');
        $years = config('years');
        $months = config('months');
        $days = config('days');
        $jobTypes = config('jobTypes');

        $data = collect(request()->session()->get('data'));
        request()->session()->forget('data');

        return view('entries.index', compact('data', 'years', 'months', 'days', 'prefs', 'jobTypes'));
    }

    public function confirm(EntryRequest $request)
    {
        $data = $request->validated();
        $request->session()->put('data', $data);

        return view('entries.confirm', compact('data'));
    }

    public function thanks()
    {
        $data = request()->session()->get('data');
        request()->session()->forget('data');

        $adminEmail = config('mail.from.address');
        $userEmail = $data['email'];

        Mail::to($adminEmail)->send(new EntryAdminMail($data));
        Mail::to($userEmail)->send(new EntryUserMail($data));

        $data['birthday'] = Carbon::parse($data['birthday_year'] . '-' . $data['birthday_month'] . '-' . $data['birthday_day'])->format('Y-m-d');

        Entry::create($data);

        return view('entries.thanks');
    }
}
