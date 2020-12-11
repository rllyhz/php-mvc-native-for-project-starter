<?php

/**
 * @author rllyhz <rullyihza00@gmail.com>
 * @link https://github.com/rllyhz
 */

namespace Lib\Rllyhz\PhpMVCiers\Http;

/**
 * Class Server
 * 
 * Http Server
 * 
 * @package Lib\Rllyhz\PhpMVCiers\Http
 */
class Server
{
  /**
   * SERVER DATA
   */
  public string $documentRoot;
  public string $serverSoftware;
  public string $name;
  public string $port;
  public string $requestURI;
  public string $requestMethod;
  public string $scriptName;
  public string $scriptFilename;
  public string $phpSelf;

  /**
   * HTTP CONF
   */
  public string $httpHost;
  public string $httpUserAgent;
  public string $httpAccept;
  public string $httpAcceptLanguage;
  public string $httpAcceptEncoding;
  public string $httpDNT;
  public string $httpConnnection;

  /**
   * APP DETAILS
   */
  public string $appName;
  public string $appHost;
  public string $appPort;

  /**
   * DATABASE DETAILS
   */
  public string $dbName;
  public string $dbUser;
  public string $dbPass;
  public string $dbHost;
  public string $dbPort;

  /**
   * @var array data
   * 
   * Data from server.
   */
  private array $data;

  /**
   * Server Constructor
   */
  public function __construct(array $serverData)
  {
    $this->data = $serverData;

    $this->setServerDetails();
    $this->setHTTP_Configuraion();
    $this->setAppDetails();
    $this->setDatabaseDetails();
  }

  public function get(string $key)
  {
    if (isset($this->data[$key])) {
      return $this->data[$key];
    }

    return null;
  }

  private function setServerDetails()
  {
    $this->documentRoot = $this->get("DOCUMENT_ROOT");
    $this->serverSoftware = $this->get("SERVER_SOFTWARE");
    $this->name = $this->get("SERVER_NAME");
    $this->port = $this->get("SERVER_PORT");
    $this->requestURI = $this->get("REQUEST_URI");
    $this->requestMethod = $this->get("REQUEST_METHOD");
    $this->scriptName = $this->get("SCRIPT_NAME");
    $this->scriptFilename = $this->get("SCRIPT_FILENAME");
    $this->phpSelf = $this->get("PHP_SELF");
  }

  private function setHTTP_Configuraion()
  {
    $this->httpHost = $this->get("HTTP_HOST");
    $this->httpUserAgent = $this->get("HTTP_USER_AGENT");
    $this->httpAccept = $this->get("HTTP_ACCEPT");
    $this->httpAcceptLanguage = $this->get("HTTP_ACCEPT_LANGUAGE");
    $this->httpAcceptEncoding = $this->get("HTTP_ACCEPT_ENCODING");
    $this->httpDNT = $this->get("HTTP_DNT");
    $this->httpConnnection = $this->get("HTTP_CONNECTION");
  }

  private function setAppDetails()
  {
    $this->appName = $this->get("APP_NAME");
    $this->appHost = $this->get("APP_HOST");
    $this->appPort = $this->get("APP_PORT");
  }

  private function setDatabaseDetails()
  {
    $this->dbName = $this->get("DB_NAME");
    $this->dbHost = $this->get("DB_HOST");
    $this->dbPort = $this->get("DB_PORT");
    $this->dbUser = $this->get("DB_USER");
    $this->dbPass = $this->get("DB_PASS");
  }
}
