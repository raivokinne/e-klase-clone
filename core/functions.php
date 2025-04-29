<?php

namespace Core;

use Core\Handlers\AuthUser;
use App\Models\User;

function dd(...$args)
{
	echo '<pre>';
	foreach ($args as $arg) {
		var_dump($arg);
	}
	echo '</pre>';
	die;
}

function view($view, $data = [])
{
    $sanitizedData = sanitize($data);

    extract($sanitizedData);
    require BASE_PATH . 'view/' . $view . '.php';
}

function sanitize($data)
{
    if ($data === null) {
        return null;
    }

    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanitize($value);
        }
        return $data;
    }

    if (is_object($data)) {
        $objectVars = get_object_vars($data);
        foreach ($objectVars as $key => $value) {
            $data->$key = sanitize($value);
        }
        return $data;
    }

    if (is_string($data)) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    return $data;
}

function redirect($path)
{
	header('Location: ' . $path);
	exit;
}

function method($method)
{
	return "<input type='hidden' name='_method' value='$method'>";
}

function csrf()
{
	return "<input type='hidden' name='csrf_token' value='" . $_SESSION['csrf_token'] . "'>";
}

function auth()
{
	if (!isset($_SESSION['user'])) {
        return null;
    }

	$user = User::where('id', '=', $_SESSION['user']['id'])->get();

	if ($user) {
        return new AuthUser($user);
    }

	return null;
}
