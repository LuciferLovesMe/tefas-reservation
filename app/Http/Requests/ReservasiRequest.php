<?php

namespace App\Http\Requests;

use App\Models\Reservasi;
use App\Models\Ruangan;
use App\Models\Tefa;
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
            'tefa_id' => 'required|integer|exists:tefas,id',
            'jadwal_mulai' => 'required|date|after:now',
            'jadwal_berakhir' => 'required|date|after:jadwal_mulai',
            'jumlah_peserta' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $jadwalMulai = $this->input('jadwal_mulai');
                    $jadwalBerakhir = $this->input('jadwal_berakhir');
                    $tefaId = $this->input('tefa_id');
                    $jumlahPesertaBaru = $value;

                    if (!$jadwalMulai || !$jadwalBerakhir) {
                        return;
                    }

                    $tefa = Tefa::find($tefaId);
                    $kapasitasTefa = $tefa->max_jumlah_peserta;

                    $pesertaTerjadwal = Reservasi::where('tefa_id', $tefaId)
                        ->where('status', '!=', 'cancel')
                        ->where(function ($query) use ($jadwalMulai, $jadwalBerakhir) {
                            $query->where('jadwal_mulai', '<', $jadwalBerakhir)
                                  ->where('jadwal_berakhir', '>', $jadwalMulai);
                        })
                        ->sum('jumlah_peserta');

                    $sisaKapasitas = $kapasitasTefa - $pesertaTerjadwal;

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
