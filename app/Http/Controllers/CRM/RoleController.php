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

class RoleController extends Controller
{
    /**
     * @var Role
     */
    protected Role $roles;

    /**
     * @param Role $roles
     */
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Роли');
        $data  = $request->all();
        $roles = $this->roles::filter($data)->paginate(15);

        return view('crm.roles.index', compact('roles', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить роль');

        return view('crm.roles.create');
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
            'name'         => 'required|max:255',
            'display_name' => 'required|max:255',
        ], [
            'name.required'         => 'Введите название',
            'name.max'              => 'Название должно быть меньше 255 символов',
            'display_name.required' => 'Введите отображаемое название',
            'display_name.max'      => 'Отображаемое название должно быть меньше 255 символов',
        ]);


        $role = new Role();
        $role->setName($data['name']);
        $role->setDisplayName($data['display_name']);
        $role->save();

        Log::info('Создан роль №' . $role->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.roles.show', $role);
    }

    /**
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        SEOMeta::setTitle('Роль "' . $role->getDisplayName() . '"');

        return view('crm.roles.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        SEOMeta::setTitle('Редактирование роли: ' . $role->getDisplayName());

        return view('crm.roles.edit', compact('role'));
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'name'         => 'required|max:255',
            'display_name' => 'required|max:255',
        ], [
            'name.required'         => 'Введите название',
            'name.max'              => 'Название должно быть меньше 255 символов',
            'display_name.required' => 'Введите отображаемое название',
            'display_name.max'      => 'Отображаемое название должно быть меньше 255 символов',
        ]);


        $role->update($data);

        Log::info('Изменена роль №' . $role->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.roles.show', $role);
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        Log::info('Удалена роль №' . $role->getKey() . ', менеджер: ' . Auth::id());

        $role->delete();

        return redirect()->route('crm.roles.index');
    }
}
