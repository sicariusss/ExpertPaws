<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;





/**
 * App\Models\Course
 *
 * @property int $id
 * @property string $title Название курса
 * @property string $short_description Короткое описание
 * @property string $full_description Полное описание
 * @property int $price Цена
 * @property string $preview Превью
 * @property string $school Направление
 * @property string $hours Объем программы в часах
 * @property string $slug Ссылка
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @method static Builder|Course filter(array $frd)
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|Course onlyTrashed()
 * @method static Builder|Course query()
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereDeletedAt($value)
 * @method static Builder|Course whereFullDescription($value)
 * @method static Builder|Course whereHours($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course wherePreview($value)
 * @method static Builder|Course wherePrice($value)
 * @method static Builder|Course whereSchool($value)
 * @method static Builder|Course whereShortDescription($value)
 * @method static Builder|Course whereSlug($value)
 * @method static Builder|Course whereTitle($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Course withoutTrashed()
 * @mixin \Eloquent
 */
class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'price',
        'preview',
        'school',
        'hours',
        'slug',
    ];

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @param string $short_description
     */
    public function setShortDescription(string $short_description): void
    {
        $this->short_description = $short_description;
    }

    /**
     * @return string
     */
    public function getFullDescription(): string
    {
        return $this->full_description;
    }

    /**
     * @param string $full_description
     */
    public function setFullDescription(string $full_description): void
    {
        $this->full_description = $full_description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     */
    public function setPreview(string $preview): void
    {
        $this->preview = $preview;
    }

    /**
     * @return string
     */
    public function getSchool(): string
    {
        return $this->school;
    }

    /**
     * @param string $school
     */
    public function setSchool(string $school): void
    {
        $this->school = $school;
    }

    /**
     * @return string
     */
    public function getHours(): string
    {
        return $this->hours;
    }

    /**
     * @param string $hours
     */
    public function setHours(string $hours): void
    {
        $this->hours = $hours;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
     * @return HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * @return Collection
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
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
     * @param string $title
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function uploadPreview(UploadedFile $uploadedFile, string $title): string
    {
        /** @var Storage $storage */
        $storage = Storage::disk('courses');
        $randStr = substr(md5(rand()), 0, 10);
        $path    = 'course-' . Str::slug($title) . '-' . $randStr . '.png';

        $storage->put($path, $uploadedFile->get());
        return '/images/courses/' . $path . '?' . Carbon::now();
    }

    /**
     * @return array
     */
    public static function getCoursesList(): array
    {
        $coursesList = [];
        foreach (self::get() as $course) {
            $coursesList[$course->getKey()] = $course->getTitle();
        }
        return $coursesList;
    }


}
