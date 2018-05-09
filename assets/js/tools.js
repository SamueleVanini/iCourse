/**
 * Funzione che inserisce le attività nell'activity-box.
 * @param eventi Array di eventi in json.
*/
function createActivityBox(eventi){
    var intActivty1 = '<h4>I tuoi corsi</h4><ul>';
    var activity = '';
    var corsi = [];
    for(var i=0; i<eventi.length; i++){
        if(!isPresente(eventi[i].id, corsi)){
            var corso = new Object();
            corso.id = eventi[i].id;
            corso.title = eventi[i].title;
            corsi.push(corso);
        }//if
    }//for
    for(var i=0; i<corsi.length; i++){
        activity += '<li><a href="activity.php?activity_id=' + corsi[i]['id'] + '">' + corsi[i]['title'] + '</a></li>';
    }
    activity += '</ul>';
    
    document.getElementById('activity-box').innerHTML = "";
    document.getElementById('activity-box').innerHTML = intActivty1 + activity;
}//createActivityBox

function isPresente(elem, arr){
    for(var i=0; i<arr.length; i++){
        console.log(elem);
        if(arr[i].id == elem){
            return true;
        }
    }
    return false;
}//controllaPresenza

/**
 * Funzione che inserisce le attività nella social-box.
 * @param comunicazioni Array di comunicazioni in json.
*/
function createSocialBox(comunicazioni){
    var intSocial1 = '<h4>Comunicazioni recenti</h4><ul>';
    var intSocial2 = '<h4>Altre comunicazioni</h4><ul>';
    var social = '';
    for(i=0; i<comunicazioni.length; i++){
        social += '<li><a href="communication.php?communication_id=' + comunicazioni[i].id + '">' + comunicazioni[i].title + '</a></li>';
    }//for
    social += '</ul>';
    document.getElementById('social-box').innerHTML = intSocial1 + social;
}//createSocialBox

/**
 * Funzione che crea il select nel form di aggiunta comunicazione.
 * @param eventiGestiti Array di eventi gestiti in json.
*/
function createSelectFormComunicazione(eventiGestiti){
    select = document.getElementById('selezionaCorso');
    for(i=0; i<eventiGestiti.length; i++){
        var opt = document.createElement('option');
        opt.value = eventiGestiti[i].IdEvento;
        opt.innerHTML = eventiGestiti[i].Nome;
        select.appendChild(opt);
    }
}//createSelectFormComunicazione

/**
 * Funzione che inserisce le attività nella personal-data-view.
 * @param dati Array di dati in json.
*/
function createViewPersonalData(dati){

    var data = "";
    for(i=0; i<dati.length; i++){
        data += 'Username: ' + '<i>' + dati[i].username + '</i><br>';
        data += 'Nome: ' + '<i>' + dati[i].name + '</i><br>';
        data += 'Cognome: ' + '<i>' + dati[i].surname + '</i><br>';
        data += 'Data di Nascita: ' + '<i>' + dati[i].bornDate + '</i><br>';
        if(dati[i].classYear != null)
            data += 'Classe: ' + '<i>' + dati[i].classYear + dati[i].classCourse + dati[i].classSection + '</i><br>';
        data += 'Matricola: ' + '<i>' + dati[i].studentId + '</i><br>';
        data += 'Mail: ' + '<i>' + dati[i].mail + '</i><br>';
        data += 'Telefono: ' + '<i>' + dati[i].phone + '</i><br>';
    }//for

   document.getElementById('personal-data-view').innerHTML = data;
}//createSocialBox

