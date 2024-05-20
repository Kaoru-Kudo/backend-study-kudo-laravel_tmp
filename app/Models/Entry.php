<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kana_name',
        'sex_id',
        'birthday',
        'email',
        'phone',
        'job_prefecture_id',
        'job_type_id',
        'body',
        '_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['birthday' => 'date'];

    public function scopeSearch (Builder $query, Request $request)
    {
        $keyword = $request->input('keyword');
        $jobPrefectureId = $request->input('job_prefecture_id');
        $jobTypeId = $request->input('job_type_id');

        return $query
                ->when(!empty($keyword), function ($q) use ($keyword) {
                    $keywords = collect(preg_split('/[\s]+/', mb_convert_kana($keyword, 's')));

                    $keywords->each(function ($word) use ($q) {
                        $q->where(function($q) use ($word) {
                            $q->where('name', 'LIKE', "%{$word}%")
                                ->orWhere('kana_name', 'LIKE', "%{$word}%");
                        });
                    });
                })
                ->when(!empty($jobPrefectureId), fn ($q) => $q->where('job_prefecture_id', 'LIKE', $jobPrefectureId))
                ->when(!empty($jobTypeId), fn ($q) => $q->where('job_type_id', 'LIKE', $jobTypeId));
    }
}
