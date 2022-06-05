<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ChapterController extends Controller
{
    /**
     * @var Chapter
     */
    protected Chapter $chapters;

    /**
     * @param Chapter $chapters
     */
    public function __construct(Chapter $chapters)
    {
        $this->chapters = $chapters;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Главы');
        $data     = $request->all();
        $chapters = $this->chapters::filter($data)->paginate(15);

        return view('crm.chapters.index', compact('chapters', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить главу');
        $coursesList = Course::getCoursesList();

        return view('crm.chapters.create', compact('coursesList'));
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
            'title'     => 'required|max:255',
            'course_id' => 'required|integer',
            'icon'      => 'required',
        ], [
            'title.max'          => 'Название должно быть меньше 255 символов',
            'title.required'     => 'Введите название',
            'course_id.required' => 'Выберите курс, к которому привязать урок',
            'icon.required'      => 'Загрузите картинку главы',
        ]);

        $chapter = new Chapter();
        $chapter->setTitle($data['title']);
        $chapter->setCourseId($data['course_id']);
        $chapter->setIcon($this->chapters::uploadIcon($data['icon'], $data['title']));
        $chapter->save();

        Log::info('Добавлена глава №' . $chapter->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.chapters.show', $chapter);
    }

    /**
     * @param Chapter $chapter
     * @return View
     */
    public function show(Chapter $chapter): View
    {
        SEOMeta::setTitle('Глава: ' . $chapter->getTitle());

        return view('crm.chapters.show', compact('chapter'));
    }

    /**
     * @param Chapter $chapter
     * @return View
     */
    public function edit(Chapter $chapter): View
    {
        SEOMeta::setTitle('Редактирование главы: ' . $chapter->getTitle());
        $coursesList = Course::getCoursesList();

        return view('crm.chapters.edit', compact('chapter', 'coursesList'));
    }

    /**
     * @param Request $request
     * @param Chapter $chapter
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Chapter $chapter): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'title'     => 'required|max:255',
            'course_id' => 'required|integer',
        ], [
            'title.max'          => 'Название должно быть меньше 255 символов',
            'title.required'     => 'Введите название',
            'course_id.required' => 'Выберите курс, к которому привязать урок',
        ]);

        if (isset($data['icon'])) {
            $data['icon'] = $this->chapters::uploadIcon($data['icon'], $data['title']);
        }

        $chapter->update($data);

        Log::info('Изменена глава №' . $chapter->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.chapters.show', $chapter);
    }

    /**
     * @param Chapter $chapter
     * @return RedirectResponse
     */
    public function destroy(Chapter $chapter): RedirectResponse
    {
        Log::info('Удалена глава: ' . $chapter->getTitle() . ', менеджер: ' . Auth::id());

        $chapter->delete();

        return redirect()->route('crm.chapters.index');
    }
}
