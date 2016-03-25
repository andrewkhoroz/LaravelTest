<?php namespace App\Contracts;

interface Repository {
    
    public function all();
    
    public function allOrSearch(array $search = []);
    
    public function searchOrAllPaginated(array $search = [], $perPage = 10);
    
    public function allPaginated($perPage = 10);
    
    public function find($id);
    
    public function findOrFail($id);
    
    public function search(array $search = [], $perPage = 10);
    
    public function store(array $data);
    
    public function update($id, array $data);
    
    public function delete($id);
    
    public function getModel();
    
    public function emptyModel();
    
}