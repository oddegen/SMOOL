<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable implements HasAvatar
{
    use HasFactory, Notifiable, ReceivesWelcomeNotification;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'address',
        'gender',
        'avatar_url',
        'original_email',
        'is_profile_complete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class)->withPivot('year');
    }

    public function currentSection()
    {
        return $this->sectionUsers()->where('year', date('Y'))->first();
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class)->withPivot('year');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function sectionUsers()
    {
        return $this->hasMany(SectionUser::class, 'student_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function studentGrades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }

    public function teacherGradeComponents()
    {
        return $this->hasMany(GradeComponent::class, 'teacher_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() == 'admin') {
            return $this->role->name === 'Admin';
        }

        if ($panel->getId() == 'teacher') {
            return $this->role->name === 'Teacher';
        }

        if ($panel->getId() == 'student') {
            return $this->role->name === 'Student';
        }

        return false;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function generatedResources()
    {
        return $this->hasMany(GeneratedResource::class);
    }
}
