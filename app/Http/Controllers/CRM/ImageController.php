<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ImageController extends Controller
{
    /**
     * @var Image
     */
    protected Image $images;

    /**
     * @param Image $images
     */
    public function __construct(Image $images)
    {
        $this->images = $images;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Изображения');
        $data   = $request->all();
        $images = $this->images::filter($data)->paginate(15);

        return view('crm.images.index', compact('images', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить изображение');
        $typesList    = $this->images::getTypesList();
        $productsList = Product::getProductsList();
        $coursesList  = Course::getCoursesList();
        $lessonsList  = Lesson::getLessonsList();

        return view('crm.images.create', compact('typesList', 'productsList', 'lessonsList', 'coursesList'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'type'    => 'required|max:255',
            'type_id' => 'max:255',
            'image'   => 'required',
        ], [
            'type.max'       => 'Тип должен быть меньше 255 символов',
            'type.required'  => 'Введите тип',
            'type_id.max'    => 'ID типа должно быть меньше 255 символов',
            'image.required' => 'Загрузите изображение',
        ]);

        $type = $data['type'];

        if ($type === $this->images::TYPE_PRODUCT_PIC) {
            if ($data['type_product'] === null) {
                throw ValidationException::withMessages(['type_product' => "Выберите продукт"]);
            } else $typeId = $data['type_product'];
        } elseif ($type === $this->images::TYPE_COURSE_PIC) {
            if ($data['type_course'] === null) {
                throw ValidationException::withMessages(['type_course' => "Выберите курс"]);
            } else $typeId = $data['type_course'];
        } elseif ($type === $this->images::TYPE_LESSON_PIC) {
            if ($data['type_lesson'] === null) {
                throw ValidationException::withMessages(['type_lesson' => "Выберите урок"]);
            } else $typeId = $data['type_lesson'];
        } else $typeId = '0';

        $image = new Image();
        $image->setType($type);
        $image->setTypeId($typeId);
        $image->setPath($this->images::uploadImage($data['image'], $data['type']));
        $image->save();

        Log::info('Добавлено изображение №' . $image->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.images.show', $image);
    }

    /**
     * @param Image $image
     * @return View
     */
    public function show(Image $image): View
    {
        SEOMeta::setTitle('Изображение №' . $image->getKey());

        return view('crm.images.show', compact('image'));
    }

    /**
     * @param Image $image
     * @return View
     */
    public function edit(Image $image): View
    {
        SEOMeta::setTitle('Редактирование изображения №' . $image->getKey());
        $typesList    = $this->images::getTypesList();
        $productsList = Product::getProductsList();
        $coursesList  = Course::getCoursesList();
        $lessonsList  = Lesson::getLessonsList();

        return view('crm.images.edit', compact('image', 'typesList', 'productsList', 'lessonsList', 'coursesList'));
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Image $image): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'type'    => 'required|max:255',
            'type_id' => 'max:255',
        ], [
            'type.max'      => 'Тип должен быть меньше 255 символов',
            'type.required' => 'Введите тип',
            'type_id.max'   => 'ID типа должно быть меньше 255 символов',
        ]);

        if ($data['type'] === $this->images::TYPE_PRODUCT_PIC) {
            if ($data['type_product'] === null) {
                throw ValidationException::withMessages(['type_product' => "Выберите продукт"]);
            } else $data['type_id'] = $data['type_product'];
        } elseif ($data['type'] === $this->images::TYPE_COURSE_PIC) {
            if ($data['type_course'] === null) {
                throw ValidationException::withMessages(['type_course' => "Выберите курс"]);
            } else $data['type_id'] = $data['type_course'];
        } elseif ($data['type'] === $this->images::TYPE_LESSON_PIC) {
            if ($data['type_lesson'] === null) {
                throw ValidationException::withMessages(['type_lesson' => "Выберите урок"]);
            } else $data['type_id'] = $data['type_lesson'];
        } else $data['type_id'] = '0';

        if (isset($data['image'])) {
            $data['path'] = $this->images::uploadImage($data['image'], $data['type']);
        }

        $image->update($data);

        Log::info('Изменено изображение №' . $image->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.images.show', $image);
    }

    /**
     * @param Image $image
     * @return RedirectResponse
     */
    public function destroy(Image $image): RedirectResponse
    {
        Log::info('Удалено изображение №' . $image->getKey() . ', менеджер: ' . Auth::id());

        $image->delete();

        return redirect()->route('crm.images.index');
    }
}
