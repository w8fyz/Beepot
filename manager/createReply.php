<?php
function getReplyModal($id) {
    echo '    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBeepModalLabel">Répondre à un Beep</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="newBeepClose"></button>
                </div>
                <div class="alert alert-warning" style="display: none;" id="beepSendWarning" role="alert">
                </div>
                <div class="modal-body">
                    <form id="newBeepForm">
                        <div class="form-group">
                            <textarea class="form-control" id="beepContent" rows="3" maxlength="1000" name="beepContent"></textarea>
                            <small class="text-muted"><span id="charCount">0</span>/1000 caractères</small>
                        </div>
                        <div class="form-group">
                            <div id="beepImagesPreview" style="display: flex;"></div>
                        </div>';
                    echo "<input hidden='hidden' name='idParent' value='$id'>";
                   echo '</form>
                </div>
                <div class="modal-footer">
                    <div style="width: auto;" class="input-group">
                        <input style="display: none" type="file" class="form-control" id="beepImages" name="beepImages" accept="image/*" multiple>
                        <button style="border-radius: 20px;" class="btn btn-outline-secondary" type="button" id="addImageButton">+</button>
                    </div>
                    <button type="button" class="btn btn-warning" id="sendBeepButton">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/beepInteractions.js"></script>';
}