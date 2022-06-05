<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property string $title Название
 * @property int $course_id Курс, которому принадлежит глава
 * @property string $icon Иконка
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @method static Builder|Chapter filter(array $frd)
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Chapter onlyTrashed()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereCourseId($value)
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereDeletedAt($value)
 * @method static Builder|Chapter whereIcon($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereTitle($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Chapter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Chapter withoutTrashed()
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use SoftDeletes;

    protected $table = 'chapters';

    protected $fillable = [
        'title',
        'course_id',
        'icon',
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
     * @return int
     */
    public function getCourseId(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setCourseId(int $course_id): void
    {
        $this->course_id = $course_id;
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
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
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return Collection
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
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
     * @return array
     */
    public static function getChaptersList(): array
    {
        $chaptersList = [];
        foreach (self::get() as $chapter) {
            $chaptersList[$chapter->getKey()] = $chapter->getTitle() . ' - ' . $chapter->getCourse()->getTitle();
        }
        return $chaptersList;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $title
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function uploadIcon(UploadedFile $uploadedFile, string $title): string
    {
        /** @var Storage $storage */
        $storage = Storage::disk('chapters');
        $randStr = substr(md5(rand()), 0, 10);
        $path    = 'chapter-' . Str::slug($title) . '-' . $randStr . '.png';

        $storage->put($path, $uploadedFile->get());
        return '/images/chapters/' . $path . '?' . Carbon::now();
    }
}
