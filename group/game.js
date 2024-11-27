// 前端 JavaScript：題目數據及功能
const questions = [
    { id: 1, text: "您喜歡咖啡嗎？" },
    { id: 2, text: "您喜歡茶嗎？" },
    { id: 3, text: "您常喝含糖飲料嗎？" }
];

let currentQuestionIndex = 0;
const userAnswers = {};

// 更新問題畫面
function updateQuestion() {
    const questionText = document.querySelector(".question-container h2");
    const options = document.querySelectorAll(".options input");
    questionText.textContent = `問題 ${questions[currentQuestionIndex].id}: ${questions[currentQuestionIndex].text}`;

    // 清空或回復使用者的選擇
    options.forEach(option => {
        option.checked = userAnswers[questions[currentQuestionIndex].id] == option.value;
    });
}

// 儲存選擇
function saveAnswer(value) {
    const questionId = questions[currentQuestionIndex].id;
    userAnswers[questionId] = value;
}

// 下一題
document.getElementById("next").addEventListener("click", () => {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        updateQuestion();
    } else {
        alert("您已完成所有題目！");
        submitAnswers();
    }
});

// 上一題
document.getElementById("prev").addEventListener("click", () => {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        updateQuestion();
    }
});

// 選項變化監聽
document.querySelectorAll(".options input").forEach(option => {
    option.addEventListener("change", event => {
        saveAnswer(event.target.value);
    });
});

// 提交測驗結果
function submitAnswers() {
    fetch("/submit-answers", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(userAnswers)
    })
    .then(response => response.json())
    .then(data => {
        alert(`測驗完成！結果已儲存，回應：${data.message}`);
    })
    .catch(error => {
        console.error("提交失敗:", error);
    });
}

// 初始化頁面
updateQuestion();