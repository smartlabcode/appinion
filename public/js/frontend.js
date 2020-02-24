function openPresentation(link, idpitanja){
    
    var i = 0;

    location.href='/pitanje/'+link+'/'+i;
}


function newQuestionFunction(value){
    var key = value;
    
    document.getElementById('key-value-id').value=key;

    document.getElementById('new-question-btn-container').classList.add('new-question-btn-container-hide');

    setTimeout(() => {
        document.getElementById('dodaj-pitanje-container').classList.add('dodaj-pitanje-container-show');
        document.getElementsByClassName('question-form')[0].classList.add('question-form-show');
    }, 500);  

}

function undoNewQuestion(){

    document.getElementById('dodaj-pitanje-container').classList.remove('dodaj-pitanje-container-show');
    document.getElementsByClassName('question-form')[0].classList.remove('question-form-show');

    setTimeout(() => {
        document.getElementById('new-question-btn-container').classList.remove('new-question-btn-container-hide');
    }, 500);
    
}



