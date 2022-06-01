<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ReviewsController extends Controller
{
    /**
     * @var Review
     */
    protected Review $reviews;

    /**
     * @param Review $reviews
     */
    public function __construct(Review $reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Отзывы');
        $data    = $request->all();
        $reviews = $this->reviews::filter($data)->paginate(12);

        return view('crm.reviews.index', compact('reviews', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить отзыв');
        $usersList = User::getUsersList();

        return view('crm.reviews.create', compact('usersList'));
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
            'description' => 'required|max:350',
            'image'       => 'nullable',
            'user_id'     => 'required|exists:users,id',
        ], [
            'description.required' => 'Введите отзыв',
            'description.max'      => 'Отзыв должен быть меньше 350 символов',
            'user_id.required'     => 'Выберите пользователя',
            'user_id.exists'       => 'Такого пользователя не существует в базе',
        ]);

        $review = new Review();
        $review->setDescription($data['description']);
        $review->setUserId($data['user_id'] ?? null);
        $review->setAnon($data['anon'] ?? false);
        $review->setPublished(false);
        if (isset($data['image'])) {
            $review->setImage($this->reviews::uploadImage($data['image']));
        }
        $review->save();

        Log::info('Добавлен отзыв №' . $review->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.reviews.show', $review);
    }

    /**
     * @param Review $review
     * @return View
     */
    public function show(Review $review): View
    {
        SEOMeta::setTitle('Отзыв №' . $review->getKey());

        return view('crm.reviews.show', compact('review'));
    }

    /**
     * @param Review $review
     * @return View
     */
    public function edit(Review $review): View
    {
        SEOMeta::setTitle('Редактирование отзыва №' . $review->getKey());
        $usersList = User::getUsersList();

        return view('crm.reviews.edit', compact('review', 'usersList'));
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'description' => 'required|max:350',
            'image'       => 'nullable',
            'user_id'     => 'required|exists:users,id',
        ], [
            'description.required' => 'Введите отзыв',
            'description.max'      => 'Отзыв должен быть меньше 350 символов',
            'user_id.required'     => 'Выберите пользователя',
            'user_id.exists'       => 'Такого пользователя не существует в базе',
        ]);

        if (isset($data['image'])) {
            $data['image'] = $this->reviews::uploadImage($data['image']);
        } else {
            if (isset($data['delete_image']) && $data['delete_image'] === 'true') {
                $data['image'] = null;
            }
        }

        $review->update($data);

        Log::info('Изменен отзыв №' . $review->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.reviews.show', $review);
    }

    /**
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review): RedirectResponse
    {
        Log::info('Удален отзыв №' . $review->getKey() . ', менеджер: ' . Auth::id());

        $review->delete();

        return redirect()->route('crm.reviews.index');
    }

    /**
     * @param Review $review
     * @param Request $request
     * @return RedirectResponse
     */
    public function publish(Review $review, Request $request): RedirectResponse
    {
        $data = $request->all();

        $review->setPublished($data['published']);
        $review->save();

        return redirect()->back();
    }
}
