<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prefs = config('prefectures');
        $jobTypes = config('jobTypes');

        $entries = Entry::search($request)->paginate(5);

        return view('admin.index', compact('entries', 'prefs', 'jobTypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entry = Entry::find($id);
        
		return view("admin.detail", compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entry = Entry::find($id);
        
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validated();
        $entry = Entry::find($id);
        $entry->update($request->except(['_token']));

        return redirect()->route('admin.entries.index')->with('success', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entry = Entry::find($id);
        $entry->delete();
        return redirect()->route('admin.entries.index')->with('success', '削除しました');
    }
}
