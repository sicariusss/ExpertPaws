<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * @var Course
     */
    protected Course $courses;

    /**
     * @param Course $courses
     */
    public function __construct(Course $courses)
    {
        $this->courses = $courses;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Курсы');
        $data    = $request->all();
        $courses = $this->courses::filter($data)->paginate(15);

        return view('crm.courses.index', compact('courses', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить курс');

        return view('crm.courses.create');
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
            'title'             => 'required|max:255',
            'short_description' => 'required|max:255',
            'full_description'  => 'required',
            'price'             => 'required|integer',
            'preview'           => 'required',
        ], [
            'title.max'                  => 'Название должно быть меньше 255 символов',
            'title.required'             => 'Введите название',
            'short_description.max'      => 'Краткое описание должно быть меньше 255 символов',
            'short_description.required' => 'Введите краткое описание',
            'full_description.required'  => 'Введите описание',
            'price.required'             => 'Введите цену',
            'preview.required'           => 'Загрузите превью',
        ]);

        $course = new Course();
        $course->setTitle($data['title']);
        $course->setShortDescription($data['short_description']);
        $course->setFullDescription($data['full_description']);
        $course->setPrice($data['price']);
        $course->setPreview($this->courses::uploadPreview($data['preview'], $data['title']));
        $course->save();

        Log::info('Добавлен курс №' . $course->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.courses.show', $course);
    }

    /**
     * @param Course $course
     * @return View
     */
    public function show(Course $course): View
    {
        SEOMeta::setTitle('Курс: ' . $course->getTitle());

        return view('crm.courses.show', compact('course'));
    }

    /**
     * @param Course $course
     * @return View
     */
    public function edit(Course $course): View
    {
        SEOMeta::setTitle('Редактирование курса: ' . $course->getTitle());

        return view('crm.courses.edit', compact('course'));
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'title'             => 'required|max:255',
            'short_description' => 'required|max:255',
            'full_description'  => 'required',
            'price'             => 'required|integer',
        ], [
            'title.max'                  => 'Название должно быть меньше 255 символов',
            'title.required'             => 'Введите название',
            'short_description.max'      => 'Краткое описание должно быть меньше 255 символов',
            'short_description.required' => 'Введите краткое описание',
            'full_description.required'  => 'Введите описание',
            'price.required'             => 'Введите цену',
        ]);

        if (isset($data['preview'])) {
            $data['preview'] = $this->courses::uploadPreview($data['preview'], $data['title']);
        }

        $course->update($data);

        Log::info('Изменен курс №' . $course->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.courses.show', $course);


    }

    /**
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        Log::info('Удален курс: ' . $course->getTitle() . ', менеджер: ' . Auth::id());

        $course->delete();

        return redirect()->route('crm.courses.index');
    }
}
