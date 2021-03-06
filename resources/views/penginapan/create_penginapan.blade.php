@extends('layouts.app')
@section('title', 'GassKos - Tambah Penginapan')
@section('title_2', 'Tambah Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Tambah Penginapan</li>
@endsection

@section('main_content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ route('penginapan.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Gender Penginapan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Pria">
                            <label class="form-check-label">Pria</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Wanita">
                            <label class="form-check-label">Wanita</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Campur">
                            <label class="form-check-label">Campur (Pria & Wanita)</label>
                        </div>

                        @if($errors->has('gender'))
                            <div class="text-danger">{{ $errors->first('gender')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nama Penginapan</label>
                        <input type="text" class="form-control form-control-sm" name="nama" maxlength="35" value="{{ old('nama') }}" required>

                        @if($errors->has('nama'))
                            <div class="text-danger">{{ $errors->first('nama')}}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Alamat Penginapan</label>
                        <textarea class="form-control form-control-sm" name="alamat" required>{{ old('alamat') }}</textarea>

                        @if($errors->has('alamat'))
                            <div class="text-danger">{{ $errors->first('alamat') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Map</label>
                        <div id='map' style='width: 100%; height: 300px;'></div>
                        <small class="form-text text-muted">Perbarui lokasi terkini anda dengan mengklik button di pojok kanan atas, lalu klik lokasi penginapan pada map di atas sampai muncul marker</small>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label>Latitude</label>
                                <input type="text" class="form-control form-control-sm" id="latitude" name="latitude" readonly>
                            </div>
                            <div class="col-6">
                                <label>Longitude</label>
                                <input type="text" class="form-control form-control-sm" id="longitude" name="longitude" readonly>
                            </div>

                            @if($errors->has('latitude'))
                                <div class="text-danger">{{ $errors->first('latitude') }}</div>
                            @endif
                            @if($errors->has('longitude'))
                                <div class="text-danger">{{ $errors->first('longitude') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="tel" class="form-control form-control-sm" name="telepon" value="{{ old('telepon') }}" maxlength="13" required>
                        <small class="form-text text-muted">Format nomor telepon : 08xxxxxxxxxx</small>

                        @if($errors->has('telepon'))
                            <div class="text-danger">{{ $errors->first('telepon')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Foto Penginapan</label>
                        <input type="file" class="form-control-file" name="foto[]" accept="image/*" multiple required>
                        <small class="form-text text-muted">Diperbolehkan upload banyak foto</small>

                        @if($errors->has('foto'))
                            <div class="text-danger">{{ $errors->first('foto')}}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Fasilitas Penginapan</label>
                        @foreach($masterfasilitas as $data)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $data->id_fasilitas }}">
                                <label class="form-check-label">{{ $data->nama }}</label>
                            </div>
                        @endforeach
                        <small class="form-text text-muted">Fasilitas yang tersedia pada penginapan (diperbolehkan lebih dari satu)</small>

                        @if($errors->has('fasilitas'))
                            <div class="text-danger">{{ $errors->first('fasilitas')}}</div>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
    <script>
        var counter = 0;
        mapboxgl.accessToken = 'pk.eyJ1IjoicHJhZGl0eWFuYWZpaXMiLCJhIjoiY2szZHRqd2ZyMTkwZDNibjN3NGYwOWQ5aCJ9.zgu0saWV5-ZBgVA15jZfQw';
        
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [112.808304, -7.275973],
            zoom: 8,
        });

        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserLocation: true
        }));

        function addMarker(ltlng) {
            marker = new mapboxgl.Marker({draggable: false, color:"#d02922"}).setLngLat(ltlng).addTo(map).on('dragend', onDragEnd);
            counter++;
        }

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            $('#latitude').val(lngLat.lat);
            $('#longitude').val(lngLat.lng);
        }

        map.on('click', function (e) {
            if (counter != 0) {
                marker.remove();   
            }
            addMarker(e.lngLat);
            $('#latitude').val(e.lngLat.lat);
            $('#longitude').val(e.lngLat.lng);
        });
    </script>
@endsection