<div class="container">
    <div class="formcontainer">
        <button data-target="modal1" class="btn blue darken-1 modal-trigger">Add Data</button>

        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div id="loader"></div>
                <h4>Add Data</h4>
                <div class="divider"></div>
                <div class="row">
                    <form class="form" action="<?= base_url('admin/adddata') ?>" method="post">
                        <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="input-field col s6">
                            <input id="itemname" name="itemname" type="text">
                            <label for="itemname">Nama Barang</label>

                        </div>
                        <div class="input-field col s6">
                            <input name="itemammount" id="itemammount" type="number">
                            <label for="jumlah">Jumlah Barang</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="conditions" name="conditions">
                                <option value="Baik">Baik</option>
                                <option value="Tidak Baik">Tidak Baik</option>
                            </select>
                            <label>Kondisi Barang</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="type" name="type">
                                <?php foreach ($types as $type) : ?>
                                    <option value="<?= $type->id_jenis ?>"><?= $type->nama_jenis ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Jenis Barang</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="room" name="room">
                                <?php foreach ($rooms as $room) : ?>
                                    <option value="<?= $room->id_ruang ?>"><?= $room->nama_ruang ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Ruangan</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-blue btn-flat btn-submit">Submit</button>
                <button class="modal-close waves-effect waves-red btn-flat">Cancel</button>
            </div>
        </div>
        <table id="table_id" class="highlight centered responsive-table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Kondisi Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Jenis Barang</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="datatable">
                <?php foreach ($datas as $data) : ?>
                    <tr>
                        <td><?= $data->nama_barang ?></td>
                        <td><?= $data->kondisi_barang ?></td>
                        <td><?= $data->jumlah_barang ?></td>
                        <td><?= $data->nama_ruang ?></td>
                        <td><?= $data->nama_jenis ?></td>
                        <td>
                            <a href="<?= base_url('admin/update/') . $data->id_detail_barang ?>"><i class="material-icons">update</i></a>
                            <a href=""><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>