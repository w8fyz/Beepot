<div class="card mt-5">
    <div class="card-body">
        <div class="text-center">
            <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
            <h1 class="h3 mb-3">Inscription</h1>
        </div>
        <form method="post" action="register.php">
            <div class="input-group mb-3">
                <span class="input-group-text">@</span>
                <div class="form-floating <?= needClass($error, 'utilisateur') ?>">
                    <input type="text" class="form-control <?= needClass($error, 'utilisateur') ?>" id="floatingInputGroup1" placeholder="Nom d\'utilisateur" name="username" value="<?= $username ?>">
                    <label for="floatingInputGroup1">Nom d\'utilisateur</label>
                </div>
                <div class="invalid-feedback">
                    <?= $error ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <div class="form-floating <?= needClass($error, 'email') ?>">
                    <input type="email" class="form-control <?= needClass($error, 'email') ?>" id="floatingInputGroup1" placeholder="Adresse mail" name="email" value="<?= $email ?>">
                    <label for="floatingInputGroup1">Adresse mail</label>
                </div>
                <div class="invalid-feedback">
                    <?= $error ?>
                </div>
            </div>
            <input type="hidden" name="step" value="2">
            <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Continuer</button>
        </form>
        <p>Etape 1/3</p>
    </div>
</div>
<span>Déjà un compte ? <a href="login.php">Connecte toi maintenant !</a></span>