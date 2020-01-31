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

function pokreniprezentaciju(){
    console.log('karina');
}

function changeQuestion(id){
    var btn = document.getElementById('pitanje-btn-' + id);
    var pitanje = document.getElementById('pitanje-' + id);
    var odg1 = document.getElementById('odgovor1-' + id);
    var odg2 = document.getElementById('odgovor2-' + id);
    if(document.getElementById('odgovor3-' + id) != null)
        var odg3 = document.getElementById('odgovor3-' + id);
    if(document.getElementById('odgovor4-' + id) != null)
        var odg4 = document.getElementById('odgovor4-' + id);

    if(btn.innerHTML == 'Promijeni'){
        btn.innerHTML = 'Spasi';
        pitanje.setAttribute('contenteditable', 'true');
        odg1.setAttribute('contenteditable', 'true');
        odg2.setAttribute('contenteditable', 'true');
        if(document.getElementById('odgovor3-' + id) != null)
            odg3.setAttribute('contenteditable', 'true');
        if(document.getElementById('odgovor4-' + id) != null)
            odg4.setAttribute('contenteditable', 'true');
    }
    else{
        btn.innerHTML = 'Promijeni';
        pitanje.setAttribute('contenteditable', 'false');
        odg1.setAttribute('contenteditable', 'false');
        odg2.setAttribute('contenteditable', 'false');
        if(document.getElementById('odgovor3-' + id) != null)
            odg3.setAttribute('contenteditable', 'false');
        if(document.getElementById('odgovor4-' + id) != null)
            odg4.setAttribute('contenteditable', 'false');
        if(odg3.innerHTML != '  ' && odg4.innerHTML != '  '){
            console.log('4');
            $.ajax({
                type:'POST',
                url:'../../questioneditfour/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML+'/'+odg4.innerHTML,
                data:{'_token':'{{ csrf_token() }}'},
                success: function(data) {
                    $(pitanje).text(data.msg);
                }
            });
        } else if(odg3.innerHTML != '  ' && odg4.innerHTML == '  '){
            console.log('3');
            $.ajax({
                type:'POST',
                url:'../../questioneditthree/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML+'/'+odg3.innerHTML,
                data:{'_token':'{{ csrf_token() }}'},
                success: function(data) {
                    $(pitanje).text(data.msg);
                }
            });
        } else if(odg3.innerHTML == '  ' && odg4.innerHTML == '  '){
            console.log('4');
            
            $.ajax({
                type:'GET',
                url:'../../questionedittwo/'+id+'/'+pitanje.innerHTML+'/'+odg1.innerHTML+'/'+odg2.innerHTML,
                data:{'_token':'{{ csrf_token() }}'},
                success: function(data) {
                    $(pitanje).text(data.msg);
                }
            });
        }
        
    }
}