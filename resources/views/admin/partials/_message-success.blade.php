<div class="row">
    <div class="col-md-12">
        @if (session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @elseif (session()->has('status-warning'))
            <div class="alert alert-warning">
                {{ session()->get('status-warning') }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
