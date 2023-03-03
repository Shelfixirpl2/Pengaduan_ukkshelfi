<?= $this->extend('layouts/admin')?>
<?= $this->section('title')?>
Input Masyarakat
<?= $this->endSection()?>

<?= $this->Section('content')?>
<div class="card">
    <div class="card-header">
        <h3>From Input Masyarakt</h3>
    </div>
    <form action="addMasyarakat" method="post">
        <div class="card-body">
        <div class="form-group">
                <label for="nik"> Nik </label>
                <input type="number" name="nik" id="nik" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama_masyarakat"> Nama </label>
                <input type="text" name="nama_masyarakat" id="nama_masyarakat" class="form-control">
            </div>
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password"  class="form-control">
            </div>
            <div class="form-group">
                <label for="telp">NO. HP</label>
                <input type="number" name="telp" id="telp"  class="form-control">
            </div>
        </div>
        <div class="card-header">
            <input type="submit" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i>||<input type="reset" value="cancel" class="btn btn-secondary">
        </div>
    </form>
</div>
<?= $this->endSection()?>