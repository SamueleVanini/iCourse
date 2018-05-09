<script>
    showButtonAggiungiStudenti();
</script>
    <div class="modal" id="gestioneUtenti">
        <div class="modal-content">
            <span class="close" id="chiudiUtenti">&times;</span>
                <div>
                    <!-- casella di ricerca -->
                    <div class="container-fluid ">
                        <div class="container-new row">
                            <div style="margin: 0 auto; text-align:center;">
                                <nav class="navbar navbar-light bg-light bg-light-new">
                                  <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Cerca studente" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 btn-outline-success-new" type="submit">Cerca</button>
                                  </form>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- tabella risultati -->
                    <div class="container-fluid">
                        <div class="container-new row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" id="tabella-studenti">
                                <table class="table" id="tabella-da-ordinare">
                                    <thead class="thead-dark thead-dark-new">
                                        <tr>
                                            <th scope="col" >Matricola
                                                <svg onclick="sortTable(0)" fill="white" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="20" viewBox="0 0 20 23">
                                                    <path d="M9.25,5L12.5,1.75L15.75,5H9.25M15.75,19L12.5,22.25L9.25,19H15.75M8.89,14.3H6L5.28,17H2.91L6,7H9L12.13,17H9.67L8.89,14.3M6.33,12.68H8.56L7.93,10.56L7.67,9.59L7.42,8.63H7.39L7.17,9.6L6.93,10.58L6.33,12.68M13.05,17V15.74L17.8,8.97V8.91H13.5V7H20.73V8.34L16.09,15V15.08H20.8V17H13.05Z" />
                                                </svg>
                                            </th>
                                            <th scope="col" >Nome
                                                <svg onclick="sortTable(1)" fill="white" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="20" viewBox="0 0 20 23">
                                                    <path d="M9.25,5L12.5,1.75L15.75,5H9.25M15.75,19L12.5,22.25L9.25,19H15.75M8.89,14.3H6L5.28,17H2.91L6,7H9L12.13,17H9.67L8.89,14.3M6.33,12.68H8.56L7.93,10.56L7.67,9.59L7.42,8.63H7.39L7.17,9.6L6.93,10.58L6.33,12.68M13.05,17V15.74L17.8,8.97V8.91H13.5V7H20.73V8.34L16.09,15V15.08H20.8V17H13.05Z" />
                                                </svg>
                                            </th>
                                            <th scope="col" >Cognome
                                                <svg onclick="sortTable(2)" fill="white" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="20" viewBox="0 0 20 23">
                                                    <path d="M9.25,5L12.5,1.75L15.75,5H9.25M15.75,19L12.5,22.25L9.25,19H15.75M8.89,14.3H6L5.28,17H2.91L6,7H9L12.13,17H9.67L8.89,14.3M6.33,12.68H8.56L7.93,10.56L7.67,9.59L7.42,8.63H7.39L7.17,9.6L6.93,10.58L6.33,12.68M13.05,17V15.74L17.8,8.97V8.91H13.5V7H20.73V8.34L16.09,15V15.08H20.8V17H13.05Z" />
                                                </svg>
                                            </th>
                                            <th scope="col" >Classe
                                                <svg onclick="sortTable(3)" fill="white" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="20" viewBox="0 0 20 23">
                                                    <path d="M9.25,5L12.5,1.75L15.75,5H9.25M15.75,19L12.5,22.25L9.25,19H15.75M8.89,14.3H6L5.28,17H2.91L6,7H9L12.13,17H9.67L8.89,14.3M6.33,12.68H8.56L7.93,10.56L7.67,9.59L7.42,8.63H7.39L7.17,9.6L6.93,10.58L6.33,12.68M13.05,17V15.74L17.8,8.97V8.91H13.5V7H20.73V8.34L16.09,15V15.08H20.8V17H13.05Z" />
                                                </svg>
                                            </th>
                                            <th scope="col" style="width: 15%;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaUtenti">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- navbar dei risultati -->
                    <div class="container-fluid" >
                        <div class="container-new row">
                            <div style="margin:0 auto; text-align: center;">
                                <nav aria-label="Page navigation example" style="margin: 0 auto">

                                  <ul class="pagination" style="margin: 0 auto">
                                    <li class="page-item" style="margin: 0 auto">
                                      <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    var modal_event = document.getElementById('gestioneUtenti');
    var btn_event = document.getElementById("btn-utenti");
    var span_event = document.getElementById("chiudiUtenti");
    btn_event.onclick = function() {
        modal_event.style.display = "block";
    }
    span_event.onclick = function() {
        modal_event.style.display = "none";
    }
<<<<<<< Updated upstream
    
    function caricaUtenti(){
        var url_string = window.location.href;
        var url = new URL(url_string);
        var id_a = url.searchParams.get("activity_id");
        
        var activity = [];
        var callback_activity = (err, res)=>{
            if(err){
                console.log("Errore: " + err);
            }else{
                res = JSON.parse(res);
                createUserPage(res);
                activity = [];
            }//if-else
        }//callback_get
        var requestActivity = new Request("/iCourse/src/controller/get_user_controller.php", "POST", [{"name":"activityId","value":id_a}], callback_activity);
        requestActivity.send();
    }//caricaUtenti
    
    caricaUtenti();
=======

    var url_string = window.location.href;
    var url = new URL(url_string);
    var id_a = url.searchParams.get("activity_id");

    var activity = [];
    var callback_activity = (err, res)=>{
        if(err){
            console.log("Errore: " + err);
        }else{
            res = JSON.parse(res);
            createUserPage(res);
        }//if-else
    }//callback_get
    var requestActivity = new Request("/iCourse/src/controller/get_user_controller.php", "POST", [{"name":"activityId","value":id_a}], callback_activity);
    requestActivity.send();

>>>>>>> Stashed changes
</script>
