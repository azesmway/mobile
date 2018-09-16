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
use Application\Entity\Okved2;
use Application\Entity\PurchasePlan;
use Application\Entity\Contragents;
use Application\Entity\Okv;
use Application\Entity\UploadFiles;

class PullData
{

  private $dbAdapter;
  private $serviceManager;
  private $ftp;
  private $entityManager;

  protected $reader;

  /**
   * Directory of the file to process.
   *
   * @var string
   */
  protected $directory;

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

  /**
   * PullData constructor.
   * @param $serviceManager
   * @param AdapterInterface $dbAdapter
   * @param FtpClient $ftp
   */
  public function __construct($serviceManager, AdapterInterface $dbAdapter, FtpClient $ftp, $entityManager)
  {
    $this->dbAdapter = $dbAdapter;
    $this->serviceManager = $serviceManager;
    $this->ftp = $ftp;
    $this->entityManager = $entityManager;
  }

  /**
   * Основная стартующая
   *
   * @return string
   */
  public function run()
  {

    // $this->uploadNsiOkved2();

    $this->uploadPurchasePlans();

    // $this->uploadNsiOkv();

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

    $ls = $this->ftp->nlist($dir . '/purchasePlan');

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

    $isHere = $this->ftp->fget($fp, $name, self::BINARY);

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
          if (!@mkdir($dirname, 0777, true)) {
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
      if ('.' != $entry && '..' != $entry) {
        $entries[] = $entry;
      }
    }

    $h->close();

    return $entries;
  }


  /**
   * Получение текущего справочника ОКВЕД2
   *
   * @return array|string
   */
  private function uploadNsiOkved2()
  {

    $dir = '/out/nsi/nsiOkved2';
    $result = $this->getXmlData($dir, 'okved2');

    $okved2 = $this->entityManager->getRepository(Okved2::class);

    foreach ($result['ns2:body']['ns2:item'] as $item) {
      $row = $okved2->findOneByCode($item['ns2:nsiOkved2Data']['ns2:code']);

      if (!$row) {
        $row = new Okved2();
      }

      $row->update($item['ns2:nsiOkved2Data']);
      $this->entityManager->persist($row);
    }

    $this->entityManager->flush();

    return true;
  }

  /**
   * Получение текущего справочника валют
   *
   * @return array|string
   */
  private function uploadNsiOkv()
  {

    $dir = '/out/nsi/nsiOkv';
    $result = $this->getXmlData($dir, 'okv');

    $okv = $this->entityManager->getRepository(Okv::class);

    foreach ($result['ns2:body']['ns2:item'] as $item) {
      $row = $okv->findOneByCode($item['ns2:nsiOkvData']['ns2:digitalCode']);

      if (!$row) {
        $row = new Okv();
      }

      $row->update($item['ns2:nsiOkvData']);
      $this->entityManager->persist($row);
    }

    $this->entityManager->flush();

    return true;
  }

  /**
   * Получаем массив данных из xml
   *
   * @param $dir
   * @return array|string
   * @throws \FtpClient\FtpException
   */
  private function getXmlData($dir, $prefix)
  {

    $xml = array();
    $ls = $this->ftp->nlist($dir);

    $name = $ls[count($ls) - 1];

    $fileZip = $this->uploadFtpFile($name, $prefix);
    $dirname = $this->extractZip($fileZip);
    $files = $this->getDirEntries($dirname);

    foreach ($files as $file) {
      $xml = $this->fromFile($dirname . '/' . $file);
    }

    return $xml;

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
    $this->reader = new XMLReader();
    $this->reader->open($filename, null, LIBXML_XINCLUDE);

    $this->directory = dirname($filename);

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
    $this->reader->close();

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
   * @return string
   */
  private function processNextElement()
  {
    $children = [];
    $text = '';

    while ($this->reader->read()) {
      if ($this->reader->nodeType === XMLReader::ELEMENT) {
        if ($this->reader->depth === 0) {
          return $this->processNextElement();
        }

        $attributes = $this->getAttributes();
        $name = $this->reader->name;

        if ($this->reader->isEmptyElement) {
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
      } elseif ($this->reader->nodeType === XMLReader::END_ELEMENT) {
        break;
      } elseif (in_array($this->reader->nodeType, $this->textNodes)) {
        $text .= $this->reader->value;
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

    if ($this->reader->hasAttributes) {
      while ($this->reader->moveToNextAttribute()) {
        $attributes[$this->reader->localName] = $this->reader->value;
      }

      $this->reader->moveToElement();
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

    $ls = $this->ftp->nlist($dir);

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

    $uploadFiles = $this->entityManager->getRepository(UploadFiles::class);

    foreach ($zipFiles as $f) {
      $result = $uploadFiles->findOneByName($f);

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

      $this->saveUploadFile($f);
    }

  }

  /**
   * Обновление информации о планах
   *
   * @param $xml
   */
  private function updatePurchasePlan($xml)
  {

    $purchasePlan = $this->entityManager->getRepository(PurchasePlan::class);
    $plan = $purchasePlan->findOneByRegistrationnumber($xml['ns2:registrationNumber']);

    if (!$plan) {
      $plan = new PurchasePlan();
    }

    // Создаем/обновляем план
    $plan->updatePlan($xml);
    $this->entityManager->persist($plan);

    // Удаляем все позиции и создаем их заново
    $planitems = $plan->getPlanitems();

    $this->removeCollection($planitems);

    $plan->updatePlanItems($xml['ns2:purchasePlanItems']);
    $this->entityManager->persist($plan);

    $this->entityManager->flush();
  }

  /**
   * Удаление всех сущностей из базы
   *
   * @param $planitems
   */
  private function removeCollection($collection)
  {
    foreach ($collection as $item) {
      $this->entityManager->remove($item);
    }
    $this->entityManager->flush();
  }

  /**
   * Сохраняем название файла который скачали и обработали
   *
   * @param $f
   */
  private function saveUploadFile($f)
  {
    $uploadFile = new UploadFiles();
    $uploadFile->update(['dateupdate' => date('c'), 'name' => $f]);
    $this->entityManager->persist($uploadFile);
    $this->entityManager->flush();
  }

}