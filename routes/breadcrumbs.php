<?php // routes/breadcrumbs.php

use App\Models\Callback;
use App\Models\Chapter;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Review;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\User;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Главная
Breadcrumbs::for('crm.home', function (BreadcrumbTrail $trail) {
    $trail->push('Expert Paws', route('crm.home'));
});

// Пользователи
/**
 * @var User $user
 */
Breadcrumbs::for('crm.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Пользователи', route('crm.users.index'));
});
Breadcrumbs::for('crm.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('crm.users.index');
    $trail->push($user->getFullName(), route('crm.users.show', $user));
});
Breadcrumbs::for('crm.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.users.index');
    $trail->push('Создание', route('crm.users.create'));
});
Breadcrumbs::for('crm.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('crm.users.show', $user);
    $trail->push('Редактирование', route('crm.users.edit', $user));
});

// Роли
/**
 * @var Role $role
 */
Breadcrumbs::for('crm.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Роли', route('crm.roles.index'));
});
Breadcrumbs::for('crm.roles.show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('crm.roles.index');
    $trail->push($role->getDisplayName(), route('crm.roles.show', $role));
});
Breadcrumbs::for('crm.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.roles.index');
    $trail->push('Создание', route('crm.roles.create'));
});
Breadcrumbs::for('crm.roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('crm.roles.show', $role);
    $trail->push('Редактирование', route('crm.roles.edit', $role));
});

// Уроки
/**
 * @var Lesson $lesson
 */
Breadcrumbs::for('crm.lessons.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Уроки', route('crm.lessons.index'));
});
Breadcrumbs::for('crm.lessons.show', function (BreadcrumbTrail $trail, $lesson) {
    $trail->parent('crm.lessons.index');
    $trail->push($lesson->getTitle(), route('crm.lessons.show', $lesson));
});
Breadcrumbs::for('crm.lessons.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.lessons.index');
    $trail->push('Создание', route('crm.lessons.create'));
});
Breadcrumbs::for('crm.lessons.edit', function (BreadcrumbTrail $trail, $lesson) {
    $trail->parent('crm.lessons.show', $lesson);
    $trail->push('Редактирование', route('crm.lessons.edit', $lesson));
});

// Изображения
/**
 * @var Image $image
 */
Breadcrumbs::for('crm.images.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Изображения', route('crm.images.index'));
});
Breadcrumbs::for('crm.images.show', function (BreadcrumbTrail $trail, $image) {
    $trail->parent('crm.images.index');
    $trail->push($image->getTypeName(), route('crm.images.show', $image));
});
Breadcrumbs::for('crm.images.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.images.index');
    $trail->push('Создание', route('crm.images.create'));
});
Breadcrumbs::for('crm.images.edit', function (BreadcrumbTrail $trail, $image) {
    $trail->parent('crm.images.show', $image);
    $trail->push('Редактирование', route('crm.images.edit', $image));
});

// Отзывы
/**
 * @var Review $review
 */
Breadcrumbs::for('crm.reviews.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Отзывы', route('crm.reviews.index'));
});
Breadcrumbs::for('crm.reviews.show', function (BreadcrumbTrail $trail, $review) {
    $trail->parent('crm.reviews.index');
    $trail->push('Отзыв №' . $review->getKey(), route('crm.reviews.show', $review));
});
Breadcrumbs::for('crm.reviews.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.reviews.index');
    $trail->push('Создание', route('crm.reviews.create'));
});
Breadcrumbs::for('crm.reviews.edit', function (BreadcrumbTrail $trail, $review) {
    $trail->parent('crm.reviews.show', $review);
    $trail->push('Редактирование', route('crm.reviews.edit', $review));
});

// Курсы
/**
 * @var Course $course
 */
Breadcrumbs::for('crm.courses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Курсы', route('crm.courses.index'));
});
Breadcrumbs::for('crm.courses.show', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('crm.courses.index');
    $trail->push($course->getTitle(), route('crm.courses.show', $course));
});
Breadcrumbs::for('crm.courses.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.courses.index');
    $trail->push('Создание', route('crm.courses.create'));
});
Breadcrumbs::for('crm.courses.edit', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('crm.courses.show', $course);
    $trail->push('Редактирование', route('crm.courses.edit', $course));
});

// Контакты
/**
 * @var Contact $contact
 */
Breadcrumbs::for('crm.contacts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Контакты', route('crm.contacts.index'));
});
Breadcrumbs::for('crm.contacts.show', function (BreadcrumbTrail $trail, $contact) {
    $trail->parent('crm.contacts.index');
    $trail->push($contact->getTitle(), route('crm.contacts.show', $contact));
});
Breadcrumbs::for('crm.contacts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.contacts.index');
    $trail->push('Создание', route('crm.contacts.create'));
});
Breadcrumbs::for('crm.contacts.edit', function (BreadcrumbTrail $trail, $contact) {
    $trail->parent('crm.contacts.show', $contact);
    $trail->push('Редактирование', route('crm.contacts.edit', $contact));
});

// Обращения
/**
 * @var Callback $callback
 */
Breadcrumbs::for('crm.callbacks.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Обращения', route('crm.callbacks.index'));
});
Breadcrumbs::for('crm.callbacks.show', function (BreadcrumbTrail $trail, $callback) {
    $trail->parent('crm.callbacks.index');
    $trail->push('№' . $callback->getKey(), route('crm.callbacks.show', $callback));
});

// Главы
/**
 * @var Chapter $chapter
 */
Breadcrumbs::for('crm.chapters.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Главы', route('crm.chapters.index'));
});
Breadcrumbs::for('crm.chapters.show', function (BreadcrumbTrail $trail, $chapter) {
    $trail->parent('crm.chapters.index');
    $trail->push($chapter->getTitle(), route('crm.chapters.show', $chapter));
});
Breadcrumbs::for('crm.chapters.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.chapters.index');
    $trail->push('Создание', route('crm.chapters.create'));
});
Breadcrumbs::for('crm.chapters.edit', function (BreadcrumbTrail $trail, $chapter) {
    $trail->parent('crm.chapters.show', $chapter);
    $trail->push('Редактирование', route('crm.chapters.edit', $chapter));
});
