<?php
 if($_SERVER["REQUEST_METHOD"] != "POST") {
?>

<div class="modal fade" id="newBeepModal" tabindex="-1" aria-labelledby="newBeepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="newBeepModalLabel">Nouveau Beep</h5>
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
                    </div>
                </form>
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

<script src="js/beepSend.js"></script>

<?php   } else {

     function folder_exist($folder)
     {
         // Get canonicalized absolute pathname
         $path = realpath($folder);

         // If it exist, check if it's a directory
         return ($path !== false AND is_dir($path)) ? $path : false;
     }

     $env = parse_ini_file(dirname(__DIR__).'/.env');
        require $env['DOC_ROOT'].'/manager/user.php';

        require $env['DOC_ROOT'].'/manager/post.php';



        if (!$isLogged()) {
            echo json_encode("Tu n'es pas connecté !");
            return;
        }

        $logs = [];

           if (isset($_POST["beepContent"])  && strlen($_POST['beepContent']) > 0 && strlen($_POST['beepContent']) <= 1000) {
              $beepContent = htmlspecialchars($_POST["beepContent"]);
                $beepImages = array();
                for ($i = 0; $i < 4; $i++) {
                    if (isset($_FILES["beepImage{$i}"])) {
                        $file = $_FILES["beepImage{$i}"];
                        $file_name = $file['name'];
                        $file_size = $file['size'];
                        $file_tmp = $file['tmp_name'];
                        $file_type= $file['type'];
                        $file_split = explode('.', $file['name']);
                        $file_ext=strtolower(end($file_split));
                        $extensions= array("jpeg","jpg","png", "gif", "ico", "webp");

                        if(in_array($file_ext,$extensions)=== false){
                            echo json_encode("L'extension doit être parmis les suivantes : jpeg, ico, webp, jpg, png, gif.");
                            return;
                        }

                        if($file_size > 41943040){
                            echo json_encode("le fichier ne doit pas faire plus de 5MB.");
                            return;
                        }

                        if($_FILES["beepImage{$i}"]["error"] != 0) {
                            echo json_encode("Une erreur est survenu : ".$_FILES["beepImage{$i}"]["error"]);
                            return;
                        }

                        $filename = uniqid() . "." . $file_ext;
                        move_uploaded_file($file["tmp_name"],parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/assets/uploads/" . $filename);
                        $beepImages[] = $filename;
                    }
                }
               include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/files.php");
               $beepId =  $createNewPost($beepContent);
               foreach ($beepImages as $filename) {
                   $createFile($beepId, $filename);
               }
                echo json_encode("ID-".$getUser()->id);
               return;
            } else {
                echo json_encode("Le beep doit faire entre 1 et 1000 caractères.");
               return;
            }

    }
    ?>