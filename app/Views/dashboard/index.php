<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>

<div class="container">
    <div class="row pt-3">
        <div class="col-md-8 offset-2">
            <h4><?= $title; ?></h4>
            <hr>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">
        <img src="/images/<?= $userInfo['avatar']  ?>" alt="" width="200px" height="150px">
        <form action="<?= base_url('auth/uploadImage'); ?>" enctype="multipart/form-data" method="post">
            <input type="file" class="form-control"
            name="userImage" size="10" />
            <hr>
            <input type="submit">
        </form>
      </th>
      <td><?= $userInfo['name']; ?></td>
      <td><?= $userInfo['email']; ?></td>
      <td> <a href="<?= site_url('auth/logout'); ?>">Logout</a></td>
    </tr>
  </tbody>
</table>
  <?php 
                if(!empty(session()->getFlashData('notification'))){
                    ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashData('notification') ?>
                    </div>
                    <?php
                }
                ?>
        </div>
    </div>
</div>

  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>