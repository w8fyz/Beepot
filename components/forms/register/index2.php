<div class="card mt-5">
    <div class="card-body">
        <div class="text-center">

            <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
            <h1 class="h3 mb-3">Sécurisation</h1>
        </div>
        <form method="post" action="register.php">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <div class="form-floating <?= needClass($error, 'mots de passe') ?>">
                    <input type="password" class="form-control <?= needClass($error, 'mots de passe') ?>" id="floatingInputGroup1" placeholder="Mot de passe" name="password">
                    <label for="floatingInputGroup1">Mot de passe</label>
                </div>
                <div class="invalid-feedback">
                    <?= $error ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <div class="form-floating <?= needClass($error, 'mots de passe') ?>">
                    <input type="password" class="form-control <?= needClass($error, 'mots de passe') ?>" id="floatingInputGroup1" placeholder="Mot de passe" name="password_confirm">
                    <label for="floatingInputGroup1">Confirmation du mot de passe</label>
                </div>
                <div class="invalid-feedback">
                    <?= $error ?>
                </div>
            </div>
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="username" value="<?= $username ?>">
            <input type="hidden" name="step" value="3">
            <button class="btn btn-lg btn-warning btn-block mt-4" type="submit">Continuer</button>
        </form>
        <p>Etape 2/3</p>
    </div>
</div>