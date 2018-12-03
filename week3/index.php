<?php
/**
 * Controller
 * User: reinardvandalen
 * Date: 05-11-18
 * Time: 15:25
 */

/* Require composer autoloader */
require __DIR__ . '/vendor/autoload.php';

/* Include model.php */
include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'ddwt18_week3', 'ddwt18', 'ddwt18');

/* set credentials */
$cred = set_cred('ddwt18', 'ddwt18');

/* Create Router instance */
$router = new \Bramus\Router\Router();

// Add routes here
$router->mount('/api', function() use ($router, $db, $cred) {
    http_content_type('application/json');
    /* validates credentials */
    $router->before('GET|POST|PUT|DELETE', '/api/.*', function() use($cred){
        // Validate authentication
        if (!check_cred($cred)) {
            return [
                'type' => 'warning',
                'message' => 'You are not allowed to enter or view any of this page\'s content.'
            ];
        };
        exit();
    });
    /* GET for reading all series */
    $router->get('/series', function() use($db) {
        // Retrieve and output information
        $series = get_series($db);
        echo json_encode($series);
    });
    /* GET for reading individual series */
    $router->get('/series/(\d+)', function($id) use($db) {
        // Retrieve and output information
        $serie_info = get_serieinfo($db, $id);
        echo json_encode($serie_info);
    });
    /* GET for deleting individual series */
    $router->post('/series/(\d+)', function($id) use($db) {
        // Retrieve and output information
        $delete_serie = remove_serie($db, $id);
        echo json_encode($delete_serie);
    });
    $router->post('/series/add', function() use($db) {
        // Retrieve and output information
        $add_serie = add_serie($db, $_POST);
        echo json_encode($add_serie);
    });
    $router->put('/series/(\d+)', function($id) use($db) {
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        $serie_info = $_PUT + ["serie_id" => $id];
        // Retrieve and output information
        $update_serie = update_serie($db, $serie_info);
        echo json_encode($update_serie);
    });
    $router->set404(function() {
        header('HTTP/1.1 404 Not Found');
        echo '404: PAGE NOT FOUND!';
    });
});

/* Run the router */
$router->run();
