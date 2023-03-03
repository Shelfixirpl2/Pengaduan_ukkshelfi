<?= $this->extend('layouts/admin')?>
<?= $this->section('title')?>
Input Petugas
<?= $this->endSection()?>

<?= $this->section('content')?>
<div class="card">
    <div class="card-header">
        <h3>From Input Petugas</h3>
    </div>
    <form action="addPetugas" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="nama_petugas">NAMA</label>
                <input type="text" name="nama_petugas" id="nama_petugas"  class="form-control">
            </div>
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" name="username" id="username"  class="form-control">
            </div>
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password"  class="form-control">
            </div>
            <div class="form-group">
                <label for="telp">NO. HP</label>
                <input type="number" name="telp" id="telp"  class="form-control">
            </div>
    
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" class="form-control"  id="level">
                    <option value="">Pilih Hak Akses</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
        </div>
        <div class="card-header">
            <input type="submit" value="simpan" class="btn btn-primary">||
            <input type="reset" value="cancel" class="btn btn-secondary">
        </div>
    </form>
</div>
<?= $this->endSection()?>