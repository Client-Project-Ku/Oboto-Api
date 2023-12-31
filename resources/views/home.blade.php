@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row pt-4">
            <div class="col col-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-map"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Wisata</span>
                      <span class="info-box-number">{{ $wisata }}</span>
                    </div>
                  </div>
            </div>
            <div class="col col-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Event</span>
                      <span class="info-box-number">{{ $event }}</span>
                    </div>
                  </div>
            </div>
            <div class="col col-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Pengguna Terdaftar</span>
                      <span class="info-box-number">{{ $user }}</span>
                    </div>
                  </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Tempat</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kota/Kabupaten</th>
                        <th>Jam Operasional</th>
                        <th>Tiket</th>
                        <th>Tipe</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($data as $data)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->district->name }}</td>
                        <td><span class="tag tag-success">{{ $data->open . ' - ' . $data->close}}</span></td>
                        <td>{{ $data->ticket }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->placeCategory->name ??'-' }}</td>
                        <td>
                          <a href="{{ route('place.edit', $data->id) }}">Edit</a>
                        </td>
                      </tr>
                      @empty
                          
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
    </div>
@endsection
