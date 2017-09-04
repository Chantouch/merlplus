<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $id == null
     * @return array
     */
    public static function rule($id = null)
    {

        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'roles' => 'required',
                    'password_options' => 'required',
                    //'password' => 'required|same:confirm_password'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'password' => 'same:confirm-password|min:6',
                    //'confirm-password' => 'same:password|min:6',
                    'roles' => 'required'

                ];
            }
            default:
                break;
        }
        return self::rule($id);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Please input your name',
            'password.min' => 'លេខសំងាត់ត្រូវធំជាង​ ឬស្មើរ ៦ខ្ទង់។',
        ];
    }


    /**
     * Return a unique personnal access token.
     *
     * @var String
     * @return string
     */
    public static function generateApiToken(): string
    {
        do {
            $api_token = str_random(60);
        } while (self::where('api_token', $api_token)->exists());

        return $api_token;
    }

    /**
     * Get the user's fullname titleized.
     *
     * @return string
     */
    public function getFullnameAttribute(): string
    {
        return title_case($this->name);
    }

    /**
     * Encrypt the user's password.
     *
     * @param $password
     * @return void
     * @internal param string $passwword
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Scope a query to only include users registered last week.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastWeek($query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])
            ->latest();
    }

    /**
     * Scope a query to order users by latest registered.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to filter available author users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthors($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('roles.name', Role::ROLE_SUPER_ADMIN)
                ->orWhere('roles.name', Role::ROLE_EDITOR);
        });
    }

    /**
     * Check if the user can be an author
     *
     * @return boolean
     */
    public function canBeAuthor(): bool
    {
        return $this->isAdmin() || $this->isEditor();
    }

    /**
     * Check if the user has a role
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole($role): bool
    {
        return $this->roles->where('name', $role)->isNotEmpty();
    }

    /**
     * Check if the user has role admin
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ROLE_SUPER_ADMIN);
    }

    /**
     * Check if the user has role editor
     *
     * @return boolean
     */
    public function isEditor(): bool
    {
        return $this->hasRole(Role::ROLE_EDITOR);
    }


    /**
     * Return the user's comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Return the user's posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

}
