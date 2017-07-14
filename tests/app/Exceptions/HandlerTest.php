<?php

namespace Tests\App\Exceptions;

use TestCase;
use \Mockery as m;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException; 


class HandlerTest extends TestCase
{
    

    /** @test */
    public function it_responds_with_html_when_json_is_not_accepted()
    {
        // Make the mock a partial, only need to mock the 'isDebugMode' mehtod
        $subject = m::mock(Handler::class)->makePartial();
        $subject->shouldNotReceive('isDebugMode');

        // Mock the interaction with the request.
        $request = m::mock(Request::class);
        $request->shouldReceive('wantsJson')->andReturn(false);

        // Mock the interaction with the exception
        $exception = m::mock(\Exception::class, ['Error!']);
        $exception->shouldNotReceive('getStatusCode');
        $exception->shouldNotReceive('getTrace');
        $exception->shouldNotReceive('getMessage');

        // call the method under test, this is not a mockery method.
        $result = $subject->render($request, $exception);

        // assert that render does not return a JsonResponse
        $this->assertNotInstanceOf(JsonResponse::class, $result);
    }
    
    /** @test */
    public function it_responds_with_json_for_json_consumers()
    {
        $subject = m::mock(Handler::class)->makePartial();
        $subject->shouldReceive('isDebugMode')->andReturn(false);

        $request = m::mock(Request::class);
        $request->shouldReceive('wantsJson')->andReturn(true);

        $exception = m::mock(\Exception::class, ['Doh!']);
        $exception->shouldReceive('getMessage')->andReturn('Doh!');

        /** @var Json Response $result  */
        $result = $subject->render($request, $exception);
        $data = $result->getData();

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertObjectHasAttribute('error', $data);
        $this->assertAttributeEquals('Doh!', 'message', $data->error);
        $this->assertAttributeEquals(400, 'status', $data->error);


    }

    /** @test */
    public function it_provides_json_responses_for_http_exceptions()
    {
        $subject = m::mock(Handler::class)->makePartial();
        $subject->shouldReceive('isDebugMode')->andReturn(false);

        $request = m::mock(Request::class);
        $request->shouldReceive('wantsJson')->andReturn(true);

        $examples = [
            [
                'mock' => NotFoundHttpException::class,
                'status' => 404,
                'message' => 'Not Found' 
            ],
            [
                'mock' => AccessDeniedHttpException::class,
                'status' => 403,
                'message' => 'Forbidden'
            ],
            [
                'mock' => ModelNotFoundException::class,
                'status' => 404,
                'message' => 'Not Found'
            ]
        ];

        foreach ($examples as $e) {
            $exception = m::mock($e['mock']);

            $exception->shouldReceive('getMessage')->andReturn(null);
            $exception->shouldReceive('getStatusCode')->andReturn($e['status']);

            /** @var JsonResponse $result */
            $result = $subject->render($request, $exception);
            $data = $result->getData();

            $this->assertEquals($e['status'], $result->getStatusCode());
            $this->assertEquals($e['message'], $data->error->message);
            $this->assertEquals($e['status'], $data->error->status);
        }
    }
}