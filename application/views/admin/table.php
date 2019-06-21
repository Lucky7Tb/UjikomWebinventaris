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