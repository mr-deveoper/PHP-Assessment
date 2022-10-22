@extends('layout.index')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Products List') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>{{ $model->title }}</td>
                                <td>{{ $model->description }}</td>
                                <td>{{ $model->sku }}</td>
                                <td>{{ $model->quantity }}</td>
                                <td>{{ $model->pivot?->price }}</td>
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
