<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Progress
 *
 * @property int $id
 * @property int $progress Прогресс, в процентах
 * @property int $course_id Курс
 * @property int $lesson_id Урок
 * @property int $user_id Пользователь
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newQuery()
 * @method static \Illuminate\Database\Query\Builder|Progress onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress query()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Progress withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Progress withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Lesson $lesson
 * @property-read \App\Models\User $user
 */
class Progress extends Model
{
    use SoftDeletes;

    protected $table = 'progresses';

    protected $fillable = [
        'progress',
        'course_id',
        'lesson_id',
        'user_id',
    ];

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     */
    public function setProgress(int $progress): void
    {
        $this->progress = $progress;
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
     * @return int
     */
    public function getLessonId(): int
    {
        return $this->lesson_id;
    }

    /**
     * @param int $lesson_id
     */
    public function setLessonId(int $lesson_id): void
    {
        $this->lesson_id = $lesson_id;
    }

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @return Lesson
     */
    public function getLesson(): Lesson
    {
        return $this->lesson;
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
     * @param int $userId
     * @param int $courseId
     * @return array
     */
    public static function getLastProgress(int $userId, int $courseId): array
    {
        /** @var $lastProgress self */
        $lastProgress      = Progress::where('user_id', $userId)->where('course_id', $courseId)->orderBy('created_at', 'desc')->first();
        $lastProgressTitle = $lastProgress->getLesson()->getChapter()->getTitle() . ', ' . $lastProgress->getLesson()->getTitle();
        return ['last_model' => $lastProgress, 'last_str' => $lastProgressTitle];
    }


}
