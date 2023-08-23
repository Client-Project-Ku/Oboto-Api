@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- left column -->
            <div class="col">
              @if(isset($success))
                  <div class="alert alert-success">
                      {{ $success }}
                  </div>
              @endif
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Input Tempat </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('place.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleSelectBorder">Jenis Lokasi</label>
                        <select name="category_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                          @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">Kota/Kabupaten</label>
                        <select name="district_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                          @foreach ($district as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Tempat</label>
                      <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Tempat" required>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <input type="text" name="description" class="form-control" placeholder="Masukkan Deskripsi" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Buka</label>
                      <input type="time" name="open" class="form-control" placeholder="Masukkan Jam Buka" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Tutup</label>
                      <input type="time" name="close" class="form-control" placeholder="Masukkan Jam Tutup" required>
                    </div>
                    <div class="form-group">
                      <label>Tiket Masuk</label>
                      <input type="number" name="ticket" class="form-control" placeholder="Masukkan Tiket per Orang " required>
                    </div>
                    <div class="form-group">
                      <label>Kontak Penanggung Jawab</label>
                      <input type="text" name="contact" class="form-control" placeholder="Masukkan Kontak Penanggung Jawab" required>
                    </div>
                    <div class="form-group">
                      <label>Latitude</label>
                      <input type="text" name="lat" class="form-control" placeholder="Masukkan Latitude Google Maps" required>
                    </div>
                    <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" name="lng" class="form-control" placeholder="Masukkan Longitud Google Maps" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectBorder">Fasilitas</label>
                      <select name="facility_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                        @foreach ($facility as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                  </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Gambar</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input" id="exampleInputFile" required>
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
