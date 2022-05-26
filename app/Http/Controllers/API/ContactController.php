<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @return Response
     */
    public function contacts(): Response
    {
        return response()->json(
            [
                'emails'  => Contact::where('type', Contact::TYPE_EMAIL)->get(),
                'phones'  => Contact::where('type', Contact::TYPE_PHONE)->get(),
                'socials' => Contact::where('type', Contact::TYPE_SOCIAL_NET)->get(),
            ],
            Response::HTTP_OK);
    }
}
