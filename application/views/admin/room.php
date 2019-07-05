<div class="">

    <div class="row">
        <div class="col s5">
            <div class="card-panel">
                <h5>Form Ruangan</h5>
                <div class="divider"></div>
                <div class="row">
                    <form action="<?= base_url('admin/add_room')?>" id="room_form">
                        <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" id="room_id" name="room_id">
                        <div class="input-field col s12">
                            <input placeholder="e.g Ruang olahraga" id="room_name" name="room_name" type="text">
                            <label for="room_name">Nama Ruangan</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea placeholder="e.g Ruangan terletak di sebelah lapangan" id="room_desc" name="room_desc" class="materialize-textarea"></textarea>
                            <label for="room_desc">Keterangan Ruangan</label>
                        </div>
                    </form>
                    <div class="col s6">
                        <button type="submit" class="btn blue darken-1 btn-add_room">Submit</button>
                        <button type="submit" class="btn blue darken-1 update_room">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s7 container">
            <div class="card-panel">
                <h5>Tabel Ruangan</h5>
                <div class="divider"></div>
                <table class="highlight responsive-table centered">
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Deskripsi Ruangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="room_data">
                        <?php foreach ($rooms as $room) : ?>
                            <tr>
                                <td><?= $room->nama_ruang ?></td>
                                <td><?= $room->keterangan ?></td>
                                <td>
                                    <a href="<?= base_url('admin/update_room')?>" class = "btn-update_room" data-id="<?= $room->id_ruang?>"><i class="material-icons">create</i></a>
                                    <a href="<?= base_url('admin/delete_room')?>" class = "btn-delete_room" data-id="<?= $room->id_ruang?>"><i class="material-icons red-text">delete</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="room_pagination">
                    <?= $this->pagination->create_links() ?>
                </div>
            </div>
        </div>
    </div>

</div>