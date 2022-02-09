@extends('layout.master');

@section('content')

        <div class="row">

            @if(session()->has('success'))
                <p class="alert alert-success">{{session()->get('success')}}</p>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-6">
                <form method="post" action="{{route('link.save')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="input_uri">Ссылка:</label>
                            <input type="text" class="form-control" id="input_uri" name="uri" placeholder="Вставьте ссылку...">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="max_visits">Лимит переходов:</label>
                            <input type="number" class="form-control" id="max_visits" name="max_visits" placeholder="" value="0" min="0">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="time">Время жизни ссылки:</label>
                        <input type="time" class="form-control" id="time" name="time" value="00:01">
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                </form>
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
@endsection