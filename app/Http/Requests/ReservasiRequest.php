<?php

namespace App\Http\Requests;

use App\Models\Reservasi;
use App\Models\Ruangan;
use Illuminate\Foundation\Http\FormRequest;

class ReservasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ruangan_id' => 'required|integer|exists:ruangans,id',
            'tefa_id' => 'required|integer|exists:tefas,id',
            'jadwal_mulai' => 'required|date|after:now',
            'jadwal_berakhir' => 'required|date|after:jadwal_mulai',
            'jumlah_peserta' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $ruanganId = $this->input('ruangan_id');
                    $jadwalMulai = $this->input('jadwal_mulai');
                    $jadwalBerakhir = $this->input('jadwal_berakhir');
                    $jumlahPesertaBaru = $value;

                    if (!$ruanganId || !$jadwalMulai || !$jadwalBerakhir) {
                        return;
                    }

                    $ruangan = Ruangan::find($ruanganId);
                    if (!$ruangan) {
                        $fail("Ruangan yang dipilih tidak valid.");
                        return;
                    }
                    $kapasitasRuangan = $ruangan->kapasitas;

                    $pesertaTerjadwal = Reservasi::where('ruangan_id', $ruanganId)
                        ->where('status', '!=', 'cancel')
                        ->where(function ($query) use ($jadwalMulai, $jadwalBerakhir) {
                            $query->where('jadwal_mulai', '<', $jadwalBerakhir)
                                  ->where('jadwal_berakhir', '>', $jadwalMulai);
                        })
                        ->sum('jumlah_peserta');

                    $sisaKapasitas = $kapasitasRuangan - $pesertaTerjadwal;

                    if ($jumlahPesertaBaru > $sisaKapasitas) {
                        if ($sisaKapasitas <= 0) {
                            $fail("Ruangan sudah penuh pada jadwal yang dipilih.");
                        } else {
                            $fail("Jumlah peserta melebihi sisa kapasitas ruangan. Kapasitas yang tersedia pada jadwal tersebut adalah {$sisaKapasitas} orang.");
                        }
                    }
                },
            ],
        ];
    }
}
