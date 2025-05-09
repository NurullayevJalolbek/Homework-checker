@extends('layouts.app')

@section('title')
Homework
@endsection

@section('activePage')
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb p-2 rounded text-white" style="background-color: #1E1E2E;">
        <li class="breadcrumb-item">
            <a href="{{ route('students.homework.index') }}" class="text-white text-decoration-none">
                <i class="fas fa-home"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            <a href="{{route('admin.homework-questions.index')}}" class="text-white text-decoration-none">
                Questions
            </a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
            <a href="{{ url()->current() }}" class="text-white text-decoration-none">
                Create
            </a>
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('admin.homework-questions.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="form-title"><span>Homework Question create</span></h5>
                    <a href="{{route('admin.homework-questions.index')}}" class="btn btn-primary" style="height: 40px;">Orqaga</a>
                </div>
                <!-- Homework Dropdown -->
                <div class="mb-3">
                    <label for="homeworkSelect" class="form-label">Homework Conditions</label>
                    <select class="form-select" id="homeworkSelect" name="homework_id">
                        <option selected disabled>Homework</option>
                        @foreach ($homeworks as $homework)
                        @if ($homework['due_date'] >= now())
                        <option value="{{ $homework['id'] }}">
                            {{ $homework['exercise_id'] }} | {{ $homework['task_condition'] }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('homework_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Questions -->
                <div class="mb-3">
                    <label for="questionsTextarea" class="form-label">Questions</label>
                    <textarea id="questionsTextarea" name="questions" class="form-control" rows="3"></textarea>
                    @error('questions')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correct Answers -->
                <div class="mb-3">
                    <label for="correctAnswersTextarea" class="form-label">Correct Answers</label>
                    <textarea id="correctAnswersTextarea" name="correct_answers" class="form-control" rows="3"></textarea>
                    <div id="predictions" class="mt-2"></div>
                    <button type="button" id="generateCorrectAnswers" class="btn btn-primary mt-2">Generate Correct Answers</button>
                </div>

                <!-- Tip -->
                <div class="mb-3">
                    <label for="tipTextarea" class="form-label">Tip (Maslahat)</label>
                    <textarea id="tipTextarea" name="tip" class="form-control" rows="4" placeholder='Masalan: {"uz":"Yaxshi o‘ylab ko‘ring", "en":"Think carefully"}'></textarea>
                    @error('tip')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Answer Template -->
                <div class="mb-3">
                    <label for="answerTemplateTextarea" class="form-label">Answer Template (enter one per line)</label>
                    <textarea id="answerTemplateTextarea" name="answer_template" class="form-control" rows="5"></textarea>
                    @error('answer_template')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12" style="margin-bottom: 10px;">
                    <label class="control-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="imageUpload" accept="image/*">
                    <img id="pastedImagePreview" src="" alt="Pasted Image"
                        style="max-width: 100%; margin-top: 10px; display: none;">
                    <button id="applyImageText" class="btn btn-primary"
                        style="margin-top: 10px; display: none;">Apply</button>
                </div>



                <!-- Form Footer -->
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-warning">Назад</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        uploadImage(event.target.files[0]);
    });

    document.addEventListener("paste", function(event) {
        let items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (let item of items) {
            if (item.kind === 'file' && item.type.startsWith('image/')) {
                let blob = item.getAsFile();
                let fileInput = document.getElementById("imageUpload");

                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(blob);
                fileInput.files = dataTransfer.files;

                let reader = new FileReader();
                reader.onload = function(e) {
                    let imgPreview = document.getElementById("pastedImagePreview");
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = "block";
                    document.getElementById("applyImageText").style.display = "block";
                };
                reader.readAsDataURL(blob);

                event.preventDefault();
            }
        }
    });

    document.getElementById("applyImageText").addEventListener("click", function() {
        event.preventDefault();

        let fileInput = document.getElementById("imageUpload");
        if (fileInput.files.length === 0) {
            alert("Iltimos, rasm yuklang yoki paste qiling.");
            return;
        }
        uploadImage(fileInput.files[0]);
    });

    function getLastQuestionNumber(text) {
        let lines = text.trim().split("\n").reverse();
        for (let line of lines) {
            let match = line.match(/^(\d+)[\.\)\-]/);
            if (match) {
                return parseInt(match[1]);
            }
        }
        return 0;
    }

    function uploadImage(file) {
        let questionsTextarea = document.getElementById("questionsTextarea");
        let currentText = questionsTextarea.value;
        let lastNumber = getLastQuestionNumber(currentText);

        let formData = new FormData();
        formData.append('image', file);
        formData.append('last_number', lastNumber);

        fetch('/admin/homework-questions/process/image', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data);
                    questionsTextarea.value = currentText ? currentText + "\n" + data.text : data.text;
                } else {
                    alert('Error processing image');
                }
            })
            .catch(error => console.error('Error:', error));
    }



    document.getElementById('generateCorrectAnswers').addEventListener('click', function(event) {
        event.preventDefault();

        let homeworkSelect = document.getElementById('homeworkSelect');
        if (!homeworkSelect) {
            alert("Homework select elementi topilmadi!");
            return;
        }
        let homeworkCondition = homeworkSelect.value;
        let questions = document.getElementById('questionsTextarea').value;


        if (!homeworkCondition || !questions) {
            alert("Iltimos, Homework Conditions va Questions maydonlarini to'ldiring!");
            return;
        }

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let url = "/admin/homework-questions/generate-correct-answers";

        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    homework_id: homeworkCondition,
                    questions: questions
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Server xatosi!");
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('correctAnswersTextarea').value = data.correct_answers;

                let tipTextarea = document.querySelector('textarea[name="tip"]');
                tipTextarea.value = data.tip;

                let answerTemplateTextarea = document.querySelector('textarea[name="answer_template"]');
                answerTemplateTextarea.value = data.answer_template;
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Xatolik yuz berdi: " + error.message);
            });
    });



    document.getElementById("imageUpload").addEventListener("change", function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var imgPreview = document.getElementById("pastedImagePreview");
            imgPreview.style.display = "block";
            imgPreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>

@endsection