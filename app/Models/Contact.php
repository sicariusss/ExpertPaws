<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $type Тип контакта
 * @property string $content Контакт
 * @property string $title Название
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|Contact filter(array $frd)
 */
class Contact extends Model
{

    protected $table = 'contacts';

    protected $fillable = [
        'type',
        'content',
        'title',
    ];

    public const TYPE_PHONE      = 'Телефон';
    public const TYPE_EMAIL      = 'Email';
    public const TYPE_SOCIAL_NET = 'Социальная сеть';
    public const TYPE_ADDRESS    = 'Адрес';


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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

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
                            $query->where('title', 'like', '%' . $value . '%')
                                ->orWhere('type', 'like', '%' . $value . '%')
                                ->orWhere('content', 'like', '%' . $value . '%');
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
    public static function getTypesList(): array
    {
        return [
            self::TYPE_PHONE      => self::TYPE_PHONE,
            self::TYPE_EMAIL      => self::TYPE_EMAIL,
            self::TYPE_SOCIAL_NET => self::TYPE_SOCIAL_NET,
            self::TYPE_ADDRESS    => self::TYPE_ADDRESS,
        ];
    }

    /**
     * @return string
     */
    public function getTypeIcon(): string
    {
        if ($this->getType() === self::TYPE_PHONE) {
            $icon = '<i class="fa-solid fa-phone"></i>';
        } elseif ($this->getType() === self::TYPE_EMAIL) {
            $icon = '<i class="fa-solid fa-envelope"></i>';
        } elseif ($this->getType() === self::TYPE_SOCIAL_NET) {
            $icon = '<i class="fa-solid fa-share-nodes"></i>';
        } elseif ($this->getType() === self::TYPE_ADDRESS) {
            $icon = '<i class="fa-solid fa-location-dot"></i>';
        } else {
            $icon = '';
        }
        return $icon;
    }


}
