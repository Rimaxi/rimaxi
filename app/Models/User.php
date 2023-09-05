<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';


    protected $fillable = [
       'name','email','phone','dob','password','confirmpassword','country_id','state_id','city_id', 'hobbies',
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
    protected $appends = ['age'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userPost()
    {
        return $this->hasMany(Post::class, 'user_id', 'id'); //one to many relationship with post model and
    }

    public function getAgeAttribute()
    {
        $data = User::find(1);
        if ($data) {
            $age = Carbon::parse($data->dob)->age;
            return "User's age: " . $age;
        } else {
            return "User not found.";
        }
    }

    public function user_address(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id','id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id','id');
    }


}
