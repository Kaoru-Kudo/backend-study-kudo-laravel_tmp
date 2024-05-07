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
        $data = $request;

        $keywords = $data->input('keywords');
        $jobPrefectureId = $data->input('job_prefecture_id');
        $jobTypeId = $data->input('job_type_id');

        $prefs = config('prefectures');
        $jobTypes = config('jobTypes');

        if (auth()->check()) {
            $query = Entry::query();

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
