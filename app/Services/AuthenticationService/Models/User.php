<?php

namespace App\Services\AuthenticationService\Models;

use App\Services\AuthenticationService\Database\Factories\UserFactory;
use App\Services\AuthenticationService\Models\Traits\Relations\UserRelationsTrait;
use App\Services\AuthenticationService\Models\Traits\Scopes\UserScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        SoftDeletes,
        UserRelationsTrait,
        UserScopeTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'verification_code',
    ];

    protected $hidden = [
        'deleted_at',
        'verification_code',
        'remember_token',
    ];

    protected static function factory(): UserFactory
    {
        return UserFactory::new();
    }
}
