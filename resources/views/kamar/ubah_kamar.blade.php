@extends('layouts.app')
@section('title', 'GassKos - Ubah Kamar')
@section('title_2', 'Ubah Kamar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Kamar</a></li>
    <li class="breadcrumb-item active">Ubah Kamar</li>
@endsection

@section('main_content')
<div class="card card-primary">
    <form method="POST" action="/kamar/update/{{ $kamar['id_kamar'] }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card-body">
    <div class="form-group">
            <label>Penginapan</label>
            <select name="penginapan" class="form-control" required autofocus>
                @if($kamar != null)
                    @foreach($penginapan as $data)
                        <option value="{{ $data['id_penginapan'] }}">{{ $data['nama'] }}</option>
                    @endforeach
                @endif
            </select>

            @if($errors->has('penginapan'))
                <div class="text-danger">{{ $errors->first('penginapan') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Tipe Kamar</label>
            <input type="text" class="form-control" name="tipe" value="{{ $kamar['tipe'] }}" required autofocus>

            @if($errors->has('tipe'))
                <div class="text-danger">{{ $errors->first('tipe') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="harga" value="{{ $kamar['harga'] }}" min="0" required>

            @if($errors->has('harga'))
                <div class="text-danger">{{ $errors->first('harga') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Fasilitas</label>
            <textarea class="form-control" name="fasilitas" required>{{ $kamar['fasilitas'] }}</textarea>

            @if($errors->has('fasilitas'))
                <div class="text-danger">{{ $errors->first('fasilitas')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" class="form-control" name="kapasitas" value="{{ $kamar['kapasitas'] }}" min="1" required>

            @if($errors->has('kapasitas'))
                <div class="text-danger">{{ $errors->first('kapasitas')}}</div>
            @endif
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<!-- /.card -->
@endsection

@section('javascript')

@endsection