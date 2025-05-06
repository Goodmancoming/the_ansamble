<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>9</title>
   <script>

let questions = [];

function validateInput(question, options, time) {
  let isValid = true;

  document.getElementById("questionError").textContent = "";
  document.getElementById("optionsError").textContent = "";
  document.getElementById("timeError").textContent = "";

  if (question.length < 5) {
    document.getElementById("questionError").textContent =
      "Pertanyaan minimal 5 karakter!";
    isValid = false;
  }

  const optionArray = options.split(",");
  if (optionArray.length !== 4) {
    document.getElementById("optionsError").textContent =
      "Harus ada 4 opsi yang dipisahkan dengan koma!";
    isValid = false;
  }

  if (time < 1) {
    document.getElementById("timeError").textContent = "Waktu minimal 1 menit!";
    isValid = false;
  }

  return isValid;
}

function formatTime(minutes) {
  const mins = Math.floor(minutes);
  const secs = Math.floor((minutes % 1) * 60);
  return `${String(mins).padStart(2, "0")}:${String(secs).padStart(2, "0")}`;
}
function generateQuestion() {
  const question = document.getElementById("question").value.trim();
  const options = document.getElementById("options").value.trim();
  const time = parseInt(document.getElementById("time").value);

  if (!validateInput(question, options, time)) {
    return;
  }

  const newQuestion = {
    id: questions.length + 1,
    question: question,
    options: options.split(","),
    time: time,
  };
  questions.push(newQuestion);

  updateQuestionList();

  document.getElementById("question").value = "";
  document.getElementById("options").value = "";
  document.getElementById("time").value = "4";
}

function updateQuestionList() {
  const questionList = document.getElementById("questionList");
  questionList.innerHTML = "";

  questions.forEach((q, index) => {
    const row = document.createElement("tr");

    const noCell = document.createElement("td");
    noCell.textContent = index + 1;
    row.appendChild(noCell);

    const questionCell = document.createElement("td");
    questionCell.innerHTML = `
                    ${q.question}<br>
                    <div class="radio-group">
                        <input type="radio" name="question${q.id}"> A. ${q.options[0]}
                        <input type="radio" name="question${q.id}"> B. ${q.options[1]}
                        <input type="radio" name="question${q.id}"> C. ${q.options[2]}
                        <input type="radio" name="question${q.id}"> D. ${q.options[3]}
                    </div>
                `;
    row.appendChild(questionCell);

    const timeCell = document.createElement("td");
    timeCell.textContent = formatTime(q.time);
    row.appendChild(timeCell);

    questionList.appendChild(row);
  });
}

function startTimer(questionId) {
  const question = questions.find((q) => q.id === questionId);
  if (!question) return;

  let timeLeft = question.time * 60;

  const timer = setInterval(() => {
    if (timeLeft <= 0) {
      clearInterval(timer);
      alert("Waktu habis!");
      return;
    }

    timeLeft--;
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    const timeString = `${String(minutes).padStart(2, "0")}:${String(
      seconds
    ).padStart(2, "0")}`;

    // update tampilan timer (opsional ya ges ya)
    const timeElement = document.querySelector(`#time${questionId}`);
    if (timeElement) {
      timeElement.textContent = timeString;
    }
  }, 1000);
}
   </script>
   <style>
    *{
        background-color:black;
        color:white;
    }
    div{
        padding:1rex;
        border:1px white solid;
    }
   </style>
  </head>
  <body>
    <h2>Exam Generator</h2>

    <div class="form-group">
      <label>Question:</label>
      <input type="text" id="question" placeholder="Masukkan pertanyaan" />
      <div id="questionError" class="error"></div>
    </div>

    <div class="form-group">
      <label>Options (pisahkan dengan koma):</label>
      <input type="text" id="options" placeholder="Contoh: CSS,JS,CSJ,HTML" />
      <div id="optionsError" class="error"></div>
    </div>

    <div class="form-group">
      <label>Time (menit):</label>
      <input type="number" id="time" min="1" value="4" />
      <div id="timeError" class="error"></div>
    </div>

    <button onclick="generateQuestion()">Generate</button>

    <table id="questionTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Question</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody id="questionList">
        
      </tbody>
    </table>
  </body>
</html>