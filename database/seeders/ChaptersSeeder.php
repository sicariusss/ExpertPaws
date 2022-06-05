<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChaptersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this::chapters() as $chapter) {
            $model = new Chapter();
            $model->setTitle($chapter['title']);
            $model->setCourseId($chapter['course_id']);
            $model->setIcon($chapter['icon']);
            $model->save();
        }
    }

    public function chapters(): array
    {
        return [
            [
                'title'     => 'Исторический экскурс',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-1.png',
            ],
            [
                'title'     => 'Половая активность и размножение',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-2.png',
            ],
            [
                'title'     => 'Поведение котят',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-3.png',
            ],
            [
                'title'     => 'Что нормально, а что нет',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-4.png',
            ],
            [
                'title'     => 'Кошка в социуме',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-5.png',
            ],
            [
                'title'     => 'Органы чувств и средства коммуникации',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-6.png',
            ],
            [
                'title'     => 'Проблемы с туалетом',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-7.png',
            ],
            [
                'title'     => 'Кошачья агрессия и страх',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-8.png',
            ],
            [
                'title'     => 'Беспокойство и стресс',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-9.png',
            ],
            [
                'title'     => 'Обучение и дрессировка',
                'course_id' => 1,
                'icon'      => '/images/chapters/chapter-1-10.png',
            ],
            [
                'title'     => 'Основы фелинологии',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-1.png',
            ],
            [
                'title'     => 'Основы генетики кошек',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-2.png',
            ],
            [
                'title'     => 'Основы ветеринарии для Заводчика',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-3.png',
            ],
            [
                'title'     => 'С чего начинается питомник',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-4.png',
            ],
            [
                'title'     => 'Вязка, беременность, роды в домашних условиях',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-5.png',
            ],
            [
                'title'     => 'Выращивание помета',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-6.png',
            ],
            [
                'title'     => 'Регистрация помета',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-7.png',
            ],
            [
                'title'     => 'Продажа котят',
                'course_id' => 2,
                'icon'      => '/images/chapters/chapter-2-8.png',
            ],
        ];
    }
}
