<?php foreach ($laporan as $data) { ?>

<?php } ?>
<?php $this->db = db_connect(); ?>
<html>
<head>
	<title>Bebas Pustaka Fakultas </title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
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
                    <font size="4"><b>FAKULTAS <?= $data['nama_fakultas'] ?></b></font><br>
					<font size="4"><b>UNIVERSITAS BENGKULU</b></font><br>
					<font size="2">Jalan W.R Supratman Kandang Limun,Bengkulu 38371 A</font><br>
					<!-- <font size="2">Telepon/Faksimile (0736)21290,21170,21884 Pesawat 206.226</font> -->
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
			       <font size="2">Sehubungan dengan diadakanya Wisuda Sarjana mahasiswa Fakultas <b> <?= $data['nama_fakultas']; ?></b> Universitas Bengkulu
                    , kami dengan ini Menyatakan Mahasiswa :  </font>
		       </td>
		    </tr>
		</table>
		<br>
		</table>
		<table class="text2">
			<tr >
				<td>NPM</td>
				<td width="541">: <?= $data['npm'] ?></td>
			</tr>
			<tr >
				<td>Nama</td>
				<td width="525">: <?= $data['nama_mhs'] ?></td>
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
			       <font size="2">Nama tersebut di atas tidak memiliki sangkutan peminjaman buku pada Perpustakaan
                   Program Studi <?= strtolower($data['nama_prodi']) ?> Fakultas <?=  strtolower($data['nama_fakultas']) ?> Universitas Bengkulu dan
                   dapat dinyatakan telah <b>Bebas Pustaka</b>
</font>
		       </td>
		    </tr>
		</table>
		<br>



        <?php
        $kode_fakultas = $data['kode_fakultas'];
        $data1 = $this->db->query("SELECT * FROM user_role WHERE kode_fakultas = '$kode_fakultas' ")->getRowArray(); ?>


		<table width="625">
			<tr>
				<td width="430"><br><br><br></td>
				<td class="text-align:center;" style="font-size:15px;" >
                Bengkulu, <?php
                        $tgl = date('d-m-Y');
                        echo $tgl; ?> <br>
                Staf Perpustakaan<br><br><br><br><br><?= $data1['nama_user'] ?></td>
			</tr>
	     </table>
	</center>
</body>
</html>