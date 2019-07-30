<?php foreach($datas as $data):?>
    <tr>
        <td><?php xss_filter($data->nama_barang)?></td>
        <td><?php xss_filter($data->kondisi_barang)?></td>
        <td><?php xss_filter($data->jumlah_barang)?></td>
        <td><?php xss_filter($data->nama_jenis)?></td>
        <td><?php xss_filter( $data->nama_ruang)?></td>
        <td>
            <a data-target="modal1" data-id="<?= $data->id_detail_barang ?>" class="modal-trigger btn-update" href="<?= base_url('admin/update_data') ?>"><i class="material-icons">create</i>
            </a>
            <a data-id="<?= $data->id_detail_barang ?>" class="btn-delete" href="<?= base_url('admin/delete_data') ?>"><i class="material-icons red-text">delete</i>
            </a>
        </td>
    </tr>
<?php endforeach;?>