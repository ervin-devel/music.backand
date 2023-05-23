<form method="POST" action="{{ route('admin.user.activate', $user->id) }}">
    @csrf
    @method('PUT')
    <button class="btn btn-danger">Активировать</button>
</form>
