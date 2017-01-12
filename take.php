<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/*Take*/
$app->post("/take/question", function (Request $request, Response $response) {
    $out = $response->getBody();
    $response = $response->withHeader('Content-type', 'application/json');
    $post = json_decode($request->getBody(), true);
    if (isset($post['meal']) && $post['meal'] != null) {
        $status = authStatus($request, $response, $tokenData, $user);
        if ($status == OK) {
            $username = $tokenData->username;
            $role = $user[0]['role'];
            try {
                $db = new DbHandler();
                $query = file_get_contents("Restaurant-API/database/sql/take/question/question.sql");
                $result = $db->mysqli_prepared_query($query, "ss", array($username, $post['meal']))[0];

                $output = [
                    "take" => array(
                        "question" => $result
                    )
                ];
                $out->write(json_encode($output, true));

            } catch (Exception $e) {
                $status = INTERNAL_SERVER_ERROR;
                $out->write(json_encode(handleError($e->getMessage(), "Database", $status)));
            }
        }
    } else {
        $status = BAD_REQUEST;
        $out->write(json_encode(handleError('Bad Request', "HTTP", $status)));
    }
    return $response->withStatus($status);
});

$app->post("/take/cancel", function (Request $request, Response $response) {
    $out = $response->getBody();
    $response = $response->withHeader('Content-type', 'application/json');
    $post = json_decode($request->getBody(), true);
    if (isset($post['meal']) && $post['meal'] != null) {
        $status = authStatus($request, $response, $tokenData, $user);
        if ($status == OK) {
            $username = $tokenData->username;
            $role = $user[0]['role'];
            try {
                $db = new DbHandler();
                $query = file_get_contents("Restaurant-API/database/sql/take/cancel/cancel.sql");
                $result = $db->mysqli_prepared_query($query, "ss", array($username, $post['meal']))[0];
                $output = [
                    "take" => array(
                        "cancel" => $result
                    )
                ];
                $out->write(json_encode($output, true));
            } catch (Exception $e) {
                $status = INTERNAL_SERVER_ERROR;
                $out->write(json_encode(handleError($e->getMessage(), "Database", $status)));
            }
        }
    } else {
        $status = 400;
        $out->write(json_encode(handleError('Bad Request', "HTTP", $status)));
    }
    return $response->withStatus($status);
});

$app->post("/take/confirm", function (Request $request, Response $response) {
    $out = $response->getBody();
    $response = $response->withHeader('Content-type', 'application/json');
    $post = json_decode($request->getBody(), true);
    if (isset($post['meal']) && $post['meal'] != null) {
        $status = authStatus($request, $response, $tokenData, $user);
        if ($status == OK) {
            $username = $tokenData->username;
            $role = $user[0]['role'];
            try {
                $db = new DbHandler();
                $query = file_get_contents("Restaurant-API/database/sql/take/confirm/set.sql");
                $result = $db->mysqli_prepared_query($query, "ss", array($username, $post['meal']))[0];
                $output = [
                    "take" => array(
                        "confirm" => $result
                    )
                ];
                $out->write(json_encode($output, true));
            } catch (Exception $e) {
                $status = INTERNAL_SERVER_ERROR;
                $out->write(json_encode(handleError($e->getMessage(), "Database", $status)));
            }
        }
    } else {
        $status = BAD_REQUEST;
        $out->write(json_encode(handleError('Bad Request', "HTTP", $status)));
    }
    return $response->withStatus($status);
});

$app->post("/take/reject", function (Request $request, Response $response) {
    $out = $response->getBody();
    $response = $response->withHeader('Content-type', 'application/json');
    $post = json_decode($request->getBody(), true);
    if (isset($post['meal']) && $post['meal'] != null) {
        $status = authStatus($request, $response, $tokenData, $user);
        if ($status == OK) {
            $username = $tokenData->username;
            $role = $user[0]['role'];
            try {
                $db = new DbHandler();
                $query = file_get_contents("Restaurant-API/database/sql/take/cancel/cancel.sql");
                $result = $db->mysqli_prepared_query($query, "ss", array($username, $post['meal']))[0];
                $output = [
                    "take" => array(
                        "reject" => $result
                    )
                ];
                $out->write(json_encode($output, true));
            } catch (Exception $e) {
                $status = INTERNAL_SERVER_ERROR;
                $out->write(json_encode(handleError($e->getMessage(), "Database", $status)));
            }
        }
    } else {
        $status = BAD_REQUEST;
        $out->write(json_encode(handleError('Bad Request', "HTTP", $status)));
    }
    return $response->withStatus($status);
});
