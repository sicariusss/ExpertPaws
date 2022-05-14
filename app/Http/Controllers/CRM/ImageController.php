<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        return view('crm.images.create');
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
            'type_id' => 'required|max:255',
            'image'   => 'required',
        ], [
            'type.max'         => 'Тип должен быть меньше 255 символов',
            'type.required'    => 'Введите тип',
            'type_id.max'      => 'Тип должен быть меньше 255 символов',
            'type_id.required' => 'Введите тип',
            'image.required'   => 'Загрузите изображение',
        ]);

        $image = new Image();
        $image->setType($data['type']);
        $image->setTypeId($data['type_id']);
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

        return view('crm.images.edit', compact('image'));
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
            'type_id' => 'required|max:255',
        ], [
            'type.max'         => 'Тип должен быть меньше 255 символов',
            'type.required'    => 'Введите тип',
            'type_id.max'      => 'Тип должен быть меньше 255 символов',
            'type_id.required' => 'Введите тип',
        ]);

        if (isset($data['image'])) {
            $data['path'] = $this->images::uploadImage($data['image'], $data['type']);
        }

        $image->update($data);
        $image->save();

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
