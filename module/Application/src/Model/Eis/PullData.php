<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 18:49
 */

namespace Application\Model\Eis;

use Zend\Db\Adapter\AdapterInterface;
use FtpClient\FtpClient;
use ZipArchive;
use XMLReader;
use Application\Entity\LogUploadFiles;
use Zend\Log\LoggerInterface;
use Zend\Log\Logger;
use Zend\Console\Adapter\AdapterInterface as Console;

class PullData
{

  private $_dbAdapter;
  private $_sm;
  private $_ftp;
  private $_em;

  private $_reader;

  /**
   * Подключаем логирование.
   *
   * @var Zend\Log\LoggerInterface
   */
  private $_logger;

  /**
   * Directory of the file to process.
   *
   * @var string
   */
  private $_directory;

  /**
   * Nodes to handle as plain text.
   *
   * @var array
   */
  protected $textNodes = [
    XMLReader::TEXT,
    XMLReader::CDATA,
    XMLReader::WHITESPACE,
    XMLReader::SIGNIFICANT_WHITESPACE
  ];


  const ASCII = FTP_ASCII;
  const TEXT = FTP_TEXT;
  const BINARY = FTP_BINARY;
  const IMAGE = FTP_IMAGE;
  const TIMEOUT_SEC = FTP_TIMEOUT_SEC;
  const AUTOSEEK = FTP_AUTOSEEK;
  const AUTORESUME = FTP_AUTORESUME;
  const FAILED = FTP_FAILED;
  const FINISHED = FTP_FINISHED;
  const MOREDATA = FTP_MOREDATA;

  const CURRENT_YEAR = '2018';
  const PLAN_DIR = '/purchasePlan';

  const OKVED2_DIR = '/out/nsi/nsiOkved2';
  const OKVED2_PREFIX = 'okved2';
  const OKVED2_CLASS = 'Application\Entity\Okved2';
  const OKVED2_ROOT = 'ns2:nsiOkved2Data';
  const OKVED2_CODE = 'ns2:code';

  const OKV_DIR = '/out/nsi/nsiOkv';
  const OKV_PREFIX = 'okv';
  const OKV_CLASS = 'Application\Entity\Okv';
  const OKV_ROOT = 'ns2:nsiOkvData';
  const OKV_CODE = 'ns2:digitalCode';

  const OKEI_DIR = '/out/nsi/nsiOkei';
  const OKEI_PREFIX = 'okei';
  const OKEI_CLASS = 'Application\Entity\Okei';
  const OKEI_ROOT = 'ns2:nsiOkeiData';
  const OKEI_CODE = 'ns2:code';

  const OKPD2_DIR = '/out/nsi/nsiOkpd2';
  const OKPD2_PREFIX = 'okpd2';
  const OKPD2_CLASS = 'Application\Entity\Okpd2';
  const OKPD2_ROOT = 'ns2:nsiOkpd2Data';
  const OKPD2_CODE = 'ns2:code';

  /**
   * PullData constructor.
   * @param $serviceManager
   * @param AdapterInterface $dbAdapter
   * @param FtpClient $ftp
   */
  public function __construct($serviceManager, AdapterInterface $dbAdapter, FtpClient $ftp, $entityManager)
  {
    $this->_dbAdapter = $dbAdapter;
    $this->_sm = $serviceManager;
    $this->_ftp = $ftp;
    $this->_em = $entityManager;
  }

