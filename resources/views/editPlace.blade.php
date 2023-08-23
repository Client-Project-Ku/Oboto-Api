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
                <form method="POST" action="{{ route('place.update', $place->id) }}">
                  @method('PUT')
                  @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleSelectBorder">Jenis Lokasi</label>
                        <select name="category_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $place->category_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">Kota/Kabupaten</label>
                        <select name="district_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                            @foreach ($district as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $place->district_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Tempat</label>
                      <input type="text" name="name" class="form-control" value="{{ $place->name }}" required>
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <input type="text" name="description" class="form-control" value="{{ $place->description }}" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Buka</label>
                      <input type="time" name="open" class="form-control" value="{{ $place->open }}" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Tutup</label>
                      <input type="time" name="close" class="form-control" value="{{ $place->close }}" required>
                    </div>
                    <div class="form-group">
                      <label>Tiket Masuk</label>
                      <input type="number" name="ticket" class="form-control" value="{{ $place->ticket }}" required>
                    </div>
                    <div class="form-group">
                      <label>Kontak Penanggung Jawab</label>
                      <input type="text" name="contact" class="form-control" value="{{ $place->contact }}" required>
                    </div>
                    <div class="form-group">
                      <label>Latitude</label>
                      <input type="text" name="lat" class="form-control" value="{{ $place->lat }}" required>
                    </div>
                    <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" name="lng" class="form-control" value="{{ $place->lng }}" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectBorder">Fasilitas</label>
                      <select name="facility_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                          @foreach ($facility as $item)
                              <option value="{{ $item->id }}" {{ $item->id == $place->facility_id ? 'selected' : '' }}>
                                  {{ $item->name }}
                              </option>
                          @endforeach
                      </select>
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