/**
 * Funzione che compila la pagina delle activity
 * @param informazioni oggetto json con le informazioni dell'activiy
*/
function createActivityPage(informazioni){
    if(informazioni[0]["ImmAnteprima"]){
        document.getElementById('activity_image').src="data:image/jpeg;base64,"+informazioni[0]["ImmAnteprima"];
    }
    document.getElementById('title').innerHTML = informazioni[0].NomeCorso;
    document.getElementById('activity_description').innerHTML = informazioni[0].Descrizione;
    var testo=""; //stampa momenti dell'activity
    for(var i=0;i<informazioni[1].length;i++)
        testo+="<a class='list-group-item list-group-item-action'>Luogo: "+informazioni[1][i].Luogo+"; Data: "+informazioni[1][i].Data+"; Orario: "+informazioni[1][i].OraInizio+" - "+informazioni[1][i].OraFine+"</a>";
    document.getElementById('activity_moments').innerHTML = testo;
    var testo="Insegnanti responsabili del corso:<ul>"; //stampa insegnanti responsabili dell'activity
    for(var i=0;i<informazioni[2].length;i++)
        testo+="<li>"+informazioni[2][i].Nome+" "+informazioni[2][i].Cognome+"</li>";
    testo+="</ul>";
    document.getElementById('activity_spec').innerHTML = testo;
    if(informazioni[3].length>0){
        testo='<table class="table table-hover" id="tabellaFile"><thead><tr><th scope="col">#</th><th scope="col">Nome file</th><th scope="col">Data aggiunta</th></tr></thead>';
        for(var i=0;i<informazioni[3].length;i++)
            testo+="<tr><th>"+(i+1)+"</th><td>"+informazioni[3][i].NomeMateriale+"</td><td>"+informazioni[3][i].DataAggiunta+"</td></tr>";
        document.getElementById('divTabellaFile').innerHTML = testo + '</table>';
    }else{
        document.getElementById('materiali').style.display= "none";
    }
}//createActivityPage

/**
 * Funzione che compila la pagina della Comunicazione
 * @param informazioni oggetto json con le informazioni della comunicazione
*/
function createCommunicationPage(informazioni){
    if(informazioni.length!=0){
        document.getElementById("communicationTitle").innerHTML+=": "+informazioni[0].Titolo;
        document.getElementById("communicationCode").innerHTML+=": "+informazioni[0].IdComunicazione;
        document.getElementById("communicationTeacher").innerHTML+=informazioni[0].Username;
        document.getElementById("communicationCourse").innerHTML+=informazioni[0].Nome;
        document.getElementById("communicationDescription").innerHTML=informazioni[0].Testo;
        document.getElementById("communicationDate").innerHTML+=informazioni[0].Data;
        if(informazioni[0]["NomeAllegato"]){
            var allegati="";
            for(i=0;i<informazioni.length;i++)
                allegati+='<tr><th>'+(i+1)+'</th><td>'+informazioni[i].NomeAllegato+'</td><td>'+informazioni[i].DataAggiunta+'</td><td><button type="submit" class="btn btn-primary btn-accedi btn-download">Download</button></td></tr>';
            document.getElementById("tabellaAllegati").innerHTML=allegati;
        } else
            document.getElementById("Allegati").innerHTML="";
    } else {
        document.getElementById("communicationBody").innerHTML="";
        showMSG(0);
        setInterval(()=>{window.location.href = "home.php";}, 5000);
    } //if-else
} //createCommunicationPage


/** showButtonCorsi
 * Funzione che aggiunge alla box dei corsi un bottone per ggiungere un nuovo corso o una nuova comunicazione
*/
function showButtonCorsi(){
    document.getElementById("bannerBoxCorsi").innerHTML+='<button id="btn-event"><svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg></button>';
} //showButtonsCorsiComunicazioni

/** showButtonComunicazioni
 * Funzione che aggiunge alla box delle comunicazioni un bottone per ggiungere un nuovo corso o una nuova comunicazione
*/
function showButtonComunicazioni(){
    document.getElementById("bannerBoxComunicazioni").innerHTML+='<button id="btn-communication"><svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg></button>';
} //showButtonComunicazioni

/** showButtonAggiungiStudenti
 * Funzione che aggiunge nella pagina activity del professore il tasto per la gestion degli utenti del Corso
*/
function showButtonAggiungiStudenti(){
    document.getElementById("mainDiv").innerHTML+='<button type="button" class="btn btn-primary btn-lg btn-dark float-left creazione-corso" id="btn-utenti">Gestione utenti</button>';
} //showButtonAggiungiStudenti

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
 * Funzione che crea un json con i dati della richiesta per la creazione di un corso.
 * @returns json con i dati della richiesta.
 */
function creaFormatoRichiestaCorso(){
    var dati = [];
    if(valoreDaId('nomeEvento') && valoreDaId('dataInizioEvento') && valoreDaId('oraInizioEvento') && valoreDaId('dataFineEvento') && valoreDaId('oraFineEvento') && valoreDaId('luogo') && valoreDaId('descr')){
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
    }else{
        dati = null;
    }
    return dati;
}//creaFormatoRichiestaCorso

function sendDatiCorso(){
    dati = creaFormatoRichiestaCorso();

    var callback = (err, res)=>{
        if(err){
            console.log("Errore: " + err + "; status: " + res);
            showMSG(0);
        }else{
            console.log("bella");
            if(res){
                showMSG(1);
                resetFormEventi();
                loadBox();
            }else{
                showMSG(0);
            }
        }
    }//callback

    console.log(dati);

    if(dati != null){
        var richiesta = new Request("/iCourse/src/controller/new_event_controller.php", "POST", dati, callback);
        richiesta.send();
    }else{
        showMSG(0);
    }
}//sendDatiCorso

