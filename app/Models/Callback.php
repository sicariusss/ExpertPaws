<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Callback
 *
 * @property int $id
 * @property string $name Имя отправителя
 * @property string $email Почта отправителя
 * @property string $subject Тема сообщения
 * @property string $message Сообщение
 * @property int|null $user_id ID пользователя, null - если не авторизирован
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Callback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Callback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Callback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Callback whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $user
 * @method static Builder|Callback filter(array $frd)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Callback onlyTrashed()
 * @method static Builder|Callback whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Callback withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Callback withoutTrashed()
 */
class Callback extends Model
{
    use SoftDeletes;

    protected $table = 'callbacks';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'user_id',
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
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
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

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
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
                            $query->where('subject', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }


}
