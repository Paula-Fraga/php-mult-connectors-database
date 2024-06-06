<?php

use app\database\Models\UserModel;
require '../vendor/autoload.php';
require '../define.php';

/*
	$user = new UserModel;

	$user->select();

	$user->insert([
		'nome' => 'Adm',
		'email' => 'usuario@gmail.com',
		'senha' => '12345',
	]);

	$user->update(['nome' => 'Supervisor'], ['id' => 1]);

	$user->delete(['id' => 1]);

	$user->sql('SELECT * FROM usuarios');
*/

