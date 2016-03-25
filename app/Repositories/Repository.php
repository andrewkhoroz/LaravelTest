<?php namespace App\Repositories;

use App\Contracts\Repository as RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Exception\NotSupportedException;

class Repository implements RepositoryInterface {
    
    const SORT_DIR_ASC = "ASC";
    const SORT_DIR_DESC = "DESC";
    
    /**
     * @var Model
     */
    protected $model;
    
    protected $sortColumn = null;
    
    protected $sortDir = self::SORT_DIR_DESC;
    
    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get all resources.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->getModel()->all();
    }
    
    /**
     * Get all resources or search resources by given $search.
     *
     * @param string|null $search
     * @return mixed
     */
    public function allOrSearch(array $search = [])
    {
        if ( ! is_null($search)) return $this->search($search);

        return $this->all();
    }
    
    /**
     * @param null $search
     * @param int $perPage
     * @return mixed
     */
    public function searchOrAllPaginated(array $search = [], $perPage = 10)
    {
        if ( ! is_null($search)) return $this->search($search);

        return $this->allPaginated($perPage);
    }
    
    /**
     * Get all resources and paginate the result by given $perPage.
     *
     * @param int $perPage
     * @return mixed
     */
    public function allPaginated($perPage = 10)
    {
        return $this->getModel()->paginate($perPage);
    }
    
    
    /**
     * Get the specified resource by given $id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * Alias for "find" method.
     *
     * @param  int $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->find($id);
    }
    
    public function search(array $search = [], $perPage = 10) 
    {
        return $this->getModel()->paginate($perPage);
    }
    
    public function update($id, array $data) 
    {
        return $this->findOrFail($id)->update($data);
    }
    
    public function store(array $data) 
    {
        return $this->emptyModel($data)->save();
    }
    
    public function delete($id) 
    {
        return $this->emptyModel()->destroy($id);
    }
    
    public function getModel($data = [])
    {
        if (null === $this->sortColumn) {
            return $this->model;
        }
        
        return $this->model->orderBy($this->sortColumn, $this->sortDir);
    }

	/**
	 * @throws NotSupportedException
	 */
	public function emptyModel()
    {
        throw new NotSupportedException('Not implemented');
    }
}