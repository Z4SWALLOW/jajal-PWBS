<?php

namespace App\Http\Controllers;

use App\Models\MMaHasiswa;
use Illuminate\Http\Request;

class Mahasiswa extends Controller
{
    // inisialisasi pengambilan model
    protected $model;

    //  konstruktor
    function __construct()
    {
        // isi nilai variabel "$model"
        $this->model = new MMahasiswa();
    }

    function viewData()
    {
        // buat array data
        // $data = [
        //     "hasil1" => " Ini Hasil 1",
        //     "hasil2" => " Ini Hasil 2",
        //     "hasil3" => " Ini Hasil 3"
        // ];

        // $hasil = "Ini Contoh View Data API";

        // tampilkan respon
        // return response(["result" => $hasil], http_response_code());

        // jika mahasiswa tidak ada
        if (count($this->model->viewData()) == 0) {
            $data = [];
            $error = 1;
            $message = "Data Mahasiswa Tidk Ditemukan !";
        }
        // jika mahasiswa ada/tersedia
        else {
            // ambil method "viewData" dari model "MMahasiswa"
            $data = $this->model->viewData();
            $error = 0;
            $message = "";

        }

        return response(["mahasiswa" => $data, "error" => $error, "message" => "Data Mahasiswa Tidak Ditemukan"], http_response_code());

        // ambil method "viewData" dari model "MMahasiswa"
        $data = $this->model->viewData();

        // return response(["result" => $data], http_response_code());
    }
    // buat fungsi untuk tambah data
    function saveData(Request $req)
    {
        // ambil data npm
        $npm = $req->npm;

        // jika npm sudah ada
        if (count($this->model->checkSaveData($npm)) != 0) {
            $error = 1;
            $message = "Data Gagal Disimpan (NPM Sudah Terpakai !)";
        }

        // jika npm belum ada
        else {

            // ambil request
            $nama = $req->nama;
            $telpon = $req->telpon;
            $jurusan = $req->jurusan;



            // proses simpan data
            $this->model->saveData($npm, $nama, $telpon, $jurusan);

            $error = 0;
            $message = "Data Berhasil Disimpan";
        }

        return response(["error" => $error, "message" => $message], http_response_code());
    }


    // buat fungsi hapus data
    function deleteData($npm)
    {
        // cek apakah data mahasiswa (NPM) tersedia atau tidak pada model checkData
        if (count($this->model->checkData($npm)) == 1) {

            // panggil model "deleteData"
            $this->model->deleteData($npm);

            $error = 0;
            $message = "Data Berhasil Dihapus";
        }
        // jika data tidak tersedia
        else {
            $error = 0;
            $message = "Data Gagal Dihapus";
        }
    }
    // buat fungsi edit data
    function editData($npm_lama, Request $req )
    {

        // ambil data npm
        $npm = $req->npm;

        if (count($this->model->checkEditData($npm_lama, $npm)) == 0) {

            
            $nama = $req->nama;
            $telpon = $req->telpon;
            $jurusan = $req->jurusan;

            // panggil model "updateData"
            // $this->model->updateData($npm);

            $error = 1;
            $message = "Data Berhasil Diubah";
        }
        // jika data tidak tersedia
        else {
            $error = 1;
            $message = "Data Gagal Diubah (NPM sudah terpakai !)";
        }
    }
}
