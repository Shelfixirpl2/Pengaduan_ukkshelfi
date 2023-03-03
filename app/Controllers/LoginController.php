<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Petugas;
use App\Models\Masyarakat;


class LoginController extends BaseController
{
    protected $masyarakats;
    function __construct()
    {
        $this->masyarakats = new Masyarakat();
    }
    public function index()
    {
        return view('login_view');
    }
    public function register()
    {
        return view('register_view');
    }
    public function saveRegister()
    {
        $ceknik = $this->masyarakats->where('nik', $this->request->getPost('nik'))->findall();
        if ($ceknik == null) {
            $data = array(
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password') . "", PASSWORD_DEFAULT),
                'telp' => $this->request->getPost('telp')
            );
            $this->masyarakats->insert($data);
            return redirect('login');
        } else {
            return redirect('register')->with('error', lang('Nik Sudah Terdaftar'));
        }
    }
    public function login()
    {
        $masya = new Masyarakat();
        $petugas = new Petugas();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password') . "";
        $cekPetugas = $petugas->where(['username' => $username])->first();
        $cekmasya = $masya->where(['username' => $username])->first();
        if (!($cekmasya == null) && !($cekPetugas == null)) {
            return redirect('login')->with("error", lang('Username Tidak Ditemukan'));
        } else {
            if ($cekmasya) {
                if (password_verify($password, $cekmasya['password'])) {
                    session()->set([
                        'nik' => $cekmasya['nik'],
                        'nama' => $cekmasya['nama'],
                        'level' => 'masyarakat',
                        'log_in' => true,
                    ]);
                    return redirect('/');
                } else {
                    return redirect('login')->with('error', lang('Password Masyarakat Salah'));
                }
            }
            if ($cekPetugas) {
                if (password_verify($password, $cekPetugas['password'])) {
                    session()->set([
                        'id_petugas' => $cekPetugas['id_petugas'],
                        'nama' => $cekPetugas['nama_petugas'],
                        'level' => $cekPetugas['level'],
                        'log_in' => true,
                    ]);
                    return redirect('/');
                } else {
                    return redirect('login')->with("error", lang('Password Petugas Salah'));
                }
            }
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return $this->response->redirect('login');
    }

    public function lihatProfil()
    {
        $petugas = new Petugas();
        $masyarakats = new Masyarakat();
        if (session('level') == 'masyarakat') {
            $data['user'] = $masyarakats->where('nik', session('nik'))->findAll();
        } else {
            $data['user'] = $petugas->where('id_petugas', session('id_petugas'))->findAll();
        }
        return view('profil_view', $data);
    }

    public function editProfil()
    {
        $petugass = new Petugas();
        $masyarakats = new Masyarakat();
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $telp = $this->request->getPost('telp');
        $pass_old = $this->request->getPost('password_old');
        $pass_new = $this->request->getPost('password_new');

        if (session('level') == 'masyarakat') {
            $datamasy = $masyarakats->where('id_masyarakat', $id)->first();
            if (empty($pass_old)) {
                $data = [
                    'nama' => $nama,
                    'username' => $username,
                    'telp' => $telp,
                ];
            } else {
                if (password_verify($pass_old, $datamasy['password'])) {
                    $data = [
                        'nama' => $nama,
                        'username' => $username,
                        'telp' => $telp,
                        'password' => password_hash($pass_new, PASSWORD_DEFAULT)
                    ];
                }
            }
            $masyarakats->update($id, $data);
        } else {
            $datapetugas = $petugass->where('id_petugas', $id)->first();
            if (empty($pass_old)) {
                $data = [
                    'nama_petugas' => $nama,
                    'username' => $username,
                    'telp' => $telp,
                ];
            } else {
                if (password_verify($pass_old, $datapetugas['password'])) {
                    $data = [
                        'nama_petugas' => $nama,
                        'username' => $username,
                        'telp' => $telp,
                        'password' => password_hash($pass_new, PASSWORD_DEFAULT)
                    ];
                }
            }
            $petugass->update($id, $data);
        }
        session()->setFlashdata('sukses', 'Update profil berhasil');
        return redirect('profil');
    }
}
