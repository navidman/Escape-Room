<?php

function responseError($message = 'Error in provided data!', $errors = null, $status = 400)
{
    if ($message == '') {
        $message = 'Error in provided data!';
    }
    if (!$errors) {
        return ['status' => (int)$status, 'message' => $message];
    }
    return ['errors' => $errors, 'status' => (int)$status, 'message' => $message];
}

function responseSuccess($message = 'Successfully done!', $data = null)
{
    if ($message == '') {
        $message = 'Successfully done!';
    }

    if ($data) {
        return ['message' => $message, 'data' => $data, 'status' => 200];
    }
    return ['message' => $message, 'status' => 200];
}

function responseServerError($errors = null)
{
    return response(['message' => 'Internal server error!', 'errors' => $errors, 'status' => 500], 500);
}
