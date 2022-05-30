<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @var Contact
     */
    protected Contact $contacts;

    /**
     * @param Contact $contacts
     */
    public function __construct(Contact $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Контакты');
        $data     = $request->all();
        $contacts = $this->contacts::filter($data)->paginate(15);

        return view('crm.contacts.index', compact('contacts', 'data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        SEOMeta::setTitle('Добавить контакт');
        $typesList = $this->contacts::getTypesList();

        return view('crm.contacts.create', compact('typesList'));
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
            'type'    => 'required|max:255',
            'content' => 'required|max:255',
            'title'   => 'required|max:255',
        ], [
            'type.required'    => 'Введите тип',
            'type.max'         => 'Тип должен быть меньше 255 символов',
            'content.required' => 'Введите контакт',
            'content.max'      => 'Контакт должен быть меньше 255 символов',
            'title.required'   => 'Введите название',
            'title.max'        => 'Название должно быть меньше 255 символов',
        ]);

        $contact = new Contact();
        $contact->setType($data['type']);
        $contact->setContent($data['content']);
        $contact->setTitle($data['title']);
        $contact->save();

        Log::info('Создан контакт №' . $contact->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.contacts.show', $contact);
    }

    /**
     * @param Contact $contact
     * @return View
     */
    public function show(Contact $contact): View
    {
        SEOMeta::setTitle('Контакт: ' . $contact->getType() . ' - ' . $contact->getTitle());

        return view('crm.contacts.show', compact('contact'));
    }

    /**
     * @param Contact $contact
     * @return View
     */
    public function edit(Contact $contact): View
    {
        SEOMeta::setTitle('Редактирование контакта: ' . $contact->getTitle());
        $typesList = $this->contacts::getTypesList();

        return view('crm.contacts.edit', compact('contact', 'typesList'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $data = $request->all();

        $this->validate($request, [
            'type'    => 'required|max:255',
            'content' => 'required|max:255',
            'title'   => 'required|max:255',
        ], [
            'type.required'    => 'Введите тип',
            'type.max'         => 'Тип должен быть меньше 255 символов',
            'content.required' => 'Введите контакт',
            'content.max'      => 'Контакт должен быть меньше 255 символов',
            'title.required'   => 'Введите название',
            'title.max'        => 'Название должно быть меньше 255 символов',
        ]);

        $contact->update($data);

        Log::info('Изменен контакт №' . $contact->getKey() . ', менеджер: ' . Auth::id());

        return redirect()->route('crm.contacts.show', $contact);
    }

    /**
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        Log::info('Удален контакт №' . $contact->getKey() . ', менеджер: ' . Auth::id());

        $contact->delete();

        return redirect()->route('crm.contacts.index');
    }
}