  /**
   * Основная стартующая
   *
   * @return string
   */
  public function run($mode = 'all', Console $console)
  {

    // $this->uploadPurchasePlans();

    $this->_logger->log(Logger::INFO, 'Upload ' . $mode);
    switch ($mode) {
      case 'okpd2':
        $console->writeLine($this->uploadNsi(self::OKPD2_DIR, self::OKPD2_PREFIX, self::OKPD2_CLASS, self::OKPD2_ROOT, self::OKPD2_CODE, true));
        break;
      case 'okved2':
        $console->writeLine($this->uploadNsi(self::OKVED2_DIR, self::OKVED2_PREFIX, self::OKVED2_CLASS, self::OKVED2_ROOT, self::OKVED2_CODE, false));
        break;
      case 'okv':
        $console->writeLine($this->uploadNsi(self::OKV_DIR, self::OKV_PREFIX, self::OKV_CLASS, self::OKV_ROOT, self::OKV_CODE, false));
        break;
      case 'okei':
        $console->writeLine($this->uploadNsi(self::OKEI_DIR, self::OKEI_PREFIX, self::OKEI_CLASS, self::OKEI_ROOT, self::OKEI_CODE, false));
        break;
      case 'all':
        $console->writeLine($this->uploadNsi(self::OKPD2_DIR, self::OKPD2_PREFIX, self::OKPD2_CLASS, self::OKPD2_ROOT, self::OKPD2_CODE, true));
        $console->writeLine($this->uploadNsi(self::OKVED2_DIR, self::OKVED2_PREFIX, self::OKVED2_CLASS, self::OKVED2_ROOT, self::OKVED2_CODE, false));
        $console->writeLine($this->uploadNsi(self::OKV_DIR, self::OKV_PREFIX, self::OKV_CLASS, self::OKV_ROOT, self::OKV_CODE, false));
        $console->writeLine($this->uploadNsi(self::OKEI_DIR, self::OKEI_PREFIX, self::OKEI_CLASS, self::OKEI_ROOT, self::OKEI_CODE, false));
        break;
    }

    return true;
  }

  /**
   * Список файлов планов текущего года
   *
   * @param $dir
   * @return array
   * @throws \FtpClient\FtpException
   */
  private function getPlanFilesCurrentYear($dir)
  {

    $curPlanFiles = [];

    $ls = $this->_ftp->nlist($dir . self::PLAN_DIR);

    foreach ($ls as $f) {
      if (strpos($f, '_' . self::CURRENT_YEAR)) {
        $curPlanFiles[] = $f;
      }
    }

    return $curPlanFiles;
  }

  /**
   * Получение файла с фтп
   *
   * @param $name
   * @param $prefix
   * @return bool|string
   */
  private function uploadFtpFile($name, $prefix)
  {

    $tmpFile = tempnam(sys_get_temp_dir(), $prefix . '_');
    $fp = fopen($tmpFile, 'w');

    $isHere = $this->_ftp->fget($fp, $name, self::BINARY);

    if (!$isHere) {
      fclose($fp);
      return false;
    }

    fclose($fp);
    return $tmpFile;

  }

  /**
   * Достаем из зипа
   *
   * @param $tmpFile
   * @return bool|string
   * @throws \Exception
   */
  private function extractZip($tmpFile)
  {

    $zip = new ZipArchive();

    try {

      $dirname = tempnam(sys_get_temp_dir(), 'unzip_');
      @unlink($dirname);

      if ($zip->open($tmpFile)) {

        if (!file_exists($dirname)) {
          if (!mkdir($dirname, 0777, true) && !is_dir($dirname)) {
            throw new \Exception('Не могу создать каталог для сохранения', 405);
          }
        }

        if (!is_dir($dirname) || !is_writable($dirname)) {
          throw new \Exception('Не могу сохранять файлы', 405);
        }

        if (!$zip->extractTo($dirname)) {
          throw new \Exception('Невозможно распаковать архив. ' . $zip->getStatusString());
        }

        $zip->close();
        return $dirname;
      }

    } catch (Exception $e) {
      if (file_exists($tmpFile)) {
        @unlink($tmpFile);
      }

      if (is_dir($dirname)) {
        @unlink($dirname);
      }
    }

    return false;

  }

