<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .relative {
            position: relative;
        }

        .remove-icon {
            position: absolute;
            top: 50%;
            right: 10px; /* o qualsiasi margine desiderato */
            transform: translateY(-50%);
            cursor: pointer;
        }

        .colored-bar {
            background-color: #8f00ff;
            height: 15px;
            margin-left: -16px;
            margin-right: -16px;
            margin-top: -7.8px;
            margin-bottom: 10px;
            clip-path: polygon(0 0, 100% 0, 100% 50%, 0% 50%);
        }

        .colored-bar-question {
            background-color: #4285f4;
            height: 5px;
            margin-left: 9px;
            margin-right: 9px;
            margin-top: -7.8px;
            margin-bottom: 10px;
        }

        .mio-colore-personalizzato {
            background-color: #e6e6fa;
        }
        .colore-bottone {
            background-color: #a84bff;
        }


    </style>
</head>
<body>
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card mio-colore-personalizzato">
            <div class="container">
                <div class="card-header mt-4 rounded-3 bg-white">
                    <div class="colored-bar rounded-5"></div>
                    <span>Domanda</span>
                    <div class="float-end" id="punti">
                        <label class="ml-auto">Points: 5</label>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col">
                        <button name="type" id="type" class="btn btn-dark mt-3 ms-3" value="single_choice" onclick="toggleAnswerFields('single_choice')" > <input type="hidden" name="type" value="single_choice"><i class="bi bi-list-ul"></i></button>
                    </div>
                    <div class="col">
                        <button name="type" id="type" class="btn btn-dark mt-3 ms-3" value="open-ended" onclick="toggleAnswerFields('open-ended')"><i class="bi bi-alphabet"></i></button>
                    </div>
                    <div class="col">
                        <button name="type" id="type"  class="btn btn-dark mt-3 ms-3" value="linear_scale" onclick="toggleAnswerFields('linear_scale')"><i class="bi bi-three-dots"></i></button>
                    </div>
                    <div class="col">
                        <button name="type" id="type" class="btn btn-dark mt-3 ms-3" value="multiple_choice" onclick="toggleAnswerFields('multiple_choice')"><i class="bi bi-ui-checks"></i></button>
                    </div>
                </div>
                -->

                <form action="{{route('surveys.storeQuestion',['survey'=>$survey->id,'module'=>$module->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mx-auto max-w-md text-center mb-4 mt-4">

                        <select name="type" class="form-select" id="type" onchange="toggleAnswerFields()">
                            <option value="single_choice">Scelta singola</option>
                            <option value="open-ended">Risposta Aperta</option>
                            <option value="linear_scale">Scala Lineare</option>
                            <option value="multiple_choice">Scelta multipla</option>
                        </select>



                        <div class="mx-auto max-w-md text-center mb-4 mt-4">
                            <label for="question" class="block text-stone-100">Domanda<span
                                    class="font-bold text-base text-red-600">*</span></label><br>
                            <input placeholder="Domanda" type="text" name="question"
                                   class="form-control mt-2"
                                   id="question" required>
                        </div>



                        <div id="linear_scale" class="mx-auto max-w-md text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="form-group text-center">
                                    <label for="from">Da:</label>
                                    <select class="form-select form-select-sm" name="from" id="type1">
                                        <option>0</option>
                                    </select>
                                </div>

                                <div class="form-group text-center ms-2">
                                    <label for="to">A:</label>
                                    <select class="form-select form-select-sm" name="to" id="type2">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select>
                                </div>
                            </div>


                            <input placeholder="Etichetta" type="text" name="fromAnswer"
                                   class="form-control mt-2"
                                   id="etichetta1"><br>
                            <input placeholder="Etichetta" type="text" name="toAnswer"
                                   class="form-control"
                                   id="etichetta2" >
                        </div>

                        <div id="image" class="mx-auto max-w-md text-center mb-4 mt-4">
                            <label for="image"></label>
                            <input type="file" name="image" accept="image/*">
                        </div>

                        <div id="risposta_multipla">
                            <div id="dynamicFields"></div>
                            <button type="button" class="btn colore-bottone" onclick="addQuestion()"><i class="bi bi-patch-plus-fill"></i></button>
                        </div>


                    </div>
                    <button type="submit" class="btn colore-bottone float-end mt-auto mb-2"><strong>Salva</strong></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>


