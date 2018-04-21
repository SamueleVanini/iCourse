                <!-- frame form creazione corso -->
                <button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-corso" id="btn-form">Crea corso</button>

                <div class="modal" id="form-evnt">
                    <div class="modal-content">
                        <span class="close">&times;</span>
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
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
                            </div>
                            <div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
                            </div><div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
                            </div>
                            <div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
                            </div>
                            <button type="submit" class="btn btn-primary">Crea evento</button>
                        </form>
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