/**
 * Funzione che crea un json con i dati della richiesta per la creazione di una comunicazione
 * @returns json con i dati della richiesta.
 */
function creaFormatoRichiestaComunicazione(){
    var dati = [];
    if(valoreDaId('selezionaCorso') && valoreDaId('nomeComunicazione') && valoreDaId('testoComunicazione')){
        var oggetto = new Object();
        oggetto.name = 'selezionaCorso';
        oggetto.value = valoreDaId('selezionaCorso');
        dati.push(oggetto);

        var oggetto = new Object();
        oggetto.name = 'nomeComunicazione';
        oggetto.value = valoreDaId('nomeComunicazione');
        dati.push(oggetto);

        var oggetto = new Object();
        oggetto.name = 'testoComunicazione';
        oggetto.value = valoreDaId('testoComunicazione');
        dati.push(oggetto);
    }else{
        dati = null;
    }//if
    return dati;
}//creaFormatoRichiestaComunicazione

function sendDatiComunicazione(){
    dati = creaFormatoRichiestaComunicazione();

    var callback = (err, res)=>{
        if(err){
            console.log("Errore: " + err + "; status: " + res);
            showMSG(0);
        }else{
            console.log("bella");
            if(res){
                showMSG(1);
                resetFormCom();
                loadBox();
            }else{
                showMSG(0);
            }
        }//if
    }//callback

    console.log(dati);
    if(dati != null){
        var richiesta = new Request("/iCourse/src/controller/new_communication_controller.php", "POST", dati, callback);
        richiesta.send();
    }else{
        showMSG(0);
    }
}//sendDatiComunicazione

function showMSG(type){
    if(type == 0){
        document.getElementById("errore").style.display = "block";
        setInterval(()=>{document.getElementById("errore").style.display = "none";}, 5000);
    }else if(type == 1){
        document.getElementById("successo").style.display = "block";
        setInterval(()=>{document.getElementById("successo").style.display = "none";}, 5000);
    }//if
}//showMSG

function resetFormEventi(){
    document.getElementById('nomeEvento').value = "";
    document.getElementById('dataInizioEvento').value = "";
    document.getElementById('oraInizioEvento').value = "";
    document.getElementById('dataFineEvento').value = "";
    document.getElementById('oraFineEvento').value = "";
    document.getElementById('ripetizione').value = "0";
    document.getElementById('fineRipetizione').value = "";
    document.getElementById('luogo').value = "";
    document.getElementById('descr').value = "";
}//resetFormEventi

function resetFormCom(){
    document.getElementById('nomeComunicazione').value = "";
    document.getElementById('testoComunicazione').value = "";
}//resetFormEventi

function createUserPage(list){
    var riga2 = '</td><td>';
    var riga3 = '</td></tr>';
    var riga4 = '<td><button type="submit" class="btn btn-primary btn-accedi">Aggiungi</button></td>';
    document.getElementById('listaUtenti').innerHTML = "";
    for(var i=0; i<list.length; i++){
        document.getElementById('listaUtenti').innerHTML += '<tr><td scope="row" id="utente-' + i + '">' + list[i].Matricola + riga2 + list[i].Nome + riga2 + list[i].Cognome + riga2 + list[i].Anno + list[i].Corso + list[i].Sezione + riga2 + '<button type="submit" class="btn btn-primary btn-accedi" id="bott-' + i + '" onclick="subscribeCourse(this.id)">Aggiungi</button>' + riga3;
    }//for
}//createUserPage

function subscribeCourse(id){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id_a = url.searchParams.get("activity_id");
    var id_u = id.split("-")[1];
    var matr = document.getElementById('utente-' + id_u).innerText;

    var callback_sub = (err, res)=>{
        if(err){
            console.log("Errore: " + err + "; status: " + res);
            showMSG(0);
        }else{
            if(res){
                showMSG(1);
                caricaUtenti();
            }else{
                showMSG(0);
            }//if
        }//if
    }//callback_sub

    var requestActivity = new Request("/iCourse/src/controller/insert_student_controller.php", "POST", [{"name":"Matricola","value":matr},{"name":"activityId","value":id_a}], callback_sub);
    requestActivity.send();
}//subscribeCourse
