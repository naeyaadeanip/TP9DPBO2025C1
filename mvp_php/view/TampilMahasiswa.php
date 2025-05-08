<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa;
	private $tpl;

	function __construct()
	{
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$data = null;
		$action = isset($_GET['action']) ? $_GET['action'] : "";

		switch ($action) {
			case 'add':
				$this->tpl = new Template("templates/form.html");
				$this->tpl->replace("data_nim", "");
				$this->tpl->replace("data_nama", "");
				$this->tpl->replace("data_tempat", "");
				$this->tpl->replace("data_tl", "");
				$this->tpl->replace("data_laki", "");
				$this->tpl->replace("data_perempuan", "");
				$this->tpl->replace("data_email", "");
				$this->tpl->replace("data_telp", "");
				$this->tpl->write();
				break;

			case 'add_submit':
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$nim = $_POST['nim'];
					$nama = $_POST['nama'];
					$tempat = $_POST['tempat'];
					$tl = $_POST['tl'];
					$gender = $_POST['gender'];
					$email = $_POST['email'];
					$telp = $_POST['telp'];

					$this->prosesmahasiswa->prosesAddMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
					header("Location: index.php");
					exit;
				}
				break;

			case 'update':
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$this->prosesmahasiswa->prosesDataMahasiswaById($id);

					if ($this->prosesmahasiswa->getSize() > 0) {
						$this->tpl = new Template("templates/form.html");
						$this->tpl->replace("data_id", $this->prosesmahasiswa->getId(0));
						$this->tpl->replace("data_nim", $this->prosesmahasiswa->getNim(0));
						$this->tpl->replace("data_nama", $this->prosesmahasiswa->getNama(0));
						$this->tpl->replace("data_tempat", $this->prosesmahasiswa->getTempat(0));
						$this->tpl->replace("data_tl", $this->prosesmahasiswa->getTl(0));

						$selectedLaki = ($this->prosesmahasiswa->getGender(0) == "Laki-laki") ? "checked" : "";
						$selectedPerempuan = ($this->prosesmahasiswa->getGender(0) == "Perempuan") ? "checked" : "";
						$this->tpl->replace("data_laki", $selectedLaki);
						$this->tpl->replace("data_perempuan", $selectedPerempuan);

						$this->tpl->replace("data_email", $this->prosesmahasiswa->getEmail(0));
						$this->tpl->replace("data_telp", $this->prosesmahasiswa->getTelp(0));
						$this->tpl->write();
					} else {
						header("Location: index.php");
						exit;
					}
				}
				break;

			case 'update_submit':
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$id = $_POST['id'];
					$nim = $_POST['nim'];
					$nama = $_POST['nama'];
					$tempat = $_POST['tempat'];
					$tl = $_POST['tl'];
					$gender = $_POST['gender'];
					$email = $_POST['email'];
					$telp = $_POST['telp'];

					$this->prosesmahasiswa->prosesUpdateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
					header("Location: index.php");
					exit;
				}
				break;

			case 'delete':
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$this->prosesmahasiswa->prosesDeleteMahasiswa($id);
					header("Location: index.php");
					exit;
				}
				break;

			default:
				$this->prosesmahasiswa->prosesDataMahasiswa();
				$data = null;

				for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
					$no = $i + 1;
					$data .= "<tr>
					<td>" . $no . "</td>
					<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
					<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
					<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
					<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
					<td>
						<a href='index.php?action=update&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
						<a href='index.php?action=delete&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>
					</td>
					</tr>";
				}

				$this->tpl = new Template("templates/skin.html");
				$this->tpl->replace("DATA_TABEL", $data);
				$this->tpl->write();
		}
	}
}
