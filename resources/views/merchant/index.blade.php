@extends('layout.index')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Merchant List') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Email') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>
                                    <a href="{{ route('stores', $model) }}">
                                        {{ $model->name }}
                                    </a>
                                </td>
                                <td>{{ $model->phone }}</td>
                                <td>{{ $model->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center float-right">
                {{ $models->links() }}
            </div>
        </div>
    </div>
@endsection
