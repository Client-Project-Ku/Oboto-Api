@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- left column -->
            <div class="col">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Input Tempat </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleSelectBorder">Jenis Lokasi</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" required>
                          <option>Wisata</option>
                          <option>Event</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">Kota/Kabupaten</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" required>
                          <option>Kota Banjarmasin</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Tempat</label>
                      <input type="text" class="form-control" placeholder="Masukkan Nama Tempat" required>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <input type="text" class="form-control" placeholder="Masukkan Deskripsi" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Buka</label>
                      <input type="text" class="form-control" placeholder="Masukkan Jam Buka" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Tutup</label>
                      <input type="text" class="form-control" placeholder="Masukkan Jam Tutup" required>
                    </div>
                    <div class="form-group">
                      <label>Tiket Masuk</label>
                      <input type="text" class="form-control" placeholder="Masukkan Tiket per Orang " required>
                    </div>
                    <div class="form-group">
                      <label>Kontak Penanggung Jawab</label>
                      <input type="text" class="form-control" placeholder="Masukkan Kontak Penanggung Jawab" required>
                    </div>
                    <div class="form-group">
                      <label>Latitude</label>
                      <input type="text" class="form-control" placeholder="Masukkan Latitude Google Maps" required>
                    </div>
                    <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" class="form-control" placeholder="Masukkan Longitud Google Maps" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Gambar</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" required>
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
  
            </div>
          </div>
    </div>
@endsection
