<?hh

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\HackTest;
use type util\JSONLoaderUtil;

final class HTTPTest extends HackTest {

  public async function testGetRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts/1";
    $error = null;
    $endpointResponse = await HH\Asio\curl_exec($url);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/get-post-response.json");

    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "testGetRequest failed: Endpoint response are not equal with expected response");
  }

  public async function testPostRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts";
    $error = null;

    $requestBody = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/requests/post-post-request.json");
    $requestSession = curl_init();
    curl_setopt($requestSession, CURLOPT_URL, $url);
    curl_setopt($requestSession, CURLOPT_POST, true);
    curl_setopt($requestSession, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($requestSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($requestSession, CURLOPT_HTTPHEADER, vec["Content-Type: application/json"]);
    $endpointResponse = await HH\Asio\curl_exec($requestSession);
    curl_close($requestSession);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/post-post-response.json");

    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "testPostRequest failed: Endpoint response are not equal with expected response");
  }

    public async function testPutRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts/1";
    $error = null;
    $requestBody = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/requests/put-post-request.json"); 
    $requestSession = curl_init();
    curl_setopt($requestSession, CURLOPT_URL, $url);
    curl_setopt($requestSession, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($requestSession, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($requestSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($requestSession, CURLOPT_HTTPHEADER, vec["Content-Type: application/json"]);
    $endpointResponse = await HH\Asio\curl_exec($requestSession);
    curl_close($requestSession);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/put-post-response.json");

    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "testPutRequest failed: Endpoint response are not equal with expected response");
    }

    public async function testDeleteRequest(): Awaitable<void> {
    $url = "https://jsonplaceholder.typicode.com/posts/1";
    $error = null;
    $requestSession = curl_init();
    curl_setopt($requestSession, CURLOPT_URL, $url);
    curl_setopt($requestSession, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($requestSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($requestSession, CURLOPT_HTTPHEADER, vec["Content-Type: application/json"]);
    $endpointResponse = await HH\Asio\curl_exec($requestSession);
    curl_close($requestSession);
    $expectedEndpointResponse = await JSONLoaderUtil::loadJsonFile(__DIR__."/../tests/data/responses/delete-post-response.json");

    expect(json_decode_with_error($endpointResponse, inout $error))->
      toBePHPEqual(json_decode_with_error($expectedEndpointResponse, inout $error), "testDeleteRequest failed: Endpoint response are not equal with expected response");
    }    
}