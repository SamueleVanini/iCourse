/**
 * Funzione che inserisce le attività nell'activity-box.
 * @param eventi Array di eventi in json.
*/
function createActivityBox(eventi){
    var intActivty1 = '<h4>I tuoi corsi</h4><ul>';
    var intActivty2 = '<h4>Altri corsi</h4><ul>';
    var activity = '';
    for(i=0; i<eventi.length; i++){
        activity += '<li><a href="activity.php?activity_id=' + eventi[i].id + '">' + eventi[i].title + '</a></li>';
    }//for
    activity += '</ul>';

   document.getElementById('activity-box').innerHTML = intActivty1 + activity;
}//createActivityBox

/**
 * Funzione che inserisce le attività nella social-box.
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
        data += 'Nome: ' + '<i>' + dati[i].name + '</i><br>';
        data += 'Cognome: ' + '<i>' + dati[i].surname + '</i><br>';
        data += 'Data di Nascita: ' + '<i>' + dati[i].bornDate + '</i><br>';
        data += 'Classe: ' + '<i>' + dati[i].classYear + dati[i].classCourse + dati[i].classSection + '</i><br>';
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
    if(informazioni[3].nomeMateriale){
        testo='<table class="table table-hover" id="tabellaFile"><thead><tr><th scope="col">#</th><th scope="col">Nome file</th><th scope="col">Data aggiunta</th></tr></thead>';
        for(var i=0;i<informazioni[3].length;i++)
            testo+="<tr><th>"+(i+1)+"</th><td>"+informazioni[3][i].NomeMateriale+"</td><td>"+informazioni[3][i].DataAggiunta+"</td></tr>";
        document.getElementById('divTabellaFile').innerHTML = testo + '</table>';
    }else{
        document.getElementById('materiali').innerHTML = "";
    }
}//createActivityPage

/** showButtonCorsi
 * Funzione che aggiunge alla box dei corsi un bottone per ggiungere un nuovo corso o una nuova comunicazione
*/
function showButtonCorsi(){
    document.getElementById("bannerBoxCorsi").innerHTML+='<button id="btn-event">+</button>';
} //showButtonsCorsiComunicazioni

/** showButtonComunicazioni
 * Funzione che aggiunge alla box delle comunicazioni un bottone per ggiungere un nuovo corso o una nuova comunicazione
*/
function showButtonComunicazioni(){
    document.getElementById("bannerBoxComunicazioni").innerHTML+='<button id="btn-communication">+</button>';
} //showButtonComunicazioni

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
            showMSG(1);
            resetFormEventi();
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
            showMSG(1);
            resetFormCom();
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

