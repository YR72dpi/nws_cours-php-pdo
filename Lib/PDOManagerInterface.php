<?php

interface PDOManagerInterface {
    public function findAll(string $table);
    public function findBy(string $table, array $criteria, array $order);
    public function delete(string $table, int $id);
    public function post(string $table, array $columnData);
    public function update(string $table, int $id, array $columnData);
    public function getRelation(array $relation, string $select=null, array $criteria, array $order = null);
}