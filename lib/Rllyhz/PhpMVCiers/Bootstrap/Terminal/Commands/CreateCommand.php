<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\Commands;

use Exception;
use Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\CommandHandler;

/**
 * Class CeateCommand
 * 
 * Creates file like controllers, models, etc.
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Bootstrap\Terminal\CommandHandler
 */
class CreateCommand extends CommandHandler
{
  /**
   * @var array type
   */
  private array $types;

  /**
   * @var string createType
   */
  private string $createType;

  /**
   * CreateCommand Constructor
   */
  public function __construct(string $rootDirectory, array $params)
  {
    $this->rootDirectory = $rootDirectory;
    $this->params = $params;
    $this->createType = "";

    $this->setTypes();
    $this->resolveParams();
    $this->create();
  }

  private function setTypes()
  {
    $this->types = [
      "controller", "model", "migration"
    ];
  }

  private function resolveParams()
  {
    if (sizeof($this->params) >= 2) {
      foreach ($this->types as $type) {
        if ($type == $this->params[0]) {
          $this->createType = $type;
          return;
        }
      }

      // throw an Error
    }
  }

  private function create()
  {
    if ($this->createType == $this->types[0]) {
      $this->createControllerFile($this->params[1]);
    } else if ($this->createType == $this->types[1]) {
      $this->createModelFile($this->params[1]);
    } else if ($this->createType == $this->types[2]) {
      $this->createMigrationFile($this->params[1]);
    } else {
      // throw an Error
    }
  }

  private function createControllerFile(string $fileName)
  {
    $fullpathOfFilename = $this->rootDirectory .  "/app/controllers/" . $fileName . ".php";
    $txt = "<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class $fileName
 * 
 * @package App\Core
*/
class $fileName extends Controller
{
  //
}
";

    try {
      $file = fopen($fullpathOfFilename, "w");
      fwrite($file, $txt);
      fclose($file);

      return $this->alert("File `$fileName` has been successfully created!");
    } catch (Exception $e) {
      // throw an Error
    }
  }

  private function createModelFile(string $fileName)
  {
    return $this->alert("File `$fileName` has been successfully created!");
  }

  private function createMigrationFile(string $fileName)
  {
    return $this->alert("File `$fileName` has been successfully created!");
  }
}
