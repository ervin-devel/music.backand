<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\DataTables;
use App\Traits\DateFormat;
use App\Traits\HasFollowed;
use App\Traits\HasLikeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasLikeable, HasFollowed, DataTables, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Имя', 'email' => 'Email', 'email_verified_at' => 'Статус регистрации',
            'created_at' => 'Дата регистрации', 'role' => 'Роль', 'actions' => 'Действия'
        ];
    }

    public function getRowsDatatable(array $filterParams)
    {
        $this->setQueryBuild($filterParams, ['name', 'email']);

        $users = $this->getQueryBuild()
            ->with('role')
            ->get();

        $rows = [];
        foreach ($users as $user) {
            $rows[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => (empty($user->email_verified_at) ? $this->getUserActivateBtn($user) : 'Уже активирован'),
                'role' => $user->role->name,
                'created_at' => $user->dateTimeRU(),
                'actions' => $user->getActionButtons([
                    'edit' => route('admin.user.edit', $user->id),
                    'delete' => route('admin.user.delete', $user->id)
                ])
            ];
        }

        return [
            'draw' => $filterParams['draw'],
            'iTotalRecords' => $this->getTotalRows(),
            'iTotalDisplayRecords' => $this->getTotalRowsWithFilter(),
            'aaData' => $rows
        ];
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
