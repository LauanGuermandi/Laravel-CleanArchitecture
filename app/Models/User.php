<?php

namespace App\Models;

use App\Domain\Interfaces\IUserEntity;
use App\Domain\ValueObjects\EmailValueObject;
use App\Domain\ValueObjects\HashedPasswordValueObject;
use App\Domain\ValueObjects\PasswordValueObject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class Student
 * @package App
 * @mixin Builder
 */
class User extends Authenticatable implements IUserEntity
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * @return EmailValueObject
     */
    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->attributes['email']);
    }

    /**
     * @param EmailValueObject $email
     * @return void
     */
    public function setEmail(EmailValueObject $email): void
    {
        $this->attributes['email'] = (string) $email;
    }

    /**
     * @return HashedPasswordValueObject
     */
    public function getPassword(): HashedPasswordValueObject
    {
        return new HashedPasswordValueObject($this->attributes['password']);
    }

    /**
     * @param PasswordValueObject $password
     * @return void
     */
    public function setPassword(PasswordValueObject $password): void
    {
        $this->attributes['password'] = (string) $password->hashed();
    }
}
