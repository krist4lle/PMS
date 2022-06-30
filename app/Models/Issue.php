<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'finished_at',
        'deadline',
        'estimate',
    ];

    public function status()
    {
        return $this->belongsTo(IssueStatus::class, 'issue_status_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'issue_id', 'id');
    }

    public function scopeMyIssues($query, int $projectId)
    {
        $query->whereRelation('project', 'id', $projectId);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($issue) {
            $issue->comments()->each(function ($comment) {
                $comment->delete();
            });
        });
    }
}
