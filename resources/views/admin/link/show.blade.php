@extends('admin.layouts.index')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.link.index') }}">links</a></li>
            <li class="breadcrumb-item active" aria-current="page">link: {{ $link->name }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <table class="table table-sm">
        <thead>
        <tr>

            <th scope="col">Param</th>
            <th scope="col">Value</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Name:</td>
            <td>{{ $link->name }}</td>
        </tr>
        <tr>
            <td>Original link:</td>
            <td>{{ $link->original_link }}</td>

        </tr>
        <tr>
            <td>Pretty link:</td>
            <td>{{ route('redirect.show', $link->token) }}</td>
        </tr>
        <tr>
            <td>Qty views:</td>
            <td>{{ $link->views }}</td>
        </tr>
        <tr>
            <td>Max views:</td>
            <td>{{ $link->max_views }}</td>
        </tr>
        <tr>
            <td>Expired at:</td>
            <td>{{ $link->expired_at }}</td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>{{ $link->status }}</td>
        </tr>

        </tbody>
    </table>
    <a href="{{ route('admin.link.edit', $link->id) }}" class="btn btn-primary">Edit link</a>

@endsection
