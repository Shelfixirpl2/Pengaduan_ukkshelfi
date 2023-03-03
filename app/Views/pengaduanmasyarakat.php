<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Halaman Pengaduan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-succeess">
                <div class="card-header bg-info">
                    <h3 class="fw-bold text-ligt">Pengaduan</h3>
                    <a href="" data-toggle="model" data-target="#fPengaduan" data-pengaduan="add" class="btn btn-outline-light">
                        <i class="fas fa-user-plus"> &nbsp;From Pengaduan</i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="/pengaduan/filter" method="post" class="row">
                        <div class="col">
                            <select name="status" id="status" class="form-control">
                                <option value="">semua</option>
                                <option value="proses">Sedang Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengaduan</th>
                                <th>Nik</th>
                                <th>Laporan Pengaduan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        foreach ($pengaduanmasya as $row) {
                            $data = $row['id_pengaduan'] . "," . $row['tgl_pengaduan'] . "," . $row['nik'] . "," . $row['isi_laporan'] . "," . $row['foto'] . "," . $row['status'] . "," . base_url('pengaduan/edit/' . $row['id_pengaduan']);
                            #code... 
                            $no++;
                        ?>
                            <tr class="text-center">
                                <td><?= $no ?></td>
                                <td><?= $row['tgl_pengaduan'] ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['isi_laporan'] ?></td>
                                <td>
                                    <?php if ($row['foto'] != "") { ?>
                                        <img src="uploads/berkas/<?= $row['foto'] ?>" alt="" height="50" width="50">
                                    <?php } else {
                                    ?>
                                        Tidak Ada Gambar
                                    <?php
                                    } ?>
                                </td>
                                <td><?= $row['status'] ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] != "selesai") {
                                    ?>
                                        <a href="#" data-toggle="modal" data-target="#fPengaduan" data-pengaduan="<?= $data ?>" class="btn btn-success"><i class="fas fa-reply"></i>Tanggapi</a>
                                        <a href="/pengaduan/delete/<?= $row['id_pengaduan'] ?>" onclick="return confirm('Yakin Masu Hapus Data')" class="btn btn-danger"><i class="fa fas-trash"></i>Hapus</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="#" data-toggle="modal" data-target="#fPengaduan" data-pengaduan="<?= $data ?>" data-tanggapan="<?= $row['id_pengaduan'] ?>" class="btn btn-success"><i class="fas fa-reply"></i>Lihat Tanggapan</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php

                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<div class="modl fade" id="fPengaduan" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="#exampleModalLabel">Form Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-dismiss="modal"></span>
                </button>
            </div>
            <form action="addTanggapan" id="" method="post" enctype="multipart/form-data">
                <div class="modal-ledby">
                    <div class="form-group">
                        <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                        <input type="date" name="tgl_pengaduan" id="tgl_pengaduan" class="form-control" value="<?= date('yyy-mm-dd')?>">
                        <input type="hidden" name="id_pengaduan" id="id_pengaduan">
                    </div>
                    <div class="form-group">
                        <label for="nik">Nik</label>
                        <input type="nik" id="nik" class="form-control" value="<?= session('nik')?>">
                    </div>
                    <div class="form-group">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea name="isi_laporan" id="isi_laporan" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto"> Foto</label>
                        <img src="" id="foto" alt="" width="60" height="50">
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" id="tanggapan" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-fade">
                    <button type="submit" class="btn btn-primary fw-bold">Save Change</button>
                    <button type="button" class="btn btn-secondary fw-bold" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (!empty(session()->getFlashdata("message"))) :?>
    <div class="alert alert-success">
        <?= session()->getFlashdata("message")?>
    </div>
<?php endif ?>
<?= $this->endsection() ?>
<?= $this->section('script')?>
<script>
    $(document).ready(function(){
        $("#fPengaduan").on('show.bs.modal',function(e){
            var button = $(e.relatedTarget);
            var data = button.data('pengaduan');
    
            if (data != "add")
            {
                const barisdata = data.split(",");
                $("#id_Pengaduan").val(barisdata[0]);
                $("#tgl_pengaduan").val(barisdata(1));
                $("#nik").val(barisdata[2]);
                $("#isi_laporan").val(barisdata[3]);
                if (barisdata[4] != null) {
                    // $("#foto").attr("src","ulpoads/berkas/"+barisdata[4]);
                }
                $('status').val(barisdata[5]).change();
            }
            
        });
    });
</script>