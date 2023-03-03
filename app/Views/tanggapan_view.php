<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Pengaduan
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- content Row -->
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3>Tanggapan</h3>
                <a href="pengaduan" class="btn btn-primary">Tambah data</a>
            </div>
            <div class="card body">
                <form action="/pengaduan/filter" method="post" class="row">
                    <div class="col">
                        <select name="status" id="status"></select>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>