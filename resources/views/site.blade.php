@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <div class="list-group">
                            @foreach($rows as $row)
                                <a href="{{ route('filter', ['url' => $url, 'q' => $row->keys[0] ?? '']) }}"
                                   class="list-group-item d-flex justify-content-between align-items-center">
                                    {{  $row->keys[0] ?? '' }}
                                    <span class="badge badge-primary badge-pill">
                                        {{ $row->clicks }} clicks
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
