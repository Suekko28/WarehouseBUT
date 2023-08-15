@extends('layouts.app')

@section('content')
<div class="row">

    @forelse ($data as $item)
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <span class="text-muted text-uppercase fs-12 fw-bold">{{$item['label']}}</span>
                            <h3 class="mb-0">{{ $item['counts'] ?? 0}}</h3>
                        </div>
                        <div class="align-self-center flex-shrink-0">
                            <i data-feather="package"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse


</div>
@endsection
