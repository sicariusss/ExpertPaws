<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $surname Фамилия
 * @property string $name Имя
 * @property string|null $patronymic Отчество
 * @property string $email
 * @property string|null $phone Телефон
 * @property string|null $address Адрес
 * @property int|null $photo_id Аватарка
 * @property int $role_id Роль
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User filter(array $frd)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePatronymic($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User wherePhotoId($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereSurname($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Role $role
 * @property-read \App\Models\Image|null $photo
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'phone',
        'address',
        'photo_id',
        'role_id',
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
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     */
    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return int|null
     */
    public function getPhotoId(): ?int
    {
        return $this->photo_id;
    }

    /**
     * @param int|null $photo_id
     */
    public function setPhotoId(?int $photo_id): void
    {
        $this->photo_id = $photo_id;
    }

    /**
     * @return HasOne
     */
    public function photo(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->photo;
    }

    /**
     * @return Carbon|null
     */
    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->email_verified_at;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    public function scopeFilter(Builder $query, array $frd): Builder
    {
        foreach ($frd as $key => $value) {
            if (null === $value) {
                continue;
            }
            switch ($key) {
                case 'search':
                    {
                        $query->where(function ($query) use ($value) {
                            $query->where('surname', 'like', '%' . $value . '%')
                                ->orWhere('name', 'like', '%' . $value . '%')
                                ->orWhere('patronymic', 'like', '%' . $value . '%')
                                ->orWhere('email', 'like', '%' . $value . '%')
                                ->orWhere('phone', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }


}
