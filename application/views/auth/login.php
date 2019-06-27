<div class="flash-data" data-flashdata="<?= $this->session->flashdata('danger') ?>"></div>
<div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>"></div>
<div class="loginbackground">
    <div class="container">
        <div class="row">
            <div class="col s12 push-s3">
                <div class="logincontainer">
                    <h4 class="center">Login</h4>
                    <hr class="line">
                    <div class="row">
                        <div class="container">
                            <form action="<?= site_url('auth/login') ?>" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <input required placeholder="Your Username" name="username" id="username" type="text">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('username') ?></span>
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input required placeholder="Your Password" name="password" id="password" type="password">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('password') ?></span>
                                </div>
                                <div class="col s3">
                                    <button type="submit" class="waves-effect waves-costume btn-login z-depth-3">Login</button>
                                </div>
                                <div class="col s7">
                                    <a href="<?= site_url('auth/register') ?>">Belum Punya Akun?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>