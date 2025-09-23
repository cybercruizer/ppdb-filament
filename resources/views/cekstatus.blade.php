@extends('components.layouts.page')

@section('content')
<section class="news" id="berita">
<div class="container py-5">
    <h2 class="text-center mb-4">Periksa Status Pendaftaran</h2>

    <!-- Form -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form id="check-form" class="check-form d-flex">
                <input type="text" id="nomor_pendaftaran" class="form-control me-2" placeholder="Masukkan Nomor Pendaftaran">
                <button type="submit" class="btn btn-primary">Periksa</button>
            </form>
        </div>
    </div>

    <!-- Result -->
    <div id="result" class="row justify-content-center" style="display:none;">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Detail Pendaftaran
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td id="student_id"></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td id="student_nama"></td>
                            </tr>
                            <tr>
                                <th>Nomor Pendaftaran</th>
                                <td id="student_nomor"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="student_status"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Error message -->
    <div id="error" class="alert alert-danger text-center mt-4" style="display:none;">
        Nomor pendaftaran tidak ditemukan.
    </div>
</div>
</section>
@endsection

@push('styles')
<style>
    .check-form {
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 12px 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease-in-out;
    }

    .check-form:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13,110,253,0.15);
    }

    .check-form input {
        border-radius: 8px;
        font-size: 1rem;
        padding: 10px 14px;
    }

    .check-form button {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: background 0.3s ease-in-out;
    }

    .check-form button:hover {
        background: #0b5ed7;
    }
</style>
@endpush

@push('scripts')
<script>
document.getElementById('check-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let nomor = document.getElementById('nomor_pendaftaran').value.trim();

    if (!nomor) {
        alert("Masukkan nomor pendaftaran terlebih dahulu.");
        return;
    }

    // Ajax call to check student
    fetch(`/api/cekstatus/${nomor}`)
        .then(res => res.json())
        .then(data => {
            if (data && data.id) {
                document.getElementById('student_id').innerText = data.id;
                document.getElementById('student_nama').innerText = data.nama;
                document.getElementById('student_nomor').innerText = data.nomor_pendaftaran;
                document.getElementById('student_status').innerText = data.is_accepted ? 'DITERIMA' : 'BELUM DITERIMA';

                document.getElementById('result').style.display = 'block';
                document.getElementById('error').style.display = 'none';
            } else {
                document.getElementById('result').style.display = 'none';
                document.getElementById('error').style.display = 'block';
            }
        })
        .catch(() => {
            document.getElementById('result').style.display = 'none';
            document.getElementById('error').style.display = 'block';
        });
});
</script>
@endpush
