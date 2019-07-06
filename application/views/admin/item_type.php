<div class="row">
    <div class="col s5">
        <div class="card-panel">
            <h5>Form Tipe Barang</h5>
            <div class="divider"></div>
            <div class="row">
                <form action="<?= base_url('admin/add_type') ?>" id="type_form">
                    <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" id="type_id" name="type_id">
                    <div class="input-field col s12">
                        <input placeholder="e.g Elektronik" id="type_name" name="type_name" type="text">
                        <label for="type_name">Nama Jenis Barang</label>
                    </div>
                </form>
                <div class="col s6">
                    <button type="submit" class="btn blue darken-1 btn-add_type">Submit</button>
                    <button type="submit" class="btn blue darken-1 update_type">Update</button>
                </div>
                <div class="col s1 offset-s2">
                    <button type="reset" class="btn red darken-1 btn-cancel_type">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col s7 container">
        <div class="card-panel">
            <h5>Tabel Tipe Barang</h5>
            <div class="divider"></div>
            <table class="highlight responsive-table centered">
                <thead>
                    <tr>
                        <th>Nama Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="type_data">
                    <?php foreach ($types as $type) : ?>
                        <tr>
                            <td><?= $type->nama_jenis ?></td>
                            <td>
                                <a href="<?= base_url('admin/update_type') ?>" class="btn-update_type" data-id="<?= $type->id_jenis ?>"><i class="material-icons">create</i></a>
                                <a href="<?= base_url('admin/delete_type') ?>" class="btn-delete_type" data-id="<?= $type->id_jenis ?>"><i class="material-icons red-text">delete</i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="type_pagination">
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
    </div>
</div>