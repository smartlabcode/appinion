function openPresentation(link, idpitanja){
    
    var i = 0;

    location.href='/pitanje/'+link+'/'+i;
}


function newQuestionFunction(value){
    var key = value;
    
    var _allQuestions = document.getElementsByClassName('new-question-btn-class');
    for(i=0; i<_allQuestions.length; i++){
        _allQuestions[i].style.display = "block";
    }
    var _btnVar = document.getElementById(key+'-new-question-btn');
    _btnVar.style.display = "none";
    var _pitanjeVar = document.getElementById('pitanje-container');
    _pitanjeVar.style.display = "block";

    document.getElementById('key-value-id').setAttribute('value', key);
    document.getElementById('dom-id-prezentacije').innerHTML = key;
}

function prikazipitanja(){
    if(document.getElementById('show-questions-btn').innerHTML == 'Prikazi pitanja'){
        document.getElementById('show-questions-btn').innerHTML = 'Sakrij Pitanja';
        document.getElementById('table-body').style.display = "table-row-group";
    }
    else{
        document.getElementById('show-questions-btn').innerHTML = 'Prikazi pitanja';
        document.getElementById('table-body').style.display = "none";
    }
}



    /*
    if(odg3.innerHTML != '  ' && odg4.innerHTML != '  '){
        $.ajax({
            type:'POST',
            url:'../questioneditfour/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML+'/'+odg4.innerHTML,
            data:{'_token':'{{ csrf_token() }}'},
            success: function(data) {
                $(pitanje).text(data.msg);
            }
        });
    } else if(odg3.innerHTML != '  ' && odg4.innerHTML == '  '){
        $.ajax({
            type:'POST',
            url:'../../questioneditthree/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML,
            data:{'_token':'{{ csrf_token() }}'},
            success: function(data) {
                $(pitanje).text(data.msg);
            }
        });
    } else if(odg3.innerHTML == '  ' && odg4.innerHTML == '  '){
        console.log('../questionedittwo/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML);
        $.ajax({
            type:'GET',
            url:'../questionedittwo/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML,
            data:{'_token':'{{ csrf_token() }}'},
            success: function(data) {
                $(pitanje).text(data.msg);
            }
        });
        
    }*/
    
