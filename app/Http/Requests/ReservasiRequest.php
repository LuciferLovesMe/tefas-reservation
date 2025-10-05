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
            'tefa_id' => 'required|integer', // Sesuaikan jika ada tabel tefa
            'jumlah_peserta' => [
                'required',
                'integer',
                'min:1',
                // Validasi custom untuk cek kapasitas ruangan
                function ($attribute, $value, $fail) {
                    $ruangan = Ruangan::find($this->input('ruangan_id'));
                    if ($ruangan && $value > $ruangan->kapasitas) {
                        $fail("Jumlah peserta melebihi kapasitas ruangan ({$ruangan->kapasitas} orang).");
                    }
                },
            ],
            'jadwal_mulai' => [
                'required',
                'date',
                'after:now',
                // Validasi custom untuk cek jadwal bentrok
                function ($attribute, $value, $fail) {
                    $jadwalBerakhir = $this->input('jadwal_berakhir');
                    $ruanganId = $this->input('ruangan_id');

                    $isOverlapping = Reservasi::where('ruangan_id', $ruanganId)
                        ->where('status', '!=', 'cancel')
                        ->where(function ($query) use ($value, $jadwalBerakhir) {
                            $query->where(function($q) use ($value, $jadwalBerakhir) {
                                // Cek jika jadwal baru dimulai di tengah jadwal yang sudah ada
                                $q->where('jadwal_mulai', '<=', $value)
                                  ->where('jadwal_berakhir', '>', $value);
                            })->orWhere(function($q) use ($value, $jadwalBerakhir) {
                                // Cek jika jadwal baru berakhir di tengah jadwal yang sudah ada
                                $q->where('jadwal_mulai', '<', $jadwalBerakhir)
                                  ->where('jadwal_berakhir', '>=', $jadwalBerakhir);
                            })->orWhere(function($q) use ($value, $jadwalBerakhir) {
                                // Cek jika jadwal baru mencakup sepenuhnya jadwal yang sudah ada
                                $q->where('jadwal_mulai', '>=', $value)
                                  ->where('jadwal_berakhir', '<=', $jadwalBerakhir);
                            });
                        })
                        ->exists();

                    if ($isOverlapping) {
                        $fail('Jadwal bentrok! Ruangan sudah dipesan pada rentang waktu tersebut.');
                    }
                }
            ],
            'jadwal_berakhir' => 'required|date|after:jadwal_mulai',
        ];
    }
}
