@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Lengkap</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
        
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border small" placeholder="Cari Data..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Text Input -->
                <div class="form-group row">
                    <label for="text_input" class="col-sm-2 col-form-label">Text Input</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="text_input" name="text_input" placeholder="Masukkan teks">
                    </div>
                </div>

                <!-- Email Input -->
                <div class="form-group row">
                    <label for="email_input" class="col-sm-2 col-form-label">Email Input</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Masukkan email">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="form-group row">
                    <label for="password_input" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_input" name="password_input" placeholder="Masukkan password">
                    </div>
                </div>

                <!-- Number Input -->
                <div class="form-group row">
                    <label for="number_input" class="col-sm-2 col-form-label">Number Input</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="number_input" name="number_input" placeholder="Masukkan angka">
                    </div>
                </div>

                <!-- Date Input -->
                <div class="form-group row">
                    <label for="date_input" class="col-sm-2 col-form-label">Date Input</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date_input" name="date_input">
                    </div>
                </div>

                <!-- Time Input -->
                <div class="form-group row">
                    <label for="time_input" class="col-sm-2 col-form-label">Time Input</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="time_input" name="time_input">
                    </div>
                </div>

                <!-- File Upload -->
                <div class="form-group row">
                    <label for="file_input" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_input" name="file_input">
                            <label class="custom-file-label" for="file_input">Pilih file</label>
                        </div>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group row">
                    <label for="textarea_input" class="col-sm-2 col-form-label">Textarea</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="textarea_input" name="textarea_input" rows="3"></textarea>
                    </div>
                </div>

                <!-- Select Dropdown -->
                <div class="form-group row">
                    <label for="select_input" class="col-sm-2 col-form-label">Select Dropdown</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="select_input" name="select_input">
                            <option value="">Pilih opsi</option>
                            <option value="1">Opsi 1</option>
                            <option value="2">Opsi 2</option>
                            <option value="3">Opsi 3</option>
                        </select>
                    </div>
                </div>

                <!-- Multiple Select -->
                <div class="form-group row">
                    <label for="multiple_select" class="col-sm-2 col-form-label">Multiple Select</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control" id="multiple_select" name="multiple_select[]">
                            <option value="1">Opsi 1</option>
                            <option value="2">Opsi 2</option>
                            <option value="3">Opsi 3</option>
                            <option value="4">Opsi 4</option>
                        </select>
                    </div>
                </div>

                <!-- Radio Buttons -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Radio Buttons</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_input" id="radio1" value="1" checked>
                            <label class="form-check-label" for="radio1">
                                Opsi 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_input" id="radio2" value="2">
                            <label class="form-check-label" for="radio2">
                                Opsi 2
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Checkboxes -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Checkboxes</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox_input[]" value="1">
                            <label class="form-check-label" for="checkbox1">
                                Opsi 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox2" name="checkbox_input[]" value="2">
                            <label class="form-check-label" for="checkbox2">
                                Opsi 2
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Color Picker -->
                <div class="form-group row">
                    <label for="color_input" class="col-sm-2 col-form-label">Color Picker</label>
                    <div class="col-sm-10">
                        <input type="color" class="form-control" id="color_input" name="color_input" value="#563d7c">
                    </div>
                </div>

                <!-- Range Slider -->
                <div class="form-group row">
                    <label for="range_input" class="col-sm-2 col-form-label">Range Slider</label>
                    <div class="col-sm-10">
                        <input type="range" class="form-control-range" id="range_input" name="range_input" min="0" max="100">
                    </div>
                </div>

                <!-- Hidden Input -->
                <input type="hidden" name="hidden_input" value="hidden_value">

                <!-- Submit Button -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk menampilkan nama file yang dipilih -->
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("file_input").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endsection