  /**
   * Получаем массив файлов в папке
   *
   * @param $dirname
   * @return array|bool
   */
  private function getDirEntries($dirname)
  {
    $h = @dir($dirname);

    if (!$h) {
      return false;
    }

    $entries = array();

    while (false !== ($entry = $h->read())) {
      if ('.' !== $entry && '..' !== $entry) {
        $entries[] = $entry;
      }
    }

    $h->close();

    return $entries;
  }

  /**
   * Обновление справочников
   *
   * @param $dir
   * @param $prefix
   * @param $class
   * @param $root
   * @param $code
   * @param bool $maxExecutionTime
   * @return string
   * @throws \FtpClient\FtpException
   */
  private function uploadNsi($dir, $prefix, $class, $root, $code, $maxExecutionTime = false)
  {
    if ($maxExecutionTime) {
      ini_set('max_execution_time', 300);
    }

    $ls = $this->_ftp->nlist($dir);
    $name = $ls[count($ls) - 1];
    unset($ls);

    $logUploadFiles = $this->_em->getRepository(LogUploadFiles::class);
    $result = $logUploadFiles->findOneByName($name);

    if ($result) {
      return '(' . strtoupper($prefix) . ') there are no updates.';
    }

    $fileZip = $this->uploadFtpFile($name, $prefix);
    $dirname = $this->extractZip($fileZip);
    $files = $this->getDirEntries($dirname);

    $nsi = $this->_em->getRepository($class);
    $metadata = $this->_em->getClassMetadata($class);

    foreach ($files as $file) {
      $xml = $this->fromFile($dirname . '/' . $file);

      foreach ($xml['ns2:body']['ns2:item'] as $item) {
        if ($item[$root]['ns2:businessStatus'] === '866') {
          continue;
        }

        $field = strtolower(str_replace('ns2:', '', $code));
        $method = 'findOneBy' . ucfirst($field);
        $nameMetadata = $metadata->fieldMappings[$field];
        $value = $item[$root][$code];

        if ($nameMetadata['type'] === 'integer') {
          $value = (int)$item[$root][$code];
        }

        $row = $nsi->$method($value);

        if (!$row) {
          $row = new $class($this->_em, $metadata);
        }

        $row->update($item[$root]);
        $this->_em->persist($row);
      }

      if (is_file($dirname . '/' . $file)) {
        @unlink($dirname . '/' . $file);
      }

      unset($xml);
    }

    $this->_em->flush();
    $this->logUploadFile($name);

    if (is_file($fileZip)) {
      @unlink($fileZip);
    }

    return '(' . strtoupper($prefix) . ') update file - ' . $name;
  }

  /**
   * Запуск парсинга полученного файла
   *
   * @param $filename
   * @return string
   */
  public function fromFile($filename)
  {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new \RuntimeException(sprintf(
        "File '%s' doesn't exist or not readable",
        $filename
      ));
    }
    $this->_reader = new XMLReader();
    $this->_reader->open($filename, null, LIBXML_XINCLUDE);

    $this->_directory = dirname($filename);

    set_error_handler(
      function ($error, $message = '') use ($filename) {
        throw new \RuntimeException(
          sprintf('Error reading XML file "%s": %s', $filename, $message),
          $error
        );
      },
      E_WARNING
    );
    $return = $this->process();
    restore_error_handler();
    $this->_reader->close();

