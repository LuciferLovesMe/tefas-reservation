<?php

namespace App\Interfaces;

interface JenisKunjunganInterface
{
    public function getAll();

    public function getByID($id);

    public function store($data);
    
    public function update($id, $data);
    
    public function destroy($id);
}