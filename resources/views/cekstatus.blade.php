@extends('components.layouts.page-nonseo')

@section('content')
    <style>
        /* Bootstrap-like form-control */
        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .50rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
        }
        /* Optional: form-group spacing */
        .form-group {
            margin-bottom: 1rem;
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }
        .form-control.is-invalid + .invalid-feedback {
            display: block;
        }
    </style>
<div class="news container animate-on-scroll" style="max-width:600px; margin:5rem auto; padding:2rem;">
    <h2 class="section-title">Cek Status Pendaftaran</h2>

    <form id="statusForm" class="flex flex-col gap-4" style="align-content: center; text-align: center; margin-top:2rem;">
        <input
            id="nomorInput"
            name="nomor_pendaftaran"
            type="text"
            placeholder="Masukkan Nomor Pendaftaran (contoh: TSM-015)"
            class="form-control"
            required
        >
        <br>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Cek Status
        </button>
    </form>
    
    <div id="result" class="mt-6 text-center text-lg" style="margin-top: 8px"></div>
</div>

<script>
    document.getElementById('statusForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const resultEl = document.getElementById('result');
        const nomor = document.getElementById('nomorInput').value.trim();

        if (!nomor) {
            resultEl.textContent = 'Silakan masukkan nomor pendaftaran.';
            resultEl.className = 'text-red-600';
            return;
        }

        resultEl.textContent = 'Memeriksa status...';
        resultEl.className = 'text-gray-600';

        try {
            const response = await fetch(`/api/cekstatus/${encodeURIComponent(nomor)}`);
            if (!response.ok) {
                throw new Error('Nomor pendaftaran tidak ditemukan');
            }

            const data = await response.json();
            // data = { id, nama, nomor_pendaftaran, is_accepted }

            if (data.is_accepted) {
                resultEl.innerHTML = `
                    <p>Halo <strong>${data.nama}</strong>,</p>
                    <p>Nomor Pendaftaran <strong>${data.nomor_pendaftaran}</strong></p>
                    <p>Tes Fisik <strong>${data.status_fisik}</strong></p>
                    <p class="text-green-600 font-semibold">Selamat! Anda diterima.</p>
                `;
            } else {
                resultEl.innerHTML = `
                    <p>Halo <strong>${data.nama}</strong>,</p>
                    <p>Nomor Pendaftaran <strong>${data.nomor_pendaftaran}</strong></p>
                    <p>Tes Fisik <strong>${data.status_fisik}</strong></p>
                    <p class="text-yellow-600 font-semibold">Maaf, Anda belum diterima.</p>
                `;
            }
        } catch (err) {
            resultEl.textContent = err.message;
            resultEl.className = 'text-red-600';
        }
    });
</script>
@endsection
