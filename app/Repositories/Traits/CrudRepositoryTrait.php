<?php

namespace App\Repositories\Traits;

trait CrudRepositoryTrait
{

    public function getModel()
    {
        return $this->model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function get($columns = [])
    {
        if ($columns) {
            $this->model->get($columns);
        }
        return $this->model->get();
    }

}
