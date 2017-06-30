<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Détails du devis</h4>
            </div><!-- FIN MODAL HEADER -->
            <div class="modal-body">
                <div class="container col-lg-12"><!-- CONTAINER -->
                    <div class="well well-sm text-center">
                        <h3>Type de session</h3>
                        <div class="well-btn btn-group" data-toggle="buttons">

                        <label class="btn btn-success active">Inter-entreprises
                        <input type="radio" name="session" value="inter" id="option2" autocomplete="off" checked>
                        <span class="glyphicon glyphicon-ok"></span>
                        </label>

                        <label class="btn btn-success">Intra-entreprise dans nos locaux
                        <input type="radio" name="session" value="intratlas" id="option2" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        </label>

                        <label class="btn btn-success">Intra-entreprise dans vos locaux
                        <input type="radio" name="session" value="intraclient" id="option2" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        </label>

                        </div>
                    </div><!-- FIN WELL -->
                    <div class="row">
                        <div class="col-md-2 form-group w189">
                                <label>Nombre de stagiaires</label>
                                <div class="input-group w189">
                                      <span class="input-group-btn">
                                          <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[1]">
                                            <span class="glyphicon glyphicon-minus"></span>
                                          </button>
                                      </span>
                                      <input id="nb_stagiaires" type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="6">
                                      <span class="input-group-btn">
                                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[1]">
                                              <span class="glyphicon glyphicon-plus"></span>
                                          </button>
                                      </span>
                                </div>
                            </div><!-- FIN COL MD 2 -->
                            <div class="div-certif col-lg-offset-1   col-lg-3 form-group modal-cpf"></div>
                            <div class="col-lg-3 form-group modal-cpf" id="div-cpf-modal">
                              <label>Nombre de certifications</label>
                              <div class="input-group w189">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input id="input-attr" type="text" name="quant[2]" class="form-control input-number nb_certif" value="1" min="1" max="6">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                              </div>
                            </div>
                            <div class="col-lg-3" id="div-duree">
                                <label>Durée de la formation</label>
                                <p id="td-duree"></p>
                            </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <tr>
                                <td class="bold">Nombre de personnes maximum</td>
                                <td class="bold">Prix de la formation / jour</td>
                                <td class="bold">Prix de la formation HT pour <span id="span-jour-formation"></span></td>
                            </tr>
                            <tr>
                                <td id="td-maxi-pers"></td>
                                <td id="td-prix"></td>
                                <td id="td-prix-total"></td>
                            </tr>
                            <tr class="modal-cpf warning afterSelectChange">
                                <td class="bold"></td>
                                <td class="bold">Prix d'une certification</td>
                                <td class="bold">Prix total des certifications</td>
                            </tr>
                            <tr class="modal-cpf afterSelectChange">
                                <td></td>
                                <td id="td-prix-certif"></td>
                                <td id="td-total-certif"></td>
                            </tr>
                            <tr class="info afterSelectChange">
                                <td class="bold"></td>
                                <td class="bold">Prix total HT</td>
                                <td class="bold">Prix total TTC</td>
                            </tr>
                            <tr class="afterSelectChange">
                                <td></td>
                                <td id="td-total-ht"></td>
                                <td id="td-total-ttc"></td>
                            </tr>

                        </table>
                    </div><!-- FIN ROW -->
                </div><!-- FIN CONTAINER -->

            </div><!-- FIN MODAL BODY -->
            <div class="modal-footer">
                <button id="post-modal" type="button" class="btn btn-info" data-dismiss="modal">Ajouter la formation et poursuivre le devis</button>
                <button id="close-modal" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <div id="prix"></div>
                <div id="prix-certif"></div>
            </div><!-- FIN MODAL FOOTER -->
        </div><!-- FIN MODAL CONTENT -->
    </div><!-- FIN MODAL DIALOG -->
</div><!-- FIN MODAL FADE -->				






				