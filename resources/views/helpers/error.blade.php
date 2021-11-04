<div>
    @if ($errors->any())
        <div class="alert alert-danger p-0 mt-1">
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>*kļūda*{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