    return $return;
  }

  /**
   * Процесс парсинга
   *
   * @return string
   */
  private function process()
  {
    return $this->processNextElement();
  }


  /**
   * Идем по xml
   *
   * @return array || string
   */
  private function processNextElement()
  {
    $children = [];
    $text = '';

    while ($this->_reader->read()) {
      if ($this->_reader->nodeType === XMLReader::ELEMENT) {
        if ($this->_reader->depth === 0) {
          return $this->processNextElement();
        }

        $attributes = $this->getAttributes();
        $name = $this->_reader->name;

        if ($this->_reader->isEmptyElement) {
          $child = [];
        } else {
          $child = $this->processNextElement();
        }

        if ($attributes) {
          if (is_string($child)) {
            $child = ['_' => $child];
          }

          if (!is_array($child)) {
            $child = [];
          }

          $child = array_merge($child, $attributes);
        }

        if (isset($children[$name])) {
          if (!is_array($children[$name]) || !array_key_exists(0, $children[$name])) {
            $children[$name] = [$children[$name]];
          }

          $children[$name][] = $child;
        } else {
          $children[$name] = $child;
        }
      } elseif ($this->_reader->nodeType === XMLReader::END_ELEMENT) {
        break;
      } elseif (in_array($this->_reader->nodeType, $this->textNodes)) {
        $text .= $this->_reader->value;
      }
    }

    return $children ?: $text;
  }

  /**
   * Получаем все отрибуты текущей ноды
   *
   * @return array
   */
  private function getAttributes()
  {
    $attributes = [];

    if ($this->_reader->hasAttributes) {
      while ($this->_reader->moveToNextAttribute()) {
        $attributes[$this->_reader->localName] = $this->_reader->value;
      }

      $this->_reader->moveToElement();
    }

    return $attributes;
  }

  /**
   * Получаем список регионов
   *
   * @param $dir
   * @return array
   * @throws \FtpClient\FtpException
   */
  private function uploadDirNameRegions($dir)
  {

    $ls = $this->_ftp->nlist($dir);

    return $ls;

  }

  /**
   * Получение списка файлов с планами
   *
   * @throws \FtpClient\FtpException
   */
  private function uploadPurchasePlans()
  {

    $ls = $this->uploadDirNameRegions('/out/published');
    $zipFiles = $this->getPlanFilesCurrentYear($ls[0]);

    $logUploadFiles = $this->_em->getRepository(LogUploadFiles::class);

    foreach ($zipFiles as $f) {
      $result = $logUploadFiles->findOneByName($f);

      if ($result) {
        continue;
      }

      $fileZip = $this->uploadFtpFile($f, 'purchasePlan');
      $dirname = $this->extractZip($fileZip);
      $files = $this->getDirEntries($dirname);

      foreach ($files as $file) {
        $xml = $this->fromFile($dirname . '/' . $file);
        $this->updatePurchasePlan($xml['ns2:body']['ns2:item']['ns2:purchasePlanData']);
      }

      $this->logUploadFile($f);
    }

  }

  /**
   * Обновление информации о планах
   *
   * @param $xml
   */
  private function updatePurchasePlan($xml)
  {

    $purchasePlan = $this->_em->getRepository(PurchasePlan::class);
    $plan = $purchasePlan->findOneByRegistrationnumber($xml['ns2:registrationNumber']);

    if (!$plan) {
      $plan = new PurchasePlan();
    }

    // Создаем/обновляем план
    $plan->updatePlan($xml);
    $this->_em->persist($plan);

    // Удаляем все позиции и создаем их заново
    $planitems = $plan->getPlanitems();

    $this->removeCollection($planitems);

    $plan->updatePlanItems($xml['ns2:purchasePlanItems']);
    $this->_em->persist($plan);

    $this->_em->flush();
  }

  /**
   * Удаление всех сущностей из базы
   *
   * @param $planitems
   */
  private function removeCollection($collection)
  {
    foreach ($collection as $item) {
      $this->_em->remove($item);
    }
    $this->_em->flush();
  }

  /**
   * Сохраняем название файла который скачали и обработали
   *
   * @param $fname
   */
  private function logUploadFile($fname)
  {
    $uploadFile = new LogUploadFiles($this->_em, $this->_em->getClassMetadata('Application\Entity\LogUploadFiles'));
    $uploadFile->update(['dateupdate' => date('c'), 'name' => $fname]);
    $this->_em->persist($uploadFile);
    $this->_em->flush();
  }

  public function setLogger(LoggerInterface $logger)
  {
    $this->_logger = $logger;
    return $this;
  }
}