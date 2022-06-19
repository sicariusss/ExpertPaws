@extends('layouts.app')

<?php
use Artesaos\SEOTools\Facades\SEOMeta;
SEOMeta::setTitle('Логи');
/** @var  Illuminate\Pagination\LengthAwarePaginator $rows */
?>

@section('content')
    <div class="page-header mb-4">
        <a href="{{ route('log-viewer::logs.list') }}" class="index-title">
            Все логи
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                @foreach($headers as $key => $header)
                    <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                        @if ($key == 'date')
                            <span class="badge log-title badge-info">Дата</span>
                        @else
                            <span class="badge log-title badge-level-{{ $key }}">
                                {{ log_styler()->icon($key) }} {{ $header }}
                            </span>
                        @endif
                    </th>
                @endforeach
                <th scope="col" class="text-right log-actions">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rows as $date => $row)
                <tr>
                    @foreach($row as $key => $value)
                        <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                            @if ($key == 'date')
                                <span class="badge badge-primary text-white">{{ $value }}</span>
                            @elseif ($value == 0)
                                <span class="badge empty text-white">{{ $value }}</span>
                            @else
                                <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                    <span class="badge text-white badge-level-{{ $key }}">{{ $value }}</span>
                                </a>
                            @endif
                        </td>
                    @endforeach
                    <td class="text-right">
                        <div class="btn-group" role="group">
                            <a href="{{ route('log-viewer::logs.show', [$date]) }}" title="Подробная информация"
                               class="btn btn-outline-primary action-btn">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{ route('log-viewer::logs.download', [$date]) }}" title="Скачать"
                               class="btn btn-outline-success action-btn">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <span class="badge badge-secondary">В системе отсутствуют логи</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $rows->render() }}
@endsection
