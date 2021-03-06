<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function managerProjects()
    {
        return $this->hasMany(Project::class, 'manager_id', 'id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_project', 'user_id', 'project_id');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'assignee_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            $user->issues()->each(function ($issue) {
                $issue->delete();
            });
            $user->comments()->each(function ($comment) {
                $comment->delete();
            });
            $user->managerProjects()->each(function ($managerProject) {
                $manager = User::where('key', 'headManagement')->first();
                $managerProject->manager()->associate($manager);
                $managerProject->save();
            });
        });
    }
}
