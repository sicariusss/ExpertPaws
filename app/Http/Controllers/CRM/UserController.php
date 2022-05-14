<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @var User
     */
    protected User $users;

    /**
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Пользователи');
        $data  = $request->all();
        $users = $this->users::filter($data)->paginate(15);

        return view('crm.users.index', compact('users', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить пользователя');
        $rolesList = Role::getRolesList();

        return view('crm.users.create', compact('rolesList'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'surname'    => 'nullable|max:255',
            'name'       => 'required|max:255',
            'patronymic' => 'nullable|max:255',
            'email'      => 'required|max:255',
            'phone'      => 'nullable|max:255',
            'address'    => 'nullable|max:255',
            'role_id'    => 'required|exists:roles,id',
            'password'   => 'required|min:8|max:255'
        ], [
            'surname.max'       => 'Фамилия должна быть меньше 255 символов',
            'name.required'     => 'Введите имя',
            'name.max'          => 'Имя должно быть меньше 255 символов',
            'patronymic.max'    => 'Отчество должно быть меньше 255 символов',
            'email.required'    => 'Введите почту',
            'email.max'         => 'Почта должна быть меньше 255 символов',
            'phone.max'         => 'Телефон должен быть меньше 255 символов',
            'address.max'       => 'Адрес должен быть меньше 255 символов',
            'role_id.required'  => 'Выберите роль',
            'role_id.exists'    => 'Такая роль не существует',
            'password.required' => 'Введите пароль',
            'password.min'      => 'Пароль должен быть больше 8 символов',
            'password.max'      => 'Пароль должен быть меньше 255 символов',
        ]);


        $user = new User();
        $user->setSurname($data['surname'] ?? '');
        $user->setName($data['name']);
        $user->setPatronymic($data['patronymic'] ?? '');
        $user->setEmail($data['email']);
        $user->setPhone($data['phone'] ?? null);
        $user->setAddress($data['address'] ?? null);
        $user->setRoleId($data['role_id']);
        if (isset($data['photo'])) {
            $user->setPhoto($this->users::uploadPhoto($data['photo']));
        }
        $user->setPassword(Hash::make($data['password']));
        $user->save();

        Log::info('Создан пользователь №' . $user->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.users.show', $user);
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        SEOMeta::setTitle('Профиль ' . $user->getShortName());

        return view('crm.users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        SEOMeta::setTitle('Редактирование пользователя: ' . $user->getShortName());
        $rolesList = Role::getRolesList();

        return view('crm.users.edit', compact('rolesList', 'user'));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'surname'    => 'nullable|max:255',
            'name'       => 'required|max:255',
            'patronymic' => 'nullable|max:255',
            'email'      => 'required|max:255',
            'phone'      => 'nullable|max:255',
            'address'    => 'nullable|max:255',
            'role_id'    => 'required|exists:roles,id',
            'password'   => 'required|min:8|max:255'
        ], [
            'surname.max'       => 'Фамилия должна быть меньше 255 символов',
            'name.required'     => 'Введите имя',
            'name.max'          => 'Имя должно быть меньше 255 символов',
            'patronymic.max'    => 'Отчество должно быть меньше 255 символов',
            'email.required'    => 'Введите почту',
            'email.max'         => 'Почта должна быть меньше 255 символов',
            'phone.max'         => 'Телефон должен быть меньше 255 символов',
            'address.max'       => 'Адрес должен быть меньше 255 символов',
            'role_id.required'  => 'Выберите роль',
            'role_id.exists'    => 'Такая роль не существует',
            'password.required' => 'Введите пароль',
            'password.min'      => 'Пароль должен быть больше 8 символов',
            'password.max'      => 'Пароль должен быть меньше 255 символов',
        ]);

        if (isset($data['photo'])) {
            $data['photo'] = $this->users::uploadPhoto($data['photo']);
        }

        $user->update($data);
        $user->save();

        Log::info('Изменен пользователь №' . $user->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.users.show', $user);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        Log::info('Удален пользователь №' . $user->getKey() . ', менеджер: ' . Auth::id());

        $user->delete();

        return redirect()->route('crm.users.index');
    }
}
