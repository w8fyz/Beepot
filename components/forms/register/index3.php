<div class="card mt-5">
    <div class="card-body">
        <div class="text-center">

            <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
            <h1 class="h3 mb-3">Vérification</h1>
        </div>
        <form method="post" action="register.php">

            <div class="form-floating mb-3">
                <input type="text" name="username" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="<?= $username ?>">
                <label for="floatingPlaintextInput">Nom d'utilisateur</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="<?= $email ?>">
                <label for="floatingPlaintextInput">Adresse mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="<?= $password ?>">
                <label for="floatingPlaintextInput">Mot de passe</label>
            </div>
            <div class="form-check" style="text-align: left;">
                <input class="form-check-input <?= needClass($error, 'conditions') ?>" type="checkbox" name="acceptTOS" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    J'accepte les <a href="#">conditions d'utilisation de Beepot</a>
                </label>
            </div>
            <input type="hidden" name="step" value="4">
            <button class="btn btn-lg btn-warning btn-block mt-4" type="submit">Valider</button>
        </form>
        <p>Etape 3/3</p>
    </div>
</div>