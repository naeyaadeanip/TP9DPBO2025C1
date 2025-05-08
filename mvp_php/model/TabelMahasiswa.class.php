<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

class TabelMahasiswa extends DB
{
	function getMahasiswa()
	{
		$query = "SELECT * FROM mahasiswa";
		
		return $this->execute($query);
	}

	function getMahasiswaById($id)
	{
		$query = "SELECT * FROM mahasiswa WHERE id = '$id'";

		return $this->execute($query);
	}

	function addMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$query = "INSERT INTO mahasiswa (nim, nama, tempat, tl, gender, email, telp) 
				VALUES ('$nim', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";

		return $this->execute($query);
	}

	function updateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$query = "UPDATE mahasiswa 
				SET nim = '$nim', 
					nama = '$nama', 
					tempat = '$tempat', 
					tl = '$tl', 
					gender = '$gender', 
					email = '$email', 
					telp = '$telp' 
				WHERE id = '$id'";
		
		return $this->execute($query);
	}

	function deleteMahasiswa($id)
	{
		$query = "DELETE FROM mahasiswa WHERE id = '$id'";
		
		return $this->execute($query);
	}

}
