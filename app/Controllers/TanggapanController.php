<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
class TanggapanController extends BaseController{
    protected $tanggapan,$pengaduan,$db;

    function __Construct()
    {
        $this->db = \Config\Database::connect();
        $this->tanggapans = New Tanggapan();
        $this->pengaduans = New Pengaduan();
    }

    public function lapor()
    {
        $data['tanggapan'] = $this->tanggapans->findAll();
        return view('admin/laporan', $data);
    }

    public function simpan()
    {
        $data = [
            'tgl_tanggapan' => date('Y-m-d H:i:s'),
            'id_petugas' => session()->get('id_petugas'),
            'tanggapan' => $this->request->getPost('tanggapan'),
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
        ];

        $this->tanggapans->insert($data);
        $this->pengaduans->set('status','Selesai');
        $this->pengaduans->where('id_pengaduan',$this->request->getPost('id_pengaduan'));
        $this->pengaduans->update();
        return redirect('pengaduan');
    } 

    public function getTanggapan()
    {
        $data = $this->tanggapans->where('id_pengaduan', $this->request->getGet('id_pengaduan'))->findAll();
        return response()->setJSON($data);
    }
}
