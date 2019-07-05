<?php foreach ($rooms as $room) : ?>
    <tr>
        <td><?= $room->nama_ruang ?></td>
        <td><?= $room->keterangan ?></td>
        <td>
            <a href="<?= base_url('admin/update_room') ?>" class="btn-update_room" data-id="<?= $room->id_ruang ?>"><i class="material-icons">create</i></a>
            <a href="<?= base_url('admin/delete_room') ?>" class="btn-delete_room" data-id="<?= $room->id_ruang ?>"><i class="material-icons red-text">delete</i></a>
        </td>
    </tr>
<?php endforeach; ?>