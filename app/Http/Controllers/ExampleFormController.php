<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExampleFormRequest;
use App\Mail\ExampleFormAdminMail;
use App\Mail\ExampleFormUserMail;
use Illuminate\Support\Facades\Mail;

class ExampleFormController extends Controller
{
    public function index()
    {
        $data = collect(request()->session()->get('data'));
        request()->session()->forget('data');

        return view('example_form.index', compact('data'));
    }

    public function confirm(ExampleFormRequest $request)
    {
        $data = $request->validated();
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

        return view('example_form.thanks');
    }
}
