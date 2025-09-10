<?php
namespace App\Interfaces;

interface TefaInterface
{
    public function getAll ();

    public function getById ($id);

    public function store ($request);

    public function update ($request, $id);

    public function destroy ($id);
}