<script>
    function toggleAnswerFields() {
        var questionType = document.getElementById('type').value;
        var answerFields = document.querySelectorAll('[name^="answers["]');
        var image = document.getElementById('image')
        var risposta_multipla = document.getElementById('risposta_multipla')
        var scala_lineare = document.getElementById('linear_scale')
        var punti = document.getElementById('punti')
        console.log(questionType);


        if (questionType === 'multiple_choice' || questionType === 'single_choice') {
            image.style.display = "none"
            scala_lineare.style.display = "none"
            risposta_multipla.style.display = 'block'
            if(questionType === 'single_choice'){
                punti.style.display = "block"
            }else if(questionType === 'multiple_choice'){
                punti.style.display = "none"
            }
        } else if (questionType === 'open-ended') {
            risposta_multipla.style.display = "none"
            image.style.display = "block"
            punti.style.display = "none"
            scala_lineare.style.display = "none"
        } else if (questionType === 'linear_scale') {
            scala_lineare.style.display = "block"
            image.style.display = "none"
            risposta_multipla.style.display = 'none'
            punti.style.display = "none"
        } else {
            image.style.display = "block";
        }

    }

    var counter = 0;
    function addQuestion() {
        var questionType = document.getElementById('type').value;
        var dynamicFields = document.getElementById('dynamicFields');
        var newQuestion = document.createElement('div');
        newQuestion.className = 'mb-4';

        if(questionType === 'single_choice'){
            newQuestion.innerHTML =
                '<div class="relative d-flex">' +
                '<input id="answer" placeholder="Opzione" type="text" name="answers['+counter+'][answer]" class="form-control">' +
                '<span class="remove-icon" onclick="removeQuestion(this)">X</span>' +
                '</div>' +
                '<div class="d-flex">' +
                '<select name="answers['+counter+'][value]" class="form-select ml-2">' +
                '<option value="1">1</option>' +
                '<option value="2">2</option>' +
                '<option value="3">3</option>' +
                '<option value="4">4</option>' +
                '<option value="5">5</option>' +
                '</select>' +
                '<select name="answers['+counter+'][next_module_id]" class="form-select ml-2">' +
                '<option value="">Modulo successivo</option>' +
                '@foreach($survey->modules as $modules)' +
                '<option value="{{ $modules->id }}">{{ $modules->title }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>';


        }else if(questionType === 'multiple_choice'){
            newQuestion.innerHTML =
                '<div class="relative">' +
                '<input id="answer" placeholder="Opzione" type="text" name="answers['+counter+'][answer]" class="form-control">' +
                '<span class="remove-icon" onclick="removeQuestion(this)">X</span>' +
                '</div>';



        }






        dynamicFields.appendChild(newQuestion);

        counter++
    }

    function removeQuestion(buttonElement) {
        console.log("Question removed!");
        var questionContainer = buttonElement.parentNode.parentNode;


        var dynamicFields = document.getElementById('dynamicFields');


        dynamicFields.removeChild(questionContainer);
    }

    function show(){
        var elements = document.querySelectorAll('[id="aggancia"]');

        // Itera su tutti gli elementi e nascondili
        elements.forEach(function(element) {
            if(element.style.display == 'block'){
                element.style.display = 'none'
            }else{
                element.style.display = 'block'
            }
        });





    }

    window.onload = function () {
        toggleAnswerFields()
        /*
        var image = document.getElementById('image')
        var risposta_multipla = document.getElementById('risposta_multipla')
        var scala_lineare = document.getElementById('linear_scale')
        var punti = document.getElementById('punti')

        scala_lineare.style.display = "none"
        image.style.display = "none"
        risposta_multipla.style.display = 'none'
        punti.style.display = "none"

         */


    };
</script>
