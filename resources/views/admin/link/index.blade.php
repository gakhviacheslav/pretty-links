@extends('admin.layouts.index')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Your links</li>
        </ol>
    </nav>
@endsection


@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Original Link</th>
            <th scope="col">Short Link</th>
            <th scope="col">Views</th>
            <th scope="col">Max Views</th>
            <th scope="col">Expired</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $links as $link)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="{{ route('admin.link.show', $link->id) }}">{{ $link->name }}</a></td>
                <td>{{ $link->original_link }}</td>
                <td>{{ route('redirect.show', $link->token) }}</td>
                <td>{{ $link->views }}</td>
                <td>{{ $link->max_views }}</td>
                <td>{{ $link->expired_at }}</td>
                <td class="@if ( $link->status == 'active' ) text-success @else text-danger @endif">
                    {{ $link->status }}
                </td>
                <td>

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <input class="copyTarget" style="display:none;"
                                   value="{{ route('redirect.show', $link->token) }}">
                            <div class="dropdown-item">
                                <button class="btn btn-success copyButton w-100">Copy</button>
                            </div>
                            <a class="dropdown-item" href="{{ route('admin.link.show', $link->id) }}">
                                <button class="btn btn-secondary w-100">Detail</button>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.link.edit', $link->id) }}">
                                <button class="btn btn-warning w-100">Edit</button>
                            </a>
                            <form class="dropdown-item" action="{{ route('admin.link.destroy', $link->id) }}"
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Sure delete?')"
                                        class="btn btn-danger w-100">Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script>
        document.addEventListener("click", (function (e) {
            if (e.target.closest(".copyButton")) {
                let copyText = e.target.closest(".dropdown-menu").querySelector(".copyTarget");
                // console.log(copyText);
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                alert("Copied the text: " + copyText.value);
            }
        }));
    </script>
@endsection
