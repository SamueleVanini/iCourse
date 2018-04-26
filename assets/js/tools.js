/**
 * Funzione che inserisce le attività nell'activity-box.
 * @param eventi Array di eventi in json.
*/
function createActivityBox(eventi){
    var intActivty1 = '<h4>I tuoi corsi</h4><ul>';
    var intActivty2 = '<h4>Altri corsi</h4><ul>';
    var activity = '';
    for(i=0; i<eventi.length; i++){
        activity += '<li>' + eventi[i].title + '</li>';
    }//for
    activity += '</ul>';

   document.getElementById('activity-box').innerHTML = intActivty1 + activity;
}//createActivityBox

/**
 * Funzione che inserisce le attività nell'activity-box.
 * @param comunicazioni Array di comunicazioni in json.
*/
function createSocialBox(comunicazioni){
    var intSocial1 = '<h4>Comunicazioni recenti</h4><ul>';
    var intSocial2 = '<h4>Altre comunicazioni</h4><ul>';
    var social = '';
    for(i=0; i<comunicazioni.length; i++){
        social += '<li>' + comunicazioni[i].title + '</li>';
    }//for
    social += '</ul>';

   document.getElementById('social-box').innerHTML = intSocial1 + social;
}//createActivityBox

/**
 * Funzione che mostra o nasconde il form di inserimento eventi.
*/
function showForm(){
    var display = document.getElementById('form-evnt').style.display;
    if(!display || display == "none"){
        document.getElementById('form-evnt').style.display = "block";
    }else{
        document.getElementById('form-evnt').style.display = "none";
    }//if-else
}//showForm

/**
 * Funzione che mostra una porzione di un form dato un valore precedentemente inserito.
*/
function showFine(){
    var select = document.getElementById('ripetizione').value;
    if(select != 0){
        document.getElementById('div-fine-rip').style.display = "block";
    }else{
        document.getElementById('div-fine-rip').style.display = "none";
    }
}//showFine 

function valoreDaId(id){
    return document.getElementById(id).value;
}

/**
 * Funzione che crea un json con i dati della richiesta.
 * @returns json con i dati della richiesta.
 */
function creaFormatoRichiesta(){
    var dati = [];
    
    var oggetto = new Object();
    oggetto.name = 'nomeEvento';
    oggetto.value = valoreDaId('nomeEvento');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'dataInizioEvento';
    oggetto.value = valoreDaId('dataInizioEvento');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'oraInizioEvento';
    oggetto.value = valoreDaId('oraInizioEvento');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'dataFineEvento';
    oggetto.value = valoreDaId('dataFineEvento');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'oraFineEvento';
    oggetto.value = valoreDaId('oraFineEvento');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'ripetizione';
    oggetto.value = valoreDaId('ripetizione');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'fineRipetizione';
    oggetto.value = valoreDaId('fineRipetizione');
    dati.push(oggetto);

    var oggetto = new Object();
    oggetto.name = 'luogo';
    oggetto.value = valoreDaId('luogo');
    dati.push(oggetto);
    
    var oggetto = new Object();
    oggetto.name = 'descr';
    oggetto.value = valoreDaId('descr');
    dati.push(oggetto);
    
    return dati;
}//creaFormatoRichiesta

function sendDatiCorso(){
    dati = creaFormatoRichiesta();
    
    var callback = (err, res)=>{
        if(err){
            console.log("Errore: " + err + "; status: " + res);
        }else{
            console.log("bella");
        }
    }//callback
    
    console.log(dati);
    var richiesta = new Request("/iCourse/src/controller/new_course_controller.php", "POST", dati, callback);
    richiesta.send();
}//sendDatiCorso
