<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanmasyaController extends BaseController{
    protected $pengaduans;
    protected $tanggapans;

    function __construct()
    {
        $this->pengaduans = new Pengaduan();
        $this->tanggapans = new Tanggapan();
    }

    public function create()
    {
        return view('pengaduanmasyarakat');
    }

    public function index()
    {
        if (session()->get('nik') !=null )
        {
            $data['pengaduanmasya']= $this->pengaduans->where('nik',session('nik'))->findAll();
        }
        else
        {
            $data['pengaduanmasya']= $this->pengaduans->findAll();
        }
        return view('pengaduanmasyarakat',$data);
    }
    public function save()
    {
        $dataBerkas = $this->request->getfile('foto');
        $filename = $dataBerkas->getRandomName();
        $data= array(
            'tgl_pengaduan'=>$this->request->getPost('tgl_pengaduan'),
            'nik'=>$this->request->getPost('nik'),
            'isi_laporan'=>$this->request->getPost('isi_laporan'),
            'foto'=>$filename,
            'status'=>$this->request->getPost('status'),
        );
        $dataBerkas->move('uploads/berkas/',$filename);
        $this->pengaduans->insert($data);

        session()->setFlashdata("message","Data Berhasil Disimpan");
        return $this->response->redirect('/pengaduan');
    }
    public function edit($id)
    {
        $data= array(
            'tgl_pengaduan'=>$this->request->getPost('tgl_pengaduan'),
            'nik'=>$this->request->getPost('nik'),
            'isi_laporan'=>$this->request->getPost('isi_laporan'),
            'foto'=>$this->request->getPost('foto'),
            'status'=>$this->request->getPost('status'),
        );
        $this->pengaduans->update($id,$data);
        session()->setFlashdata("message","Data Berhasil Diubah");
        return $this->response->redirect('/pengaduan');
    }
    public function delete($id)
    {
        $this->pengaduans->delete($id);
        session()->setFlashdata("message","Data Berhasil di Hapus");
        return $this->response->redirect('/pengaduan');
    }
    public function gettanggapan()
    {
        $id_pengaduan = $this->request->getGet('id_pengaduan');
        $data = $this->tanggapans->where('id_pengaduan', $id_pengaduan)->findAll();
        return $this->response->setJSON($data);
    }

}