<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

		return view("admin.show", compact('entry'));
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

        return view("admin.edit", compact('entry', 'years', 'months', 'days', 'prefs', 'jobTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntryRequest $request, string $id)
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
