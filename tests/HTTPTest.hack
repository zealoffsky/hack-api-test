<?hh

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\HackTest;


final class HTTPTest extends HackTest {

  public function testGETRequest(): void {

    $url = "https://jsonplaceholder.typicode.com/posts/1";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Accept: application/json',
    ]);

    $response = await HH\Asio\curl_exec($ch);
  
    if ($response === false) {
      echo "Error: " . curl_error($ch) . "\n";
      curl_close($ch);
      return;
    }

    curl_close($ch);

    try {
      $actualResponse = json_decode($response);
      $expectedResponse = JSONLoaderUtil::loadJsonFile("responses/get-post-response.json");
      expect($actualResponse)->toBeSame($expectedResponse);
    } catch (Exception $e) {
      echo 'Error: '.$e->getMessage();
    }
  }

  public function testPOSTRequest(): void {

    $url = "https://jsonplaceholder.typicode.com/posts";

    $postRequest = json_encode(JSONLoaderUtil::loadJsonFile("requests/post-post-request.json"));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Accept: application/json',
      'Content-Type: application/json',
    ]);

    $actualResponse = await HH\Asio\curl_exec($ch);

    if ($response === false) {
      echo "Error: " . curl_error($ch) . "\n";
      curl_close($ch);
      return;
    }

    curl_close($ch);

    try {
      $actualResponse = json_decode($response);
      $expectedResponse = JSONLoaderUtil::loadJsonFile("responses/post-post-response.json");
      expect($actualResponse)->toBeSame($expectedResponse);
    } catch (Exception $e) {
      echo 'Error: '.$e->getMessage();
    }
  }
}