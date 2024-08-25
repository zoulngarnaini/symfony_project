use App\Controller\HelloWorldController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->add('app_hello_word', '/hello_world/index')
        ->controller([HelloWorldController::class, 'index'])
    ;

 
};