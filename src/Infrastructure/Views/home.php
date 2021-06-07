<?php require_once 'header.php'; ?>

    <!-- Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true" index="">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-tag"
                                viewBox="0 0 16 16"
                        >
                            <path
                                    d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"
                            />
                            <path
                                    d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"
                            />
                        </svg>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col pb-3">
                            <div class="card-body d-flex justify-content-between">
                                <div id="descriptionDiv" class="flex-column"></div>
                                <img id="modalImg" src="" alt="item-image" class="shadow img-bid" />
                            </div>
                        </div>
                        <div class="col">
                            <h3 id="counter"></h3>
                            <hr/>
                            <p>El precio está en <span id="currentPrice"></span>€</p>
                            <hr/>
                            <p>La siguiente puja está en <span id="nextBidPrice"></span>€</p>
                            <p class="text-secondary">Gastos de envío 9€</p>
                            <hr/>
                            <h5>Puja rápida</h5>
                            <div class="d-flex justify-content-between">
                                <button id="fbtn1" type="button" class="btn btn-info nopad"></button>
                                <button id="fbtn2" type="button" class="btn btn-info nopad"></button>
                                <button id="fbtn3" type="button" class="btn btn-info nopad"></button>
                            </div>
                            <hr />
                            <h5>Puja directa</h5>
                            <form id="directBidForm" class="row">
                                <div class="col">
                                    <input type="text" class="form-control" pattern="^[0-9]+$" placeholder="Ej. 10" required/>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-cash-coin me-1"
                                                viewBox="0 0 16 16"
                                        >
                                            <path
                                                    fill-rule="evenodd"
                                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"
                                            />
                                            <path
                                                    d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"
                                            />
                                            <path
                                                    d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"
                                            />
                                            <path
                                                    d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"
                                            />
                                        </svg>
                                        Pujar
                                    </button>
                                </div>
                            </form>
                            <hr/>
                            <h5>Pujas realizadas</h5>
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'footer.php'; ?>