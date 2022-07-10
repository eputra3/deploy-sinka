<?php

//Dynamic_dependent.php

namespace App\Controllers;

use App\Models\KotaKabupatenModel;

use App\Models\KecamatanModel;

use App\Models\KelurahanDesaModel;

class Dynamic_dependent extends BaseController
{
	function index()
	{
		$kotakabupatenModel = new KotaKabupatenModel();

		$data['title'] = 'Dropdown Alamat';

		$data['kota_kabupaten'] = $kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll();

		return view('jadwal_imunisasi/dynamic_dependent', $data);
	}

	function action()
	{
		if ($this->request->getVar('action')) {
			$action = $this->request->getVar('action');

			if ($action == 'get_kecamatan') {
				$kecamatanModel = new KecamatanModel();

				$kecamatandata = $kecamatanModel->where('kota_kabupaten_id', $this->request->getVar('kota_kabupaten_id'))->findAll();

				echo json_encode($kecamatandata);
			}

			if ($action == 'get_kelurahan_desa') {
				$kelurahandesaModel = new KelurahanDesaModel();
				$kelurahandesadata = $kelurahandesaModel->where('kecamatan_id', $this->request->getVar('kecamatan_id'))->findAll();

				echo json_encode($kelurahandesadata);
			}
		}
	}
}
