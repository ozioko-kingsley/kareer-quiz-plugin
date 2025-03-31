document.addEventListener('DOMContentLoaded', function() {
    // Get all the quiz questions and options
    const quizContainer = document.querySelector('#career-quiz');
    const questions = quizContainer.querySelectorAll('.quiz-question');
    const nextBtns = quizContainer.querySelectorAll('.next-btn');
    const submitBtn = quizContainer.querySelector('.submit-btn');
    const resultContainer = quizContainer.querySelector('.quiz-result');

    let currentQuestionIndex = 0;
    let answers = [];

    // Function to show the next question
    function showNextQuestion() {
        if (currentQuestionIndex < questions.length - 1) {
            questions[currentQuestionIndex].classList.add('hidden'); // Hide current question
            currentQuestionIndex++;
            questions[currentQuestionIndex].classList.remove('hidden'); // Show next question
        } else {
            showResults();
        }
    }

    // Function to handle user answer selection
    function handleAnswerSelection(questionIndex) {
        const selectedOption = questions[questionIndex].querySelector('input[type="radio"]:checked');
        if (selectedOption) {
            answers[questionIndex] = selectedOption.value;
        } else {
            answers[questionIndex] = null; // No answer selected
        }
    }

    // Function to display the quiz results
    function showResults() {
        quizContainer.classList.add('hidden');
        resultContainer.classList.remove('hidden');

        // You can implement a scoring system or analysis based on answers
        let resultText = 'Based on your responses, we recommend the following career paths:';
        if (answers.includes('Tech')) {
            resultText += '<br>Software Developer, Data Scientist, IT Specialist';
        } else if (answers.includes('Health')) {
            resultText += '<br>Doctor, Nurse, Medical Researcher';
        } else {
            resultText += '<br>Explore various career options!';
        }

        resultContainer.innerHTML = resultText;
    }

    // Event listeners for next buttons
    nextBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            handleAnswerSelection(index); // Save the user's answer
            showNextQuestion();
        });
    });

    // Event listener for submit button
    submitBtn.addEventListener('click', function() {
        handleAnswerSelection(currentQuestionIndex); // Save last answer
        showResults();
    });

    // Initial display of the first question
    questions[currentQuestionIndex].classList.remove('hidden');
});
