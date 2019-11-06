window.addEventListener('load', init);
// Initialize
function init(){
    let courseId = document.getElementById('course_id').value;
    var settings = {
        "async": true,
        "processData": true,
        url: "./examController.php",
        method: "POST",
        data: {id : courseId}
    }
    $.ajax(settings).done(function(response) {
        var questions = JSON.parse(response)
        var pos = 0, test, test_status, question, choices, choice, chA, chB, chC, correct = 0;
        function _(x){
            return document.getElementById(x);
        }
        renderQuestion()
        function renderQuestion(){
            test = _('test');
            if(pos>= questions.length){ // If no question to display again
                _('test_status').innerHTML = 'Test completed! Please logout';
                // Set question position to zero
                pos = 0;
                correct = 0;
                return false;
            }
            _('test_status').innerHTML = 'Question' + ' ' + (pos+1) + ' ' + 'of'  + ' ' + questions.length;
            question = questions[pos].question;
            chA = questions[pos].option_A;
            chB = questions[pos].option_B;
            chC = questions[pos].option_C;
            chD = questions[pos].option_D;
            test.innerHTML = "<div class='form-group'><h3 >" + question + "</h3></div>";
            test.innerHTML += "<div class='form-group'><input type='radio' name='choices' value='optionA' class'form-control'>" + " " + chA + "</div>";
            test.innerHTML += "<div class='form-group'><input type='radio' name='choices' value='optionB' class'form-control'>" + " " + chB + "</div>";
            test.innerHTML += "<div class='form-group'><input type='radio' name='choices' value='optionC' class'form-control'>" + " " + chC + "</div>";
            test.innerHTML += "<div class='form-group'><input type='radio' name='choices' value='optionC' class'form-control'>" + " " + chD + "</div>";
            test.innerHTML += "<div class='form-group'><button class='btn btn-primary' id='submit' >Submit Answer</button></div>";
            // Get submit id
            var submit = document.getElementById('submit');
            // Listening to submit event
            submit.addEventListener('click', checkAnswer, true);
        }
        // Check answer
        function checkAnswer(){
            choices = document.getElementsByName('choices');
            for(var i = 0; i < choices.length; i++){
                if(choices[i].checked){
                    choice = choices[i].value;
                }
            }
            if(choice === questions[pos].answer){
                correct++;
            }
            pos++;
            renderQuestion();
        }
    });
    // Callback handler that will be called on failure
    $.ajax(settings).fail(function (response, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            response, textStatus, errorThrown
        );
    });
}