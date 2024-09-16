@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Buat List Hari ini!') }}</div>

        <div class="card-body">
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambahkan
          </button>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Kegiatan Kamu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="POST" action="{{ route('simpan') }}">
                  @csrf

                  <div class="form-group">
                    <label>Hari</label>
                    <select class="class form-control" name="hari">
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kegiatan</label>
                    <textarea class="form-control" name="kegiatan"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="class form-control" name="status">
                      <option value="Belum Mulai">Belum Mulai</option>
                      <option value="Proses">Proses</option>
                      <option value="Selesai">Selesai</option>
                  </div>


                  <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-primary">

                  </div>

                </form>
              </div>



            </div>
          </div>
        </div>
        <table class="table table-bordered table-hover">
          <tr>
            <td align="center">Hari</td>
            <td align="center">Tanggal</td>
            <td align="center">Kegiatan</td>
            <td align="center">Status</td>
            <td align="center">Delete</td>
          </tr>
          @foreach ($datas as $data)
          <tr>
            <td>{{ $data->hari }} </td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->kegiatan }} </td>
            <td>
              @if($data->status=='Belum Mulai')
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Belum Mulai'] )}}" class="btn btn-primary">Belum Mulai</a>
              @else
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Belum Mulai'] )}}" class="btn btn-outline-primary">Belum Mulai</a>
              @endif


              @if($data->status=='Proses')
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Proses'] )}}" class="btn btn-primary">Proses</a>
              @else
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Proses'] )}}" class="btn btn-outline-primary">Proses</a>
              @endif


              @if($data->status=='Selesai')
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Selesai'] )}}" class="btn btn-primary"> Selesai</a>
              @else
              <a href="{{ route ('ubahStatus', ['idkegiatan' =>$data->id, 'status'=>'Selesai'] )}}" class="btn btn-outline-primary"> Selesai</a>
              @endif
            <td>
              <a href="{{ route('hapus',['id'=> $data->id]) }}" class="btn btn-danger" id="hapus">Delete
            </td>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

</div>
</div>
</div>

@endsection