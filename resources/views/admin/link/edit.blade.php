@extends('admin.layouts.index')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.link.index') }}">links</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit link {{ $link->name }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <form class="row g-3" action="{{ route('admin.link.update', $link->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $link->name }}" placeholder="Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="original_link" class="form-label">Original link</label>
            <input type="text" class="form-control" name="original_link" value="{{ $link->original_link }}"
                   id="original_link"
                   placeholder="Enter link to convert">
            @error('original_link')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="max_views" class="form-label">Max views (if 0 - unlimited)</label>
            <input type="number" name="max_views" value="{{ $link->max_views }}" class="form-control" id="max_views">
            @error('max_views')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="id_end_time">Expire (hrs : min : sec)</label>
                <div class="input-group date" id="id_3">
                    <input type="text" name="expired_at" value="{{ $expired }}" class="form-control" placeholder="End time"
                           title="" required id="expired_at"/>
                    <div class="input-group-addon input-group-append">
                        <div class="input-group-text">
                            <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                @error('expired_at')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <link rel="stylesheet" href="{{ asset('admin_dist/css/bootstrap-datetimepicker.min.css') }}">
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script src="{{ asset('admin_dist/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        jQuery(document).ready(function ($) {

            $('#id_3').datetimepicker({
                "allowInputToggle": true,
                "showClose": true,
                "showClear": true,
                "showTodayButton": true,
                "format": "HH:mm:ss",
            });
        });
    </script>
@endsection
