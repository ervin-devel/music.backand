<div class="d-flex">
    @isset($actions['edit'])
        <a href="{{ $actions['edit'] }}" class="btn btn-primary mr-2"><i class="fas fa-pen"></i></a>
    @endisset

    @isset($actions['delete'])
        <form method="POST" action="{{ $actions['delete'] }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
    @endisset
</div>
