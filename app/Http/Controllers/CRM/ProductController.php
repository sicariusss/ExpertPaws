<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    protected Product $products;

    /**
     * @param Product $products
     */
    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Товары');
        $data     = $request->all();
        $products = $this->products::filter($data)->paginate(15);

        return view('crm.products.index', compact('products', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить товар');
        $categoriesList = Category::getCategoriesList();

        return view('crm.products.create', compact('categoriesList'));
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
            'name'         => 'required|max:255',
            'description'  => 'nullable',
            'price'        => 'required|integer',
            'manufacturer' => 'nullable|max:255',
            'preview'      => 'required',
            'category_id'  => 'required|exists:categories,id',
        ], [
            'name.required'        => 'Введите название',
            'name.max'             => 'Название должно быть меньше 255 символов',
            'price.required'       => 'Введите цену',
            'manufacturer.max'     => 'Имя производителя должно быть меньше 255 символов',
            'preview.required'     => 'Загрузите превью товара',
            'category_id.required' => 'Выберите категорию товара',
            'category_id.exists'   => 'Такой категории не существует',
        ]);

        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description'] ?? null);
        $product->setPrice($data['price']);
        $product->setManufacturer($data['manufacturer'] ?? null);
        $product->setPreview($this->products::uploadPreview($data['preview'], $data['name']));
        $product->setCategoryId($data['category_id']);
        $product->save();

        Log::info('Создан товар №' . $product->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.products.show', $product);
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        SEOMeta::setTitle('Товар: ' . $product->getName());

        return view('crm.products.show', compact('product'));
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        SEOMeta::setTitle('Редактирование товара: ' . $product->getName());
        $categoriesList = Category::getCategoriesList();

        return view('crm.products.edit', compact('product', 'categoriesList'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'name'         => 'required|max:255',
            'description'  => 'nullable',
            'price'        => 'required|integer',
            'manufacturer' => 'nullable|max:255',
            'category_id'  => 'required|exists:categories,id',
        ], [
            'name.required'        => 'Введите название',
            'name.max'             => 'Название должно быть меньше 255 символов',
            'price.required'       => 'Введите цену',
            'manufacturer.max'     => 'Имя производителя должно быть меньше 255 символов',
            'category_id.required' => 'Выберите категорию товара',
            'category_id.exists'   => 'Такой категории не существует',
        ]);

        if (isset($data['preview'])) {
            $data['preview'] = $this->products::uploadPreview($data['preview'], $data['name']);
        }
        $product->update($data);
        $product->save();

        Log::info('Изменен товар №' . $product->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.products.show', $product);
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        Log::info('Удален товар №' . $product->getKey() . ', менеджер: ' . Auth::id());

        $product->delete();

        return redirect()->route('crm.products.index');
    }
}
