<?php

namespace Tests\App\Exceptions;

use TestCase;
use \Mockery as m;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;   


class HandlerTest extends TestCase
{
    

    /** @test */
    public function it_responds_with_html_when_json_is_not_accepted()
    {
        // Make the mock a partial, you only want to mock the 'isDebugMode' mehtod
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
      
    
}