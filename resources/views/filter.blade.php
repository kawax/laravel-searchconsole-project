@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $keyword }}</div>

                    <div class="card-body">
                        <div class="list-group">
                            @foreach($rows as $row)
                                <a href="{{ $row->keys[0] ?? '' }}"
                                   target="_blank"
                                   class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="badge badge-primary badge-pill">
                                        {{ $row->clicks }} clicks
                                    </span>
                                    <span class="badge badge-primary badge-pill">
                                        {{ $row->ctr }} ctr
                                    </span>
                                    <span class="badge badge-primary badge-pill">
                                        {{ $row->impressions }} impressions
                                    </span>
                                    <span class="badge badge-primary badge-pill">
                                        {{ $row->position }} position
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
