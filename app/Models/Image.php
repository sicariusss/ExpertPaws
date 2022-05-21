<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $type Сущность
 * @property string $type_id ID сущности
 * @property string $path Путь изображения
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Image onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Image withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Image withoutTrashed()
 * @method static Builder|Image filter(array $frd)
 */
class Image extends Model
{
    use SoftDeletes;

    protected $table = 'images';

    protected $fillable = [
        'type',
        'type_id',
        'path',
    ];

    public const TYPE_BG_SITE     = 'bg_site';
    public const TYPE_BG_CRM      = 'bg_crm';
    public const TYPE_PRODUCT_PIC = 'product_pic';
    public const TYPE_COURSE_PIC  = 'course_pic';
    public const TYPE_LESSON_PIC  = 'lesson_pic';

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTypeId(): string
    {
        return $this->type_id;
    }

    /**
     * @param string $type_id
     */
    public function setTypeId(string $type_id): void
    {
        $this->type_id = $type_id;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
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
                            $query->where('type', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $type
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function uploadImage(UploadedFile $uploadedFile, string $type): string
    {
        /** @var Storage $storage */
        $storage = Storage::disk('resources');
        $randStr = substr(md5(rand()), 0, 10);
        $path    = 'image-' . Str::slug($type) . '-' . $randStr . '.png';

        $storage->put($path, $uploadedFile->get());
        return '/images/resources/' . $path . '?' . Carbon::now();
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        if ($this->getType() === self::TYPE_BG_SITE) {
            $name = 'Изображение сайта';
        } elseif ($this->getType() === self::TYPE_BG_CRM) {
            $name = 'Изображение CRM';
        } elseif ($this->getType() === self::TYPE_PRODUCT_PIC) {
            $product = Product::firstWhere('id', $this->getTypeId());
            $name    = 'Изображение продукта "' . $product->getName() . '"';
        } elseif ($this->getType() === self::TYPE_COURSE_PIC) {
            $course = Course::firstWhere('id', $this->getTypeId());
            $name   = 'Изображение курса "' . $course->getTitle() . '"';
        } elseif ($this->getType() === self::TYPE_LESSON_PIC) {
            $lesson = Lesson::firstWhere('id', $this->getTypeId());
            $name   = 'Изображение урока "' . $lesson->getTitle() . '"';
        } else $name = '';

        return $name;
    }

    /**
     * @return array
     */
    public static function getTypesList(): array
    {
        return [
            self::TYPE_BG_SITE     => 'Изображение сайта',
            self::TYPE_BG_CRM      => 'Изображение CRM',
            self::TYPE_PRODUCT_PIC => 'Изображение продукта',
            self::TYPE_COURSE_PIC  => 'Изображение курса',
            self::TYPE_LESSON_PIC  => 'Изображение урока',
        ];
    }

}
