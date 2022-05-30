<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * App\Models\Review
 *
 * @property int $id
 * @property string|null $title Заголовок
 * @property string|null $description Описание
 * @property string|null $image Изображение
 * @property int $user_id ID пользователя
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder|Review filter(array $frd)
 * @method static Builder|Review newModelQuery()
 * @method static Builder|Review newQuery()
 * @method static \Illuminate\Database\Query\Builder|Review onlyTrashed()
 * @method static Builder|Review query()
 * @method static Builder|Review whereCreatedAt($value)
 * @method static Builder|Review whereDeletedAt($value)
 * @method static Builder|Review whereDescription($value)
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereImage($value)
 * @method static Builder|Review whereTitle($value)
 * @method static Builder|Review whereUpdatedAt($value)
 * @method static Builder|Review whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Review withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Review withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
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
     * @return User
     */
    public function getUser(): User
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
                            $query->where('title', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function uploadImage(UploadedFile $uploadedFile): string
    {
        /** @var Storage $storage */
        $storage = Storage::disk('reviews');
        $randStr = substr(md5(rand()), 0, 25);
        $path    = 'review-' . $randStr . '.png';

        $storage->put($path, $uploadedFile->get());
        return '/images/reviews/' . $path . '?' . Carbon::now();
    }

    /**
     * @return bool
     */
    public function isGallery(): bool
    {
        return $this->getImage() !== null;
    }


}
