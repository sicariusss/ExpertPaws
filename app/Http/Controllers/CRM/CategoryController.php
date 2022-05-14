<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    protected Category $categories;

    /**
     * @param Category $categories
     */
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Категории товаров');
        $data       = $request->all();
        $categories = $this->categories::filter($data)->paginate(15);

        return view('crm.categories.index', compact('categories', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить категорию');
        $categoriesList = Category::getCategoriesList();

        return view('crm.categories.create', compact('categoriesList'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'nullable',
            'preview'     => 'required',
            'parent_id'   => 'nullable|exists:categories,id',
        ], [
            'name.required'    => 'Введите название',
            'name.max'         => 'Название должно быть меньше 255 символов',
            'preview.required' => 'Загрузите превью категории',
            'parent_id.exists' => 'Такой категории не существует',
        ]);

        $category = new Category();
        $category->setName($data['name']);
        $category->setDescription($data['description'] ?? null);
        $category->setPreview($this->categories::uploadPreview($data['preview'], $data['name']));
        $category->setParentId($data['parent_id'] ?? null);
        $category->save();

        Log::info('Создана категория №' . $category->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.categories.show', $category);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        SEOMeta::setTitle('Категория: ' . $category->getName());

        return view('crm.categories.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        SEOMeta::setTitle('Редактирование категории: ' . $category->getName());
        $categoriesList = $category->getCategoriesListExceptSelf();

        return view('crm.categories.edit', compact('category', 'categoriesList'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'nullable',
            'parent_id'   => 'nullable|exists:categories,id',
        ], [
            'name.required'    => 'Введите название',
            'name.max'         => 'Название должно быть меньше 255 символов',
            'parent_id.exists' => 'Такой категории не существует',
        ]);

        if (isset($data['preview'])) {
            $data['preview'] = $this->categories::uploadPreview($data['preview'], $data['name']);
        }

        $category->update($data);
        $category->save();

        Log::info('Изменена категория №' . $category->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.categories.show', $category);
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        Log::info('Удалена категория №' . $category->getKey() . ', менеджер: ' . Auth::id());

        $category->delete();

        return redirect()->route('crm.categories.index');
    }
}
