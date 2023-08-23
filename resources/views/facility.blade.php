@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- left column -->
            <div class="col">
              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Input Fasilitas </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('fasilitas.store') }}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleSelectBorder">Pilih Tempat</label>
                        <select name="place_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                          @foreach ($place as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectBorder">Pilih Fasilitas</label>
                        <select name="facility_id" class="custom-select form-control-border" id="exampleSelectBorder" required>
                          @foreach ($facility as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
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
