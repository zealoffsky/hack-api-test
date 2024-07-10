<?hh

public class JSONLoaderUtil {

    public static function loadJsonFile(string $filepath): mixed {
        $jsonContent = file_get_contents($filename);

        if ($jsonContent === false) {
            throw new Exception('Error reading the JSON file.');
        }

        // Decode the JSON content
        $data = json_decode($jsonContent);

        // Check if json_decode returned null (invalid JSON)
        if ($data === null) {
            throw new Exception('Error decoding the JSON file.');
        }

            return $data;
    }
}