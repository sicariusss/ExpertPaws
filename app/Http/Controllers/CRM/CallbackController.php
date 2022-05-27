<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CallbackController extends Controller
{
    /**
     * @var Callback
     */
    protected Callback $callbacks;

    /**
     * @param Callback $callbacks
     */
    public function __construct(Callback $callbacks)
    {
        $this->callbacks = $callbacks;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('Обращения');
        $data      = $request->all();
        $callbacks = $this->callbacks::filter($data)->paginate(15);

        return view('crm.callbacks.index', compact('callbacks', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Callback $callback
     * @return View
     */
    public function show(Callback $callback): View
    {
        SEOMeta::setTitle('Обращение №' . $callback->getKey());

        return view('crm.callbacks.show', compact('callback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param Callback $callback
     * @return RedirectResponse
     */
    public function destroy(Callback $callback): RedirectResponse
    {
        Log::info('Удалено обращение №' . $callback->getKey() . ', менеджер: ' . Auth::id());

        $callback->delete();

        return redirect()->route('crm.callbacks.index');
    }
}
