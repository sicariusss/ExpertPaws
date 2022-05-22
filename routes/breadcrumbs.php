<?php // routes/breadcrumbs.php

use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Product;
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

// Продукты
/**
 * @var Product $product
 */
Breadcrumbs::for('crm.products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Товары', route('crm.products.index'));
});
Breadcrumbs::for('crm.products.show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('crm.products.index');
    $trail->push($product->getName(), route('crm.products.show', $product));
});
Breadcrumbs::for('crm.products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.products.index');
    $trail->push('Создание', route('crm.products.create'));
});
Breadcrumbs::for('crm.products.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('crm.products.show', $product);
    $trail->push('Редактирование', route('crm.products.edit', $product));
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

// Галерея
/**
 * @var Gallery $gallery
 */
Breadcrumbs::for('crm.gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Галерея', route('crm.gallery.index'));
});
Breadcrumbs::for('crm.gallery.show', function (BreadcrumbTrail $trail, $gallery) {
    $trail->parent('crm.gallery.index');
    $trail->push('Изображение №' . $gallery->getKey(), route('crm.gallery.show', $gallery));
});
Breadcrumbs::for('crm.gallery.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.gallery.index');
    $trail->push('Создание', route('crm.gallery.create'));
});
Breadcrumbs::for('crm.gallery.edit', function (BreadcrumbTrail $trail, $gallery) {
    $trail->parent('crm.gallery.show', $gallery);
    $trail->push('Редактирование', route('crm.gallery.edit', $gallery));
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

// Категории
/**
 * @var Category $category
 */
Breadcrumbs::for('crm.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.home');
    $trail->push('Категории', route('crm.categories.index'));
});
Breadcrumbs::for('crm.categories.show', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('crm.categories.index');
    $trail->push($category->getName(), route('crm.categories.show', $category));
});
Breadcrumbs::for('crm.categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.categories.index');
    $trail->push('Создание', route('crm.categories.create'));
});
Breadcrumbs::for('crm.categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('crm.categories.show', $category);
    $trail->push('Редактирование', route('crm.categories.edit', $category));
});
