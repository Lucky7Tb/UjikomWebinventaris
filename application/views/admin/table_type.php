<?php foreach ($types as $type) : ?>
    <tr>
        <td><?= xss_filter($type->nama_jenis) ?></td>
        <td>
            <a href="<?= base_url('admin/update_type') ?>" class="btn-update_type" data-id="<?= $type->id_jenis ?>"><i class="material-icons">create</i></a>
            <a href="<?= base_url('admin/delete_type') ?>" class="btn-delete_type" data-id="<?= $type->id_jenis ?>"><i class="material-icons red-text">delete</i></a>
        </td>
    </tr>
<?php endforeach; ?>