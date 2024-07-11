<?hh

public class JSONLoaderUtil {

    public static function loadJsonFile(string $filePath): mixed {

        $jsonContent = file_get_contents($filePath);

        if ($jsonContent === false) {
            throw new Exception('Error reading the JSON file.');
        }

        $data = json_decode($jsonContent);

        if ($data === null) {
            throw new Exception('Error decoding the JSON file.');
        }

            return $data;
    }
}