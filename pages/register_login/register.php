<?php
include '../../src/register/register_config.php';
include '../../pages/layouts/geral.php';
?>

<div class="d-grid gap-1">
    <h2>Cadastro</h2>
    <p>Por favor, preencha este formulário para criar uma conta.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="d-grid gap-2">
        <div class="form-group">
            <label>Email do usuário</label>
            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirme a senha</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Criar Conta">
            <input type="reset" class="btn btn-secondary ml-2" value="Apagar Dados">
        </div>
        <p>Já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
    </form>
</div>

<?php

include '../../pages/layouts/footer.php';
