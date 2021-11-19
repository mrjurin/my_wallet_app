<h1>{{ $app_name }} Hello World {{ $name }} - {{ $age }}, This is laravel world </h1>


<form action="/hello-world/store" method="post">
    {{ csrf_field() }}
    <button type="submit">Submit Form</button>
</form>

