<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="container">
                <form action="{{route('surveys.createModule',['survey'=>$survey->id])}}" method="get">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                Titolo: {{$survey->title}}<br>
                                Descrizione: {{$survey->description}}
                            </div>
                            <div class="col text-end">
                                <button type="submit" class="btn btn-dark mt-1">Aggiungi modulo</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container">
                    @if($survey->modules)
                        @foreach($survey->modules as $module)
                            <form action="./add_question/{{$survey->id}}/{{$module->id}}" method="get">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            Titolo: {{$module->title}}<br>
                                            Descrizione: {{$module->description}}
                                        </div>
                                        <div class="col text-end">
                                            <button type="submit" class="btn btn-dark mt-1">Aggiungi domanda</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    @if($module->questions)
                                        @foreach($module->questions as $question)
                                            <div class="card-header">
                                                <div class="row">
                                                    @if($question->type == 'linear_scale')
                                                        <div class="container">
                                                            <div class="card-body">
                                                                <div class="mx-0 mx-sm-auto">
                                                                    <div class="text-center">
                                                                        <p>
                                                                            <strong>{{$question->question}}</strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="text-center mb-3">
                                                                        <div class="d-inline mx-3">
                                                                            {{$question->fromAnswer}}
                                                                        </div>
                                                                        @foreach($question->answers as $answer)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                       type="radio" disabled>
                                                                                <label class="form-check-label"
                                                                                       for="inlineRadio1">{{$answer->answer}}</label>
                                                                            </div>
                                                                        @endforeach
                                                                        <div class="d-inline me-4">
                                                                            {{$question->toAnswer}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div  class="text-end">
                                                                <a href="{{route('surveys.deleteQuestion',['question'=>$question->id])}}" method="delete" class="btn btn-danger" role="button">Elimina</a>
                                                            </div>
                                                        </div>
                                                    @elseif($question->type == 'single_choice')
                                                        <div class="container">
                                                            <div class="card-body">
                                                                <div class="row col-5">
                                                                    <p class="fw-bold">{{$question->question}}</p>
                                                                    @foreach($question->answers as $answer)
                                                                        <div class="form-check mb-2">
                                                                            <label class="form-check-label"
                                                                                   for="radioExample1">
                                                                                {{$answer->answer}}

                                                                                <input class="form-check-input"
                                                                                       type="radio" disabled>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div  class="text-end">
                                                                <a href="{{route('surveys.deleteQuestion',['question'=>$question->id])}}" method="delete" class="btn btn-danger" role="button">Elimina</a>
                                                            </div>
                                                        </div>
                                                    @elseif($question->type == 'open-ended')
                                                        <div class="container">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="container text-center mt-3">
                                                                        <div class="col">
                                                                            <p class="fw-bold">{{$question->question}}</p>
                                                                        </div>
                                                                        @if($question->immagine)
                                                                            <div
                                                                                style="width: 100px; height: 100px; overflow: hidden; display: flex; justify-content: center; align-items: center; margin: auto;">
                                                                                <img
                                                                                    src="{{ asset($question->immagine) }}"
                                                                                    alt="Descrizione dell'immagine"
                                                                                    style="max-width: 100%; max-height: 100%; object-fit: cover;">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div  class="text-end">
                                                                <a href="{{route('surveys.deleteQuestion',['question'=>$question->id])}}" method="delete" class="btn btn-danger" role="button">Elimina</a>
                                                            </div>
                                                        </div>
                                                    @elseif($question->type == 'multiple_choice')
                                                        <div class="container">
                                                            <div class="card-body">
                                                                <div class="row col-5">
                                                                    <p class="fw-bold">{{$question->question}}</p>
                                                                    @foreach($question->answers as $answer)
                                                                        <div class="form-check">

                                                                            <input class="form-check-input"
                                                                                   type="checkbox" disabled>

                                                                            <label class="form-check-label"
                                                                                   for="flexCheckDefault">
                                                                                {{$answer->answer}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div  class="text-end">
                                                                <a href="{{route('surveys.deleteQuestion',['question'=>$question->id])}}" method="delete" class="btn btn-danger" role="button">Elimina</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="col text-end">
                    <a class="btn btn-secondary mb-3" href="/" role="button">Salva</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>



