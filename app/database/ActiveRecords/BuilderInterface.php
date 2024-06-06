<?php

namespace app\database\ActiveRecords;

interface BuilderInterface
{
	public function insert($table, $data);
    public function select($table, $conditions);
    public function update($table, $data, $conditions);
    public function delete($table, $conditions);

    public function sql($sql);
}
