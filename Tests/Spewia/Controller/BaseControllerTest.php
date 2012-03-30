<?php
namespace Tests\Spewia\Controller;

use Spewia\Controller\BaseController;

/**
 * Test class for Container.
 * Generated by PHPUnit on 2012-03-23 at 11:39:33.
 *
 */
class BaseControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $template;
    protected $container;
    protected $response;
    protected $controller;

    public function setUp()
    {
        $this->template = \Mockery::mock('Spewia\Template\TemplateInterface');

        $this->response = \Mockery::mock('Symfony\Component\HttpFoundation\Response');
        $factory = \Mockery::mock('Spewia\Factory\FactoryInterface');

        $this->container = \Mockery::mock('Spewia\DependencyInjection\ContainerInterface');

        $this->container
        ->shouldReceive('get')
        ->with('factory.response')
        ->andReturn($factory);

        $factory
        ->shouldReceive('build')
        ->andReturn($this->response);

        $this->container
        ->shouldReceive('get')
        ->with('template')
        ->andReturn($this->template);

        $this->controller = new TestControllerClass($this->container);

    }

    /**
     * Test the Render in order to check that it generates the Reponse and the Template Correctly.
     */
    public function testRender()
    {
        $this->template
        ->shouldReceive('render')
        ->once()
        ->andReturn('<html></html>');

        $this->response
        ->shouldReceive('setContent')
        ->atLeast(1)
        ->with('<html></html>');

        $this->controller->showAction();
        $response = $this->controller->render();

        $this->assertSame($this->response, $response,
            'The response is not the same as the returned by the controller.'
        );
    }
}

/**
 * Class to use in the tests.
 */
class TestControllerClass extends BaseController
{
    public function showAction()
    {
        ;
    }
}