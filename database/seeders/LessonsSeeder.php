<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this::lessons() as $lesson) {
            $model = new Lesson();
            $model->setTitle($lesson['title']);
            $model->setDescription($lesson['description']);
            $model->setContent($lesson['content']);
            $model->setChapterId($lesson['chapter_id']);
            $model->save();
        }
    }

    public function lessons(): array
    {
        return [
            [
                'title'       => 'Происхождение кошки и роль в истории',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 1,
            ],
            [
                'title'       => 'Кошачье поведение',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 1,
            ],
            [
                'title'       => 'Поведение в период полового созревания',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 2,
            ],
            [
                'title'       => 'Беременность кошки и рождение котят',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 2,
            ],
            [
                'title'       => 'Развитие котят и факторы, влияющие на их поведение',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 3,
            ],
            [
                'title'       => 'Разница между дикой и одомашненной кошкой',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 3,
            ],
            [
                'title'       => 'Нормальное и ненормальное поведение',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 4,
            ],
            [
                'title'       => 'Старость кошки и изменения в поведении',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 4,
            ],
            [
                'title'       => 'Социализация кошки',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 5,
            ],
            [
                'title'       => 'Как познакомить кота с членами семьи и другими питомцами',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 5,
            ],
            [
                'title'       => 'Органы чувств',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 6,
            ],
            [
                'title'       => 'Как кот коммуницирует с окружением',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 6,
            ],
            [
                'title'       => 'Кот ходит мимо лотка - в чем причина',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 7,
            ],
            [
                'title'       => 'Чистота лотка',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 7,
            ],
            [
                'title'       => 'Виды агрессии',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 8,
            ],
            [
                'title'       => 'Что вызывает страх',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 8,
            ],
            [
                'title'       => 'Причины стресса и влияние его на поведение',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 9,
            ],
            [
                'title'       => 'Как минимизировать стресс',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 9,
            ],
            [
                'title'       => 'Как кошки учатся и запоминают',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 10,
            ],
            [
                'title'       => 'Обучение и дрессировка с помощью кликера',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 10,
            ],
            [
                'title'       => 'Принципы работы фелинологических систем и организаций',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 11,
            ],
            [
                'title'       => 'Выбор клуба',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 11,
            ],
            [
                'title'       => 'Выставки, принципы их проведения и правила участия',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 11,
            ],
            [
                'title'       => 'Генетика окрасов кошек',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 12,
            ],
            [
                'title'       => 'Генетические патологии',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 12,
            ],
            [
                'title'       => 'Методы селекционной работы',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 12,
            ],
            [
                'title'       => 'Основные физиологические показатели',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 13,
            ],
            [
                'title'       => 'Основные инфекции (вирусные, бактериальные, грибковые)',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 13,
            ],
            [
                'title'       => 'Вакцинация и чипирование',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 13,
            ],
            [
                'title'       => 'Проблемы репродукции (пиометра и эндометрит)',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 13,
            ],
            [
                'title'       => 'Принципы лечения в питомниках',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 13,
            ],
            [
                'title'       => 'Покупка кошки',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 14,
            ],
            [
                'title'       => 'Организация питомника',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 14,
            ],
            [
                'title'       => 'Подбор пары',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 15,
            ],
            [
                'title'       => 'Ведение беременности',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 15,
            ],
            [
                'title'       => 'Роды дома',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 15,
            ],
            [
                'title'       => 'Обустройство быта кошки и помета',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 16,
            ],
            [
                'title'       => 'Начало прикорма и возможные проблемы',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 16,
            ],
            [
                'title'       => 'Актировка котят',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 17,
            ],
            [
                'title'       => 'Оформление клубных документов',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 17,
            ],
            [
                'title'       => 'Создание красивых фотографий',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 18,
            ],
            [
                'title'       => 'Поиск торговых площадок',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 18,
            ],
            [
                'title'       => 'Переговоры с покупателями',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 18,
            ],
            [
                'title'       => 'Оформление сделки',
                'description' => '',
                'content'     => '',
                'chapter_id'  => 18,
            ],
        ];
    }
}
