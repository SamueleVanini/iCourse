                <!-- frame form creazione corso -->
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-corso" onclick="showForm()">Crea corso</button>
                    <div class="container inserimento-evento" id="form-evnt">
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
                            <button type="submit" class="btn btn-primary">Crea evento</button>
                        </form>
                    </div>
                </div> 