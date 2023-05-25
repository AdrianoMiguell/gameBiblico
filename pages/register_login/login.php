<?php
    include '../../src/register/login_config.php';
    include '../../pages/layouts/geral.php';
?>

         <div class="d-grid gap-1">
             <h2>Login</h2>
             <p>Por favor, preencha os campos para fazer o login.</p>
             <?php
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="d-grid gap-2">
                 <div class="form-group">
                     <label>Nome do usuário</label>
                     <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                     <span class="invalid-feedback"><?php echo $email_err; ?></span>
                 </div>
                 <div class="form-group">
                     <label>Senha</label>
                     <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                     <span class="invalid-feedback"><?php echo $password_err; ?></span>
                 </div>
                 <div class="form-group">
                     <input type="submit" class="btn btn-primary" value="Entrar">
                 </div>
                 <p>Não tem uma conta? <a href="register.php">Inscreva-se agora</a>.</p>
             </form>
         </div>
     </main>
 </body>

 </html>

 <?php 

include '../../pages/layouts/footer.php';
