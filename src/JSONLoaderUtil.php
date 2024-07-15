<?hh
namespace util;

use namespace HH\Lib\File;

class JSONLoaderUtil {

    public static async function loadJsonFile(string $filePath): Awaitable<string> {
        $file = File\open_read_write($filePath);
        $content = await $file->readAllAsync();
        $file->close();
        return $content;
    }
}
