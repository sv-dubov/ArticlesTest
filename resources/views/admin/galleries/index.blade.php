@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.galleries') }}
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
        <div>
            <h4>{{ __('messages.galleries') }}</h4>
        </div>
        <div>
            <a class="btn btn-success" href="{{ route('galleries.create') }}">{{ __('messages.add') }}</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="filter-section">
                {{ Form::open(['method' => 'GET']) }}
                <div class="row">
                    <div class="col-md-8 mb-3">
                        {{ Form::label('article', __('messages.article'), ['class' => 'form-label fw-bold']) }}
                        {{ Form::select('article', $articles, request()->article ?? null, ['class' => 'form-select js-example-basic-single', 'placeholder' => __('messages.choose_article'), 'id' => 'article']) }}
                    </div>
                    <div class="col-md-4 mb-3 d-flex gap-1 flex-wrap align-items-end">
                        <button class="btn btn-success" type="submit">{{ __('messages.search') }}</button>
                        <a href="{{ route('galleries.index') }}" class="btn btn-secondary" type="button">
                            {{ __('messages.reset') }}
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive table-height">
                <table id="dataTableExample" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{ __('messages.article') }}</th>
                        <th>{{ __('messages.sequence_number') }}</th>
                        <th class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>
                    @foreach($galleries as $gallery)
                        <tbody>
                        <tr>
                            <th>{{ $gallery->id }}</th>
                            <td class="text-wrap">{{ $gallery->article->title }}</td>
                            <td>{{ $gallery->sequence_number }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap grid-margin">
                                    <a class="btn icon" href="{{ route('galleries.edit', $gallery->id) }}"><i class="text-warning" data-feather="edit"></i></a>
                                    {{ Form::model($gallery, ['route' => ['galleries.destroy', $gallery->id], 'method' => 'delete', 'class' => 'form-delete', 'data-delete-id' => $gallery->id]) }}
                                    <button type="submit" class="btn icon"><i class="text-danger" data-feather="delete"></i></button>
                                    {{ Form::close() }}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="pagination">
        <div class="container mt-1">
            {{ $galleries->links("pagination::bootstrap-5") }}
        </div>
    </div>

    <div class="modal fade" id="removeGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('messages.delete_gallery') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ __('messages.delete_gallery_confirm') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-type" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="button" class="btn btn-success" data-remove-btn>{{ __('messages.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endpush

    <script>
        let formDelete = document.querySelectorAll(".form-delete");
        let removeBtn = document.querySelector("[data-remove-btn]");

        formDelete.forEach((item) => {
            item.addEventListener("click", (event) => {
                event.preventDefault();
                removeBtn.setAttribute("data-delete-id", item.getAttribute("data-delete-id"));
                $("#removeGallery").modal("show");
            })
        });

        removeBtn.addEventListener("click", () => {
            document.querySelector("[data-delete-id=\"" + removeBtn.getAttribute("data-delete-id") + "\"]").submit();
        });
    </script>
@endsection
