<?php

use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;

SEOMeta::setTitle('ExpertPaws - CRM');

/**
 * @var \App\Models\User $user
 */
$user = Auth::user();

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">
        Добро пожаловать в панель управления Expert Paws, {{ $user->getName() }}!
    </div>
@endsection
