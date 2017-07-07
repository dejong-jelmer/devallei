<?php
use Illuminate\Http\Response;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    
    use MockeryPHPUnitIntegration;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * See if the response has a header
     *
     * @param $header
     * @return $this
     */
    
    public function seeHasHeader($header)
    {
        $this->assertTrue(
                $this->response->headers->has($header),
                "Response moet een header hebben, {$header} heeft geen header."
            );

        return $this;
    }

    /**
     * Asserts that the response header matches a given regular expresion
     * @param $header
     * @param $regexp
     * @return $this
     */
    public function seeHeaderWithRegExp($header, $regexp)
    {
        $this->seeHasHeader($header)
            ->assertRegexp(
                $regexp,
                $this->response->headers->get($header)
                );

        return $this;
    }


}
