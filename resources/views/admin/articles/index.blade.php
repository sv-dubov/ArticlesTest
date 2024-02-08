@extends('layouts.admin')

@section('pageTitle')
    {{ __('messages.articles') }}
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap grid-margin">
        <div>
            <h4>{{ __('messages.articles') }}</h4>
        </div>
        <div>
            <a class="btn btn-success" href="{{ route('articles.create') }}">{{ __('messages.add') }}</a>
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
                            ['class' => 'form-control', 'placeholder' => __('messages.choose_status'), 'id' => 'is_public']) }}
                    </div>
                    <div class="col-md-4 mb-3 d-flex gap-1 flex-wrap align-items-end">
                        <button class="btn btn-success" type="submit">{{ __('messages.search') }}</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary" type="button">
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
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>
                    @foreach($articles->chunk(50) as $row)
                        @foreach($row as $article)
                            <tbody>
                            <tr>
                                <th scope="row">{{ $articles->firstItem() + $loop->index }}</th>
                                <td class="text-wrap">{{ $article->title }}</td>
                                <td>{{ $article->isPublic() }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-dark px-0" type="button" data-bs-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-three-dots-vertical"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('articles.edit', $article->id) }}">{{ __('messages.edit') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                {{ Form::model($article, ['route' => ['articles.destroy', $article->id], 'method' => 'delete', 'class' => 'form-delete', 'data-delete-id' => $article->id]) }}
                                                <button type="submit"
                                                        class="dropdown-item">{{ __('messages.delete') }}</button>
                                                {{ Form::close() }}
                                            </li>
                                        </ul>
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
            {{ $articles->links("pagination::bootstrap-5") }}
        </div>
    </div>

    <div class="modal fade" id="removeArticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('messages.delete_article') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ __('messages.delete_article_confirm') }}
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
                $("#removeArticle").modal("show");
            })
        });

        removeBtn.addEventListener("click", () => {
            document.querySelector("[data-delete-id=\"" + removeBtn.getAttribute("data-delete-id") + "\"]").submit();
        });
    </script>
@endsection
