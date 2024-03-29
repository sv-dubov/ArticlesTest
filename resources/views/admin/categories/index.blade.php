@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.categories') }}
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
        <div>
            <h4>{{ __('messages.categories') }}</h4>
        </div>
        <div>
            <a class="btn btn-success" href="{{ route('categories.create') }}">{{ __('messages.add') }}</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="filter-section">
                {{ Form::open(['method' => 'GET']) }}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        {{ Form::label('title', __('messages.title'), ['class' => 'form-label fw-bold']) }}
                        {{ Form::text('title', request()->title ?? null, ['class' => 'form-control', 'id' => 'title']) }}
                    </div>
                    <div class="col-md-4 mb-3">
                        {{ Form::label('is_public', __('messages.status'), ['class' => 'form-label fw-bold']) }}
                        {{ Form::select('is_public', ['1' => __('messages.published'), '0' => __('messages.not_published')], request()->is_public ?? null,
                            ['class' => 'form-select', 'placeholder' => __('messages.choose_status'), 'id' => 'is_public']) }}
                    </div>
                    <div class="col-md-4 mb-3 d-flex gap-1 flex-wrap align-items-end">
                        <button class="btn btn-success" type="submit">{{ __('messages.search') }}</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary" type="button">
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
                        <th>#</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>
                    @foreach($categories->chunk(50) as $row)
                        @foreach($row as $category)
                            <tbody>
                            <tr>
                                <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                <td class="text-wrap">{{ $category->title }}</td>
                                <td>{{ $category->isPublic() }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap grid-margin">
                                        <a class="btn icon" href="{{ route('categories.edit', $category->id) }}"><i class="text-warning" data-feather="edit"></i></a>
                                        {{ Form::model($category, ['route' => ['categories.destroy', $category->id], 'method' => 'delete', 'class' => 'form-delete', 'data-delete-id' => $category->id]) }}
                                        <button type="submit" class="btn icon"><i class="text-danger" data-feather="delete"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="pagination">
        <div class="container mt-1">
            {{ $categories->links("pagination::bootstrap-5") }}
        </div>
    </div>

    <div class="modal fade" id="removeCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('messages.delete_category') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ __('messages.delete_category_confirm') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-type" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="button" class="btn btn-success" data-remove-btn>{{ __('messages.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let formDelete = document.querySelectorAll(".form-delete");
        let removeBtn = document.querySelector("[data-remove-btn]");

        formDelete.forEach((item) => {
            item.addEventListener("click", (event) => {
                event.preventDefault();
                removeBtn.setAttribute("data-delete-id", item.getAttribute("data-delete-id"));
                $("#removeCategory").modal("show");
            })
        });

        removeBtn.addEventListener("click", () => {
            document.querySelector("[data-delete-id=\"" + removeBtn.getAttribute("data-delete-id") + "\"]").submit();
        });
    </script>
@endsection
