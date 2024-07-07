use function Facebook\FBExpect\expect;
use type Facebook\HackTest\HackTest;


final class MyTest extends HackTest {

  public function testGETRequest(vec<num> $in, vec<num> $expected_output): void {
    expect(square_vec($in))->toBeSame($expected_output);
  }
}