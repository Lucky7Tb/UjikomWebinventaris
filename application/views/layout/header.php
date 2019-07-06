<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('assets/css/materialize/materialize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/icon/materialicon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/costume/mystyle.css') ?>">
    <title><?= $title ?></title>
</head>

<body>
    <div class="preloader" id="preloader"></div>
    <nav class="blue darken-1">
        <div class="nav-wrapper container">
            <a href="#!" class="brand-logo center"><img src="<?= base_url('assets/img/Logo SMKN 1 Katapang.png') ?>" class="img-responsive" width="50" style="margin-top:5px" alt="profile"></a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a id="test" href="">Link1</a></li>
                <li><a href="">Link2</a></li>
                <li><a href="<?= site_url('auth/register') ?>">Add User</a></li>
                <li><span class="dropdown-trigger" data-target="dropdown"><?= $this->session->userdata('user') ?></span></li>
            </ul>
        </div>
    </nav>


    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="<?= base_url('assets/img/papyrus.png') ?>">
                </div>
                <a href="#user"><img class="circle" src="<?= base_url('assets/img/IMG-20190520-WA0017.jpg') ?>"></a>
                <a href="#name"><span class="black-text name">Welcome</span></a>
                <?php if ($this->session->userdata('level') == 1) : ?>
                    <a href="#email"><span class="black-text email">Administrator</span></a>
                <?php elseif ($this->session->userdata('level') == 2) : ?>
                    <a href="#email"><span class="black-text email">Operator</span></a>
                <?php else : ?>
                    <a href="#email"><span class="black-text email">Peminjam</span></a>
                <?php endif; ?>
            </div>
        </li>
        <ul class="collapsible">
            <li class="active">
                <div class="collapsible-header"><i class="material-icons">dashboard</i>Dashboard</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?= site_url('admin/index')?>">Management Barang</a></li>
                        <li><a class="waves-effect" href="<?= site_url('admin/room')?>">Management Ruangan</a></li>
                        <li><a class="waves-effect" href="<?= site_url('admin/type_room')?>">Management Jenis Barang</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
        </ul>
    </ul>

    <ul id="dropdown" class="dropdown-content">
        <li><a href="<?= base_url('auth/logout') ?>"><i class="material-icons">exit_to_app</i> Logout</a></li>
        <li><a href="#!"><i class="material-icons">settings</i>Setting</a></li>
    </ul>

    <div id="content">