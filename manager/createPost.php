<?php
#  if($_SERVER["REQUEST_METHOD"] != "POST") {
?>

<div class="modal fade" id="newBeepModal" tabindex="-1" aria-labelledby="newBeepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBeepModalLabel">Nouveau Beep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newBeepForm">
                    <div class="form-group">
                        <textarea class="form-control" id="beepContent" rows="3" maxlength="1000" name="beepContent"></textarea>
                        <small class="text-muted"><span id="charCount">0</span>/1000 caractères</small>
                    </div>
                    <div class="form-group">
                        <label for="beepImages">Images (maximum 4)</label>
                        <div class="input-group mb-3">
                            <input style="display: none" type="file" class="form-control" id="beepImages" name="beepImages" accept="image/*" multiple>
                            <button class="btn btn-outline-secondary" type="button" id="addImageButton">+</button>
                        </div>
                        <div id="beepImagesPreview" style="display: flex;"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="sendBeepButton">Beeper</button>
            </div>
        </div>
    </div>
</div>

<script src="js/beepSend.js"></script>

<?php #  } else {

$TESTVAR = "SAODKZADOZADKZAD";

        require "./utils/handleErrors.php";

        include_once("./manager/user.php");
        include_once("./manager/post.php");
        if (!$isLogged()) {
            return;
        }
        header("Content-Type: application/json");
        echo json_encode(array("success" => true));
        return;
           # if (isset($_POST["beepContent"])) {
            if(isset($TESTVAR)) {
                echo "CALLED";
              # $beepContent = htmlspecialchars($_POST["beepContent"]);
                $beepContent = htmlspecialchars($TESTVAR);
                # Traitement des images du beep
                $beepImages = array();
                for ($i = 0; $i < 4; $i++) {
                    if (isset($_FILES["beepImage{$i}"]) && $_FILES["beepImage{$i}"]["error"] == 0) {
                        $file = $_FILES["beepImage{$i}"];
                        if (in_array($file["type"], array("image/jpeg", "image/png"))) {
                            $filename = uniqid() . "_" . $file["name"];
                            move_uploaded_file($file["tmp_name"], "assets/uploads/" . $filename);
                            $beepImages[] = $filename;
                        }
                    }
                }

                include_once("./manager/files.php");
                $beepId =  $createNewPost($beepContent);
                foreach ($beepImages as $filename) {
                    $createFile($beepId, $filename);
                }
                header("Content-Type: application/json");
                echo json_encode(array("success" => true));
            } else {
                header("Content-Type: application/json");
                echo json_encode(array("success" => false, "message" => "Le contenu du beep est requis."));
            }


  #  }
    ?>