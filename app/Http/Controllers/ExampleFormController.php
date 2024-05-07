<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExampleFormRequest;
use App\Mail\ExampleFormAdminMail;
use App\Mail\ExampleFormUserMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Entry;

class ExampleFormController extends Controller
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

        return view('example_form.index', compact('data', 'years', 'months', 'days', 'prefs', 'jobTypes'));
    }

    public function confirm(ExampleFormRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $request->session()->put('data', $data);

        return view('example_form.confirm', compact('data'));
    }

    public function thanks()
    {
        $data = request()->session()->get('data');
        request()->session()->forget('data');

        $adminEmail = config('mail.from.address');
        $userEmail = $data['email'];

        Mail::to($adminEmail)->send(new ExampleFormAdminMail($data));
        Mail::to($userEmail)->send(new ExampleFormUserMail($data));

        $birthday = $data['birthday_year'] . '-' . $data['birthday_month'] . '-' . $data['birthday_day'];
        $birthday = date('Y-m-d', strtotime($birthday));

        $form = new Entry();
        $form->name      = $data['name'];
        $form->kana_name = $data['kana_name'];
        $form->sex_id = $data['sex_id'];
        $form->birthday = $birthday;
        $form->email     = $data['email'];
        $form->phone     = $data['phone'];
        $form->job_prefecture_id     = $data['job_prefecture_id'];
        $form->job_type_id     = $data['job_type_id'];
        $form->body      = $data['body'];
        $form->save();

        return view('example_form.thanks');
    }
}
