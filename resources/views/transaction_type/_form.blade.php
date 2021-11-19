{{ csrf_field() }}
@if ($errors->any())
<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <input class="form-control" type="hidden" name="id" value="{{ $model->id }}">
</div>

<div class="form-group">
    <input class="form-control" type="text" name="description" value="{{ $model->description }}">
</div>

@error('description')
    {{ $message }}
@enderror()

<button class="btn btn-primary" type="submit"> {{ $button_name }} </button>
