<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array ('stylists' => $stylists));
    });

    $app->post("/", function() use ($app) {
        $new_stylist = new Stylist($_POST['name']);
        $new_stylist->save();
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array ('stylists' => $stylists));
    });

    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->findClients();
        return $app['twig']->render('stylist.html.twig', array ('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_client = new Client($_POST['name'], $stylist->getId());
        $new_client->save();
        $clients = $stylist->findClients();
        return $app['twig']->render('stylist.html.twig', array ('stylist' => $stylist, 'clients' => $clients));
    });

    $app->patch("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['name']);
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array ('stylists' => $stylists));
    });

    $app->delete("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array ('stylists' => $stylists));
    });

    $app->get("/stylist/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array ('stylist' => $stylist));
    });

    $app->patch("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->update($_POST['name']);
        $stylist = Stylist::find($client->getStylistId());
        $clients = $stylist->findClients();
        return $app['twig']->render('stylist.html.twig', array ('stylist' => $stylist, 'clients' => $clients));
    });

    $app->delete("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        $client->delete();
        $clients = $stylist->findClients();
        return $app['twig']->render('stylist.html.twig', array ('stylist' => $stylist, 'clients' => $clients));
    });

    $app->get("/client/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array ('client' => $client));
    });

    return $app;
?>
