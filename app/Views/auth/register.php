<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>

     <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-4">
                <h4>Sign up </h4>
                <hr>

                <?php 
                if(!empty(session()->getFlashData('success'))){
                    ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashData('success') ?>
                    </div>
                    <?php
                }else if(!empty(session()->getFlashData('fail'))){
                    ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashData('fail') ?>
                    </div>
                    <?php
                }
                ?>

                <form action="<?= base_url('auth/registerUser'); ?>" method="post" class="form">  
                    <?= csrf_field() ?> 
                     <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="<?= set_value('name'); ?>" placeholder="Name here" >
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'name') : '' ?>
                        </span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">E-mail</label>
                        <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="Email here" >
                         <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'email') : '' ?>
                        </span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>" placeholder="Password here" >
                         <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'password') : '' ?>
                        </span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" name="passwordConf" value="<?= set_value('passwordConf'); ?>" placeholder="Confirm Password here" >
                         <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'passwordConf') : '' ?>
                        </span>
                    </div>
                     <div class="form-group mb-3">
                        
                        <input type="submit" class="btn btn-info" value="Sign up" >
                    </div>
                </form>
                <a href="<?= site_url('auth') ?>" >Already have an account? Sign in</a>
            </div>
        </div>
     </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>