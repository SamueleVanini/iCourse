                <!-- frame form creazione corso -->
                <button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-corso" id="btn-event">Crea corso</button>

                <div class="modal" id="form-event">
                    <div class="modal-content">
                        <span class="close" id="chiudiEvento">&times;</span>
                        <div>
                        <form>
                            <div class="form-group">
                                <label for="nomeEvento">Nome evento</label>
                                <input type="text" class="form-control" id="nomeEvento" placeholder="Nome dell'evento che si vuole creare" required>
                            </div>
                            <div class="form-group">
                                <label for="dataInizioEvento">Inizio evento</label>
                                <input type="date" class="form-control" id="dataInizioEvento" required>
                                <input type="time" class="form-control" id="oraInizioEvento" required>
                            </div>
                            <div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento" required>
                                <input type="time" class="form-control" id="oraFineEvento" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="ripetizione">Ripetizione evento</label>
                                    </div>
                                    <select class="custom-select" id="ripetizione" onchange="showFine()">
                                        <option selected value="0">Nessuna</option>
                                        <option value="1">Ogni settimana</option>
                                        <option value="2">Ogni 2 settimane</option>
                                        <option value="3">Ogni mese</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="div-fine-rip">
                                <label for="fine-ripetizione">Fine ripetizione</label>
                                <input type="date" class="form-control" id="fineRipetizione">
                            </div>
                            <div class="form-group" id="div-luogo">
                                <label for="luogo">Luogo</label>
                                <input type="text" class="form-control" id="luogo" placeholder="Luogo in cui si terr&agrave; il corso" required>
                            </div>
                            <div class="form-group" id="div-descr">
                                <label for="descr">Descrizione del corso</label>
                                <textarea class="form-control" id="descr" rows="3" placeholder="Descrizione del corso"></textarea required>
                            </div>
                            <input type="button" class="btn btn-primary" onclick="sendDatiCorso()" value="Crea corso">
                        </form>
                        </div>
                    </div>
                </div>

<script>
    var modal_event = document.getElementById('form-event');
    var btn_event = document.getElementById("btn-event");
    var span_event = document.getElementById("chiudiComunicazione");
    btn_event.onclick = function() {
        modal_event.style.display = "block";
    }
    span_event.onclick = function() {
        modal_event.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal_event) {
            modal_event.style.display = "none";
        }
    }
</script>
