<!-- frame form creazione comunicazione -->
<button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-comunicazione" id="btn-communication">Crea comunicazione</button>
<div class="modal" id="form-communication">
    <div class="modal-content">
        <span class="close" id="chiudiComunicazione">&times;</span>
        <div>
            <form>
                <div class="form-group">
                    <label for="nomeCorso">Seleziona nome del corso in cui inserire</label>
                    <br>
                    <script>
                        var eventiGestiti = [];
                        var callback_event = (err, response_event)=>{
                            if(err){
                                console.log("Errore: " + err);
                            }else{
                                response_event = JSON.parse(response_event);
                                for(i=0; i<response_event.length; i++){
                                    var eventoGestiti = new Object(); //NON GUARDARE TI PREGO
                                    eventoGestiti.IdEvento = response_event[i].IdEvento;
                                    eventoGestiti.start = response_event[i].Data + 'T' + response_event[i].OraInizio;
                                    eventoGestiti.end = response_event[i].Data + 'T' + response_event[i].OraFine;
                                    eventiGestiti.push(eventoGestiti);
                                }//for
                                createActivityBox(eventiGestiti);
                            }//if-else
                        }//callback_get
                        var requestEvent = new Request("/iCourse/src/controller/managed_event_controller.php", "POST", [], callback_event); //inizialize the Request object
                        requestEvent.send();
                        <select name="Corso">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </script>
                </div>
                <div class="form-group">
                    <label for="nomeComunicazione">Nome comunicazione</label>
                    <input type="text" class="form-control" id="nomeComunicazione" placeholder="Nome della comunicazione che si vuole creare">
                </div>
                <div class="form-group">
                    <label for="testoComunicazione">Testo comunicazione</label>
                    <textarea class="form-control" id="testoComunicazione" placeholder="Testo della comunicazione che si vuole creare"></textarea>
                </div>
                <div class="form-group">
                    <label for="fileAllegato">File allegato (opzionale)</label>
                    <br>
                    <input type="file" name="file">
                </div>
                <input type="button" class="btn btn-primary" onclick="sendDatiComunicazione()" value="Crea comunicazione">
            </form>
        </div>
    </div>
</div>

<script>
    var modal_communication = document.getElementById('form-communication');
    var btn_communication = document.getElementById("btn-communication");
    var span_communication = document.getElementById("chiudiComunicazione");
    btn_communication.onclick = function() {
        modal_communication.style.display = "block";
    }
    span_communication.onclick = function() {
        modal_communication.style.display = "none";
    }
</script>
