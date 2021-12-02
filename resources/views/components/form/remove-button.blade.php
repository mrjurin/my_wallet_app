@if($user->can('read user'))
    <button class="btn btn-primary">
        Read
        {{ $slot }}
    </button>
@endif