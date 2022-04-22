<html>

<head>
  <title>CI Blog</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
  <!-- <script src="http://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</head>

<body>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">CI Blog Frame</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>posts">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>view_galleries">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a>
        </li>
        

      </ul>
      <div class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav">
          <?php if (!$this->session->userdata('login')) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a></li>
          <?php endif; ?>
          <?php if ($this->session->userdata('login')) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/dashboard"><?php echo $this->session->userdata('username'); ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('user_registered')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('post_created')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('post_updated')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('category_created')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_created') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('post_deleted')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login_failed')) : ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_loggedin')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('user_loggedout')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('category_deleted')) : ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_deleted') . '</p>'; ?>
    <?php endif; ?>