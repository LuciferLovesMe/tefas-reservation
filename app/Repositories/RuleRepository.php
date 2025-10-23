<?php

namespace App\Repositories;

use App\Interfaces\RuleInterface;
use App\Models\Rule;

class RuleRepository implements RuleInterface
{
    public function getAll ()
    {
        return Rule::with(
            'jenisKunjungan:id,nama',
            'aktivitas:id,nama',
            'capaianPembelajaran:id,nama',
            'tefa:id,nama'
        )->orderBy('prioritas', 'asc')->get();
    }

    public function getById ($id)
    {
        return Rule::where('id', $id)->with(
            'jenisKunjungan:id,nama',
            'aktivitas:id,nama',
            'capaianPembelajaran:id,nama'
        )->first();
    }

    public function store ($data)
    {
        $prioritas = 0;
        if (is_null($data->jenis_kunjungan_id)) $prioritas++;
        if (is_null($data->aktivitas_id)) $prioritas++;
        if (is_null($data->capaian_pembelajaran_id)) $prioritas++;
        if (is_null($data->jenjang_id)) $prioritas++;

        return Rule::create([
            'jenis_kunjungan_id' => $data->jenis_kunjungan_id,
            'aktivitas_id' => $data->aktivitas_id,
            'capaian_pembelajaran_id' => $data->capaian_pembelajaran_id,
            'tefa_id' => $data->tefa_id,
            'prioritas' => $prioritas + 1,
            'jenjang' => convertJenjang($data->jenjang_id),
        ]);
    }

    public function update ($id, $data)
    {
        $rule = Rule::find($id);
        $prioritas = 0;
        if (is_null($data->jenis_kunjungan_id)) $prioritas++;
        if (is_null($data->aktivitas_id)) $prioritas++;
        if (is_null($data->capaian_pembelajaran_id)) $prioritas++;
        if (is_null($data->jenjang_id)) $prioritas++;

        $rule->update([
            'jenis_kunjungan_id' => $data->jenis_kunjungan_id,
            'aktivitas_id' => $data->aktivitas_id,
            'capaian_pembelajaran_id' => $data->capaian_pembelajaran_id,
            'tefa_id' => $data->tefa_id,
            'prioritas' => $prioritas + 1,
            'jenjang' => convertJenjang($data->jenjang_id),
        ]);

        return $rule;
    }

    public function destroy ($id)
    {
        return Rule::destroy($id);
    }
}