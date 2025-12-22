<?php

namespace App\Repositories;

interface CompanyRepositoryInterface {
    public function getAll(?string $search = null);
    public function findById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);

}