<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * @var Gallery
     */
    protected Gallery $gallery;

    /**
     * @param Gallery $gallery
     */
    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Галерея');
        $data    = $request->all();
        $gallery = $this->gallery::filter($data)->paginate(15);

        return view('crm.gallery.index', compact('gallery', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить изображение в галерею');

        return view('crm.gallery.create');
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
            'name'        => 'nullable|max:255',
            'description' => 'nullable',
            'image'       => 'required',
        ], [
            'name.max'       => 'Название должно быть меньше 255 символов',
            'image.required' => 'Загрузите изображение',
        ]);

        $gallery = new Gallery();
        $gallery->setName($data['name'] ?? null);
        $gallery->setDescription($data['description'] ?? null);
        $gallery->setImage($this->gallery::uploadImage($data['image']));
        $gallery->save();

        Log::info('Добавлено изображение в галерею №' . $gallery->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.gallery.show', $gallery);
    }

    /**
     * @param Gallery $gallery
     * @return View
     */
    public function show(Gallery $gallery): View
    {
        SEOMeta::setTitle('Изображение галереи №' . $gallery->getKey());

        return view('crm.gallery.show', compact('gallery'));
    }

    /**
     * @param Gallery $gallery
     * @return View
     */
    public function edit(Gallery $gallery): View
    {
        SEOMeta::setTitle('Редактирование галереи №' . $gallery->getKey());

        return view('crm.gallery.edit', compact('gallery'));
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'name'        => 'nullable|max:255',
            'description' => 'nullable',
        ], [
            'name.max' => 'Название должно быть меньше 255 символов',
        ]);

        if (isset($data['image'])) {
            $data['image'] = $this->gallery::uploadImage($data['image']);
        }

        $gallery->update($data);
        $gallery->save();

        Log::info('Изменено изображение галереи №' . $gallery->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.gallery.show', $gallery);
    }

    /**
     * @param Gallery $gallery
     * @return RedirectResponse
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        Log::info('Удалено изображение галереи №' . $gallery->getKey() . ', менеджер: ' . Auth::id());

        $gallery->delete();

        return redirect()->route('crm.gallery.index');
    }
}
