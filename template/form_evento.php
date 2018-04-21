                <!-- frame form creazione corso -->
                <button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-corso" id="btn-form">Crea corso</button>

                <div class="modal" id="form-evnt">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nomeEvento">Nome evento</label>
                                <input type="text" class="form-control" id="nomeEvento" placeholder="Nome dell'evento che si vuole creare">
                            </div>
                            <div class="form-group">
                                <label for="dataInizioEvento">Inizio evento</label>
                                <input type="date" class="form-control" id="dataInizioEvento">
                                <input type="time" class="form-control" id="oraInizioEvento">
                            </div>
                            <div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
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
                                <input type="number" class="form-control" id="fine-ripetizione" placeholder="">
                                <small id="fine-ripetizione-help" class="form-text text-muted">Inserire il numero di eventi che si ripetono consecutivamente.</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Crea evento</button>
                        </form>
                        </div>
                    </div>
                </div>

                <script>
                var modal = document.getElementById('form-evnt');

                var btn = document.getElementById("btn-form");

                var span = document.getElementsByClassName("close")[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                } 
                </script>