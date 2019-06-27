<div class="registerbackground">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="registercontainer z-depth-3">
                    <?php if (($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) && $this->session->userdata('login') == TRUE) : ?>
                        <h4 class="center">Add User</h4>
                    <?php elseif ($this->session->userdata('login') == FALSE || $this->session->userdata('level') == 3) : ?>
                        <h4 class="center">Register</h4>
                    <?php endif; ?>
                    <hr class="line">
                    <div class="container">
                        <form class="registerform" action="<?= site_url('auth/register') ?>" method="post">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                                <div class="input-field  col s6">
                                    <i class="material-icons prefix">person</i>
                                    <input required placeholder="Your Name" name="name" id="name" type="text" value="<?= set_value('name') ?>">
                                    <span class=" helper-text red-text text-darken-2"><?= form_error('name') ?></span>
                                </div>
                                <div class="input-field  col s6">
                                    <i class="material-icons prefix">person</i>
                                    <input required placeholder="Username" name="username" id="username" type="text">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('username') ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">email</i>
                                    <input required placeholder="Email" name="email" id="email" type="email">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('email') ?></span>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">phone</i>
                                    <input required placeholder="Number" name="phone" id="phone" type="text">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('phone') ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">lock</i>
                                    <input required placeholder="Password" name="password" id="password" type="password">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('password') ?></span>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">verified_user</i>
                                    <input required placeholder="Verify Password" name="confpass" id="confpass" type="password">
                                    <span class="helper-text red-text text-darken-2"><?= form_error('confpass') ?></span>
                                </div>
                            </div>
                            <?php if ($this->session->userdata('level') == 1) : ?>
                                <div class="row">
                                    <div class="col s4">
                                        <p>
                                            <label>
                                                <input value="1" class="with-gap" name="level" type="radio" />
                                                <span>Administrator</span>
                                            </label>
                                        </p>
                                    </div>
                                    <div class="col s4">
                                        <p>
                                            <label>
                                                <input value="2" class="with-gap" name="level" type="radio" />
                                                <span>Operator</span>
                                            </label>
                                        </p>
                                    </div>
                                    <div class="col s4">
                                        <p>
                                            <label>
                                                <input value="3" class="with-gap" name="level" type="radio" />
                                                <span>User</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('level') == 1 && $this->session->userdata('login') == TRUE) : ?>
                                <div class="row">
                                    <div class="col s2">
                                        <button type="submit" class=" waves-effect waves-costume btn-register z-depth-3">Add User</button>
                                    </div>
                                    <div class="col s4">
                                        <a href="<?= site_url('admin/index') ?>">Back</a>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('level') == 2  && $this->session->userdata('login') == TRUE) : ?>
                                <div class="row">
                                    <div class="col s2">
                                        <button type="submit" class=" waves-effect waves-costume btn-register z-depth-3">Add User</button>
                                    </div>
                                    <div class="col s4">
                                        <a href="<?= site_url('operator/index') ?>">Back</a>
                                    </div>
                                </div>
                            <?php elseif (!$this->session->userdata('login')) : ?>
                                <div class="row">
                                    <div class="col s2">
                                        <button type="submit" class=" waves-effect waves-costume btn-register z-depth-3">Register</button>
                                    </div>
                                    <div class="col s4">
                                        <a href="<?= site_url('auth/login') ?>">Already have an account?</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>