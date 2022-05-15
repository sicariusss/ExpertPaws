<?php

use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;

SEOMeta::setTitle('Expert Paws - CRM');

/**
 * @var \App\Models\User $user
 */
$user = Auth::user();

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">
        <div class="welcome-block pt-5">
            <div class="welcome-desc pb-5">
                CRM <a href="/">Expert Paws</a> - Система управления контентом и взаимоотношения с клиентами.
            </div>
            <div class="welcome-name">
                Добро пожаловать, <a href="{{route('crm.users.show',Auth::user())}}">{{ $user->getName() }}</a>!
            </div>
        </div>
    </div>
@endsection
