(function() {
    // Functions
    function buildSlides() {
        // variable to store the HTML output
        const output = [];

        // for each question...
        myQuestions.forEach(
            (currentQuestion, questionNumber) => {

                // variable to store the list of possible answers
                const answers = [];

                // and for each available answer...
                for (letter in currentQuestion.answers) {
                    if (letter == '0') {
                        answers.push(
                            `${currentQuestion.answers[letter]}`
                        );
                    } else {
                        // ...add an HTML radio button
                        answers.push(
                            `<label>
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
                        );
                    }
                }

                // add this question and its answers to the output
                output.push(
                    `<div class="slide">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
                );
            }
        );

        // finally combine our output list into one string of HTML and put it on the page
        slidesContainer.innerHTML = output.join('');
    }

    function showResults() {

        // gather answer containers from our quiz
        const answerContainers = slidesContainer.querySelectorAll('.answers');

        // keep track of user's answers
        let numCorrect = 0;

        // for each question...
        myQuestions.forEach((currentQuestion, questionNumber) => {

            // find selected answer
            const answerContainer = answerContainers[questionNumber];
            const selector = `input[name=question${questionNumber}]:checked`;
            const userAnswer = (answerContainer.querySelector(selector) || {}).value;

            // if answer is correct
            if (userAnswer === currentQuestion.correctAnswer || currentQuestion.correctAnswer == 0) {
                // add to the number of correct answers
                numCorrect++;

                // color the answers green
                answerContainers[questionNumber].style.color = 'lightgreen';
            }
            // if answer is wrong or blank
            else {
                // color the answers red
                answerContainers[questionNumber].style.color = 'red';
            }
        });

        // show number of correct answers out of total
        resultsContainer.innerHTML = `${numCorrect} out of ${myQuestions.length} ${val}`;

    }

    function showSlide(n) {
        slides[currentSlide].classList.remove('active-slide');
        slides[n].classList.add('active-slide');
        currentSlide = n;
        if (currentSlide === 0) {
            previousButton.style.display = 'none';
        } else {
            previousButton.style.display = 'inline-block';
        }
        if (currentSlide === slides.length - 1) {
            nextButton.style.display = 'none';
            submitButton.style.display = 'inline-block';
        } else {
            nextButton.style.display = 'inline-block';
            submitButton.style.display = 'none';
        }
        if (currentSlide - 1 >= 0 && myQuestions[currentSlide - 1].correctAnswer == '0') {
            document.getElementById("previous").innerHTML = "<<";
        } else {
            document.getElementById("previous").innerHTML = "Previous Question";
        }
        if (myQuestions[currentSlide].correctAnswer == '0') {
            if (currentSlide == 1){
                document.getElementById("next").innerHTML = "I have read and understand the explanations. </br> I voluntarily consent to participate in this study.";
                document.getElementById("previous").innerHTML = "I do not consent. </br> I do not want to participate in this study."
            }
            else{
            document.getElementById("next").innerHTML = ">>";
            }
        }
    }

    function showNextSlide() {
        showSlide(currentSlide + 1);
    }

    function showPreviousSlide() {
		if(currentSlide == 1) {
			window.location.href = "thanks.php";
		}
		else{
			showSlide(currentSlide - 1);
		}
    }

    // Variables
    const slidesContainer = document.getElementById('slides');
    const resultsContainer = document.getElementById('results');
    const submitButton = document.getElementById('submit');
    const myQuestions = [{
            question: "Welcome!",
            answers: {
                0: "Thank you for taking interest in this study! We invite you to participate in a research study on language production and comprehension. In this survey you will be asked to judge whether a sentence can be correctly asserted in a given scenario. </br></br> Completing the survey will take you approximately 12 minutes.  Please complete this survey in one go. In other words, please only participate in this survey if you have 10 to 15 minutes that you can dedicate to it. </br></br>If you would like to contact the Principal Investigator in the study to discuss this research, please e-mail k.schulz@uva.nl."
            },
            correctAnswer: "0"
        },
        {
            question: "Consent form",
            answers: {
                0: "I understand that all data will be kept confidential by the researcher. My personal information will not be stored with the data. I am free to withdraw at any time without giving a reason. I consent to the publication of study results as long as the information is anonymous so that no identification of participants can be made.",
            },
            correctAnswer: "0"
        },
        {
            question: "Prolific",
            answers: {
                0: "We received your prolific ID",
            },
            correctAnswer: "0"
        }
    ];

    // Kick things off
    buildSlides();

    // Pagination
    const previousButton = document.getElementById("previous");
    const nextButton = document.getElementById("next");
    const slides = document.querySelectorAll(".slide");
    let currentSlide = 0;

    // Show the first slide
    showSlide(currentSlide);

    // Event listeners
    submitButton.addEventListener('click', showResults);
    previousButton.addEventListener("click", showPreviousSlide);
    nextButton.addEventListener("click", showNextSlide);
})();
