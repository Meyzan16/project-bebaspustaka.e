<?php foreach ($laporan as $data) { ?>

<?php } ?>
<?php $this->db = db_connect(); ?>
<html>
<head>
	<title>Bebas Pustaka Pusat </title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 14px;
		}
		table tr .text {
			text-align: center;
			font-size: 15px;
		}
		table tr td {
			font-size: 14px;
		}

	</style>
</head>
<body onload="window.print();setTimeout(window.close, 0);">
	<center>
		<table>
			<tr>
				<td><img src="<?= base_url() ?>/unib.png" width="90" height="90"></td>
				<td>
				<center>
					<font size="4">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</font><br>
					<font size="4"><b>UNIVERSITAS BENGKULU</b></font><br>
                    <font size="4"><b>UPT PERPUSTAKAAN</b></font><br>
					<font size="2">Jalan W.R Supratman Kandang Limun,Bengkulu Kode Pos 38371 </font><br>
					<font size="2">Telepon/Fax (0736)24144; Tlp.(0736) 21170 Pesawat 211 </font>
                    <font size="2">Laman : http://library.unib.ac.id; email : library@unib.ac.id </font>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
                
			</tr>
		<table width="625">
			<tr>
				<td class="text2">Bengkulu, <?php
                        $tgl = date('d-m-Y');
                        echo $tgl; ?></td>
			</tr>
		</table>
		</table>
		<table>
			<tr class="text2">
				<td>Nomer</td>
				<td width="572">:  </td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td width="564">: Bebas Pustaka</td>
			</tr>
		</table>
		<!-- <br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Yth<br>Siswa Smk Baitul Hikmah kelas x<br>Di tempat</font>
		       </td>
		    </tr>
		</table> -->
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Kepala UPT Perpustakaan Universitas Bengkulu, menerangkan dengan sebenarnya bahwa Mahasiswa berikut ini :   </font>
		       </td>
		    </tr>
		</table>
		<br>
		</table>
		<table>
			<tr>
				<td>Nama</td>
				<td width="525">: <?= $data['nama_mhs'] ?></td>
			</tr>
			<tr class="text2">
				<td>NPM</td>
				<td width="541">: <?= $data['npm'] ?></td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td width="525">: <?= $data['nama_prodi'] ?></td>
			</tr>
            <tr>
				<td>Fakultas</td>
				<td width="525">: <?= $data['nama_fakultas'] ?></td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Dinyatakan telah menyelesaikan kewajiban administarasi di UPT Perpustakaan Univeristas Bengkulu
                   Sebagiamana ditungakan dalam SK Rektor No.5987/J30/HK.2007 Tanggal 3 September 2007. <br>
                   Demikian keterangan ini agar dapat dipergunakan sebagaiman mestinya.

</font>
		       </td>
		    </tr>
		</table>
		<br>

        <?php
        $data1 = $this->db->query("SELECT * FROM user_role WHERE id_role = '1' ")->getRowArray(); ?>


		<table width="625">
			<tr>
				<td width="430"><br><br><br></td>
				<td class="text-align:center;" style="font-size:15px;" >
                Bengkulu, <?php
                        $tgl = date('d-m-Y');
                        echo $tgl; ?> <br>
                Kepala<br><br><br><br><br><?= $data1['nama_user'] ?></td>
			</tr>
	     </table>
	</center>
</body>
</html>