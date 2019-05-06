<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    /**
     * find a resource by id
     *
     * @param mixed $id
     * @return \ArrayAccess|null
     */
    public function findOne($id): ?\ArrayAccess;

    /**
     * find a resource by criteria
     *
     * @param array $criteria
     * @return \ArrayAccess | null
     */
    public function findOneBy(array $criteria): ?\ArrayAccess;

    /**
     * Search All resources
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findBy(array $searchCriteria = []);

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @return \IteratorAggregate | null
     */
    public function findIn(string $key, array $values): ?\IteratorAggregate;

    /**
     * save a resource
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function save(array $data): \ArrayAccess;

    /**
     * update a resource
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess;

    /**
     * delete a resource
     *
     * @param \ArrayAccess $model
     * @return bool
     */
    public function delete(\ArrayAccess $model): bool;

    /**
     * updated records by specific key and values
     *
     * @param string $key
     * @param array $values
     * @param array $data
     * @return \IteratorAggregate
     */
    public function updateIn(string $key, array $values, array $data): ?\IteratorAggregate;

}
