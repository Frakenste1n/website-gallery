@extends('layouts.panel')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Pengaturan Website</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- General Settings -->
                    <div class="col-md-6">
                        <h4>Pengaturan Umum</h4>
                        
                        <div class="form-group">
                            <label>Judul Website</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $setting->title ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                            @if($setting->favicon ?? false)
                                <img src="{{ asset('storage/' . $setting->favicon) }}" class="mt-2" style="height: 32px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($setting->logo ?? false)
                                <img src="{{ asset('storage/' . $setting->logo) }}" class="mt-2" style="height: 50px">
                            @endif
                        </div>
                    </div>

                    <!-- Header Settings -->
                    <div class="col-md-6">
                        <h4>Pengaturan Header</h4>
                        
                        <div class="form-group">
                            <label>Background Header</label>
                            <input type="file" name="header_background" class="form-control">
                            @if($setting->header_background ?? false)
                                <img src="{{ asset('storage/' . $setting->header_background) }}" class="mt-2" style="height: 100px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Teks Header</label>
                            <input type="text" name="header_text" class="form-control" value="{{ old('header_text', $setting->header_text ?? '') }}" required>
                        </div>
                    </div>

                    <!-- About Settings -->
                    <div class="col-md-12 mt-4">
                        <h4>Pengaturan About</h4>
                        
                        <div class="form-group">
                            <label>Gambar About</label>
                            <input type="file" name="about_image" class="form-control">
                            @if($setting->about_image ?? false)
                                <img src="{{ asset('storage/' . $setting->about_image) }}" class="mt-2" style="height: 100px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Judul About</label>
                            <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $setting->about_title ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi About</label>
                            <textarea name="about_description" class="form-control" rows="4" required>{{ old('about_description', $setting->about_description ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Footer Settings -->
                    <div class="col-md-12 mt-4">
                        <h4>Pengaturan Footer</h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="footer_address" class="form-control" rows="3" required>{{ old('footer_address', $setting->footer_address ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="footer_phone" class="form-control" value="{{ old('footer_phone', $setting->footer_phone ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="footer_email" class="form-control" value="{{ old('footer_email', $setting->footer_email ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Facebook URL</label>
                                    <input type="url" name="footer_facebook" class="form-control" value="{{ old('footer_facebook', $setting->footer_facebook ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>Instagram URL</label>
                                    <input type="url" name="footer_instagram" class="form-control" value="{{ old('footer_instagram', $setting->footer_instagram ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>YouTube URL</label>
                                    <input type="url" name="footer_youtube" class="form-control" value="{{ old('footer_youtube', $setting->footer_youtube ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 