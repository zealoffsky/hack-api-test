<?hh

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\HackTest;
use type util\JSONLoaderUtil;

final class HTTPTest extends HackTest {

  public async function testGETRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts/1";
    $error = null;
    $endpointResponse = await HH\Asio\curl_exec($url);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/get-post-response.json");
    
    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "Endpoint response are not equal with expected response");
  }

  public async function testPOSTRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts";
    $error = null;

    $requestBody = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/requests/post-post-request.json");
    $requestSession = curl_init();
    curl_setopt($requestSession, CURLOPT_URL, $url);
    curl_setopt($requestSession, CURLOPT_POST, true);
    curl_setopt($requestSession, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($requestSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($requestSession, CURLOPT_HTTPHEADER, vec['Content-Type: application/json']);
    $endpointResponse = await HH\Asio\curl_exec($requestSession);
    curl_close($requestSession);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/post-post-response.json");

    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "Endpoint response are not equal with expected response");
  }
}