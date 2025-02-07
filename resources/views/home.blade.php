@extends('layouts.app')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat List Hari ini!') }}</div>

                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambahkan
                        </button>
                    </div>

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Kegiatan Kamu</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('simpan') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Hari</label>
                                            <select class="form-control" name="hari">
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
                                            <select class="form-control" name="status">
                                                <option value="Belum Mulai">Belum Mulai</option>
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Simpan" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-hover mt-3">
                        <tr>
                            <th align="center">Hari</th>
                            <th align="center">Tanggal</th>
                            <th align="center">Kegiatan</th>
                            <th align="center">Status</th>
                            <th align="center">Aksi</th>
                        </tr>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->hari }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->kegiatan }}</td>
                                <td>
                                    <a href="{{ route('ubahStatus', ['idkegiatan' => $data->id, 'status' => 'Belum Mulai']) }}" class="btn {{ $data->status == 'Belum Mulai' ? 'btn-primary' : 'btn-outline-primary' }}">Belum Mulai</a>
                                    <a href="{{ route('ubahStatus', ['idkegiatan' => $data->id, 'status' => 'Proses']) }}" class="btn {{ $data->status == 'Proses' ? 'btn-primary' : 'btn-outline-primary' }}">Proses</a>
                                    <a href="{{ route('ubahStatus', ['idkegiatan' => $data->id, 'status' => 'Selesai']) }}" class="btn {{ $data->status == 'Selesai' ? 'btn-primary' : 'btn-outline-primary' }}">Selesai</a>
                                </td>
                                <td>
                                    <a href="{{ route('hapus', ['id' => $data->id]) }}" class="btn btn-danger">Delete</a>
                                    <button type="button" class="btn btn-warning btn-edit" data-id="{{ $data->id }}" data-hari="{{ $data->hari }}" data-kegiatan="{{ $data->kegiatan }}" data-status="{{ $data->status }}">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kegiatan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari" id="editHari">
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
                            <textarea class="form-control" name="kegiatan" id="editKegiatan"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".btn-edit").click(function () {
                let id = $(this).data("id");
                let hari = $(this).data("hari");
                let kegiatan = $(this).data("kegiatan");
                let status = $(this).data("status");

                $("#editId").val(id);
                $("#editHari").val(hari);
                $("#editKegiatan").val(kegiatan);
                $("#editStatus").val(status);
                $("#editForm").attr("action", "/editproses/" + id);
                $("#editModal").modal("show");
            });
        });
    </script>
@endsection
