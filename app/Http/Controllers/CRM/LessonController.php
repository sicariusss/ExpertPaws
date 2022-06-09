<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * @var Lesson
     */
    protected Lesson $lessons;

    /**
     * @param Lesson $lessons
     */
    public function __construct(Lesson $lessons)
    {
        $this->lessons = $lessons;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Уроки');
        $data    = $request->all();
        $lessons = $this->lessons::filter($data)->paginate(15);

        return view('crm.lessons.index', compact('lessons', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить урок');
        $chaptersList = Chapter::getChaptersList();

        return view('crm.lessons.create', compact('chaptersList'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required',
            'content'     => 'required',
            'chapter_id'  => 'required|integer',
        ], [
            'title.max'            => 'Название должно быть меньше 255 символов',
            'title.required'       => 'Введите название',
            'description.required' => 'Введите описание',
            'content.required'     => 'Введите контент',
            'chapter_id.required'  => 'Выберите главу, к которой привязать урок',
        ]);

        $lesson = new Lesson();
        $lesson->setTitle($data['title']);
        $lesson->setDescription($data['description']);
        $lesson->setContent($data['content']);
        $lesson->setChapterId($data['chapter_id']);
        $lesson->setSlug(Str::slug($data['title']));
        $lesson->save();

        Log::info('Добавлен урок №' . $lesson->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.lessons.show', $lesson);
    }

    /**
     * @param Lesson $lesson
     * @return View
     */
    public function show(Lesson $lesson): View
    {
        SEOMeta::setTitle('Урок: ' . $lesson->getTitle());

        return view('crm.lessons.show', compact('lesson'));
    }

    /**
     * @param Lesson $lesson
     * @return View
     */
    public function edit(Lesson $lesson): View
    {
        SEOMeta::setTitle('Редактирование урока: ' . $lesson->getTitle());
        $chaptersList = Chapter::getChaptersList();

        return view('crm.lessons.edit', compact('lesson', 'chaptersList'));
    }

    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Lesson $lesson): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'title'       => 'required|max:255',
            'description' => 'required',
            'content'     => 'required',
            'chapter_id'  => 'required|integer',
        ], [
            'title.max'            => 'Название должно быть меньше 255 символов',
            'title.required'       => 'Введите название',
            'description.required' => 'Введите описание',
            'content.required'     => 'Введите контент',
            'chapter_id.required'  => 'Выберите главу, к которой привязать урок',
        ]);

        $data['slug'] = Str::slug($data['title']);

        $lesson->update($data);

        Log::info('Изменен урок №' . $lesson->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.lessons.show', $lesson);
    }

    /**
     * @param Lesson $lesson
     * @return RedirectResponse
     */
    public function destroy(Lesson $lesson): RedirectResponse
    {
        Log::info('Удален урок: ' . $lesson->getTitle() . ', менеджер: ' . Auth::id());

        $lesson->delete();

        return redirect()->route('crm.lessons.index');
    }
}
