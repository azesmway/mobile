<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 13.09.2018
 * Time: 21:51
 */

namespace Application\Model;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Contragents;
use Application\Entity\PurchasePlanItems;
use RuntimeException;

class EntityBase extends EntityRepository
{

  /**
   * Справочник где есть секции или группы
   *
   * @var array
   */
  protected $_isSectionOrGroup = [
    'Application\Entity\Okei'
  ];

  /**
   * @param string $method
   * @param array $arguments
   * @return EntityBase|mixed|null
   * @throws \Doctrine\ORM\ORMException
   */
  public function __call($method, $arguments) {
    $result = null;

    if (preg_match('@^(set|get)(.+)$@i', $method, $matches)) {
      $name = strtolower($matches[2]);
      $property = $this->_class->getFieldName($name);

      if (!empty($property)) {
        if ('set' === strtolower($matches[1])) {
          if (count($arguments) < 1) {
            throw new RuntimeException("Set what? (in {$method})");
          }

          $value = $arguments[0];

          return $this->_setValue($property, $value);
        } else {

          return $this->_getValue($property);
        }
      }
    }

    $result = parent::__call($method, $arguments);

    if ($result) {
      $result->_class = $this->getClassMetadata();
      $result->_entityName = $this->getEntityName();
    }

    return $result;
  }

  /**
   * @param $property
   * @param $value
   * @return $this
   */
  protected function _setValue($property, $value) {
    $method = 'set' . ucfirst($property);

    if (!method_exists($this, $method)) {
      $this->$property = $value;
      return $this;
    }

    return $this->$method($value);
  }

  /**
   * @param $property
   * @return null
   */
  protected function _getValue($property) {
    $method = 'get' . ucfirst($property);

    if (!method_exists($this, $method)) {
      return isset($this->$property) ? $this->$property : null;
    }

    return $this->$method();
  }

  /**
   * Обновляем данные в сущности
   *
   * @param array $entity
   */
  public function update($entity) {
    foreach ($entity as $name => $val) {
      $ind = strtolower(str_replace('ns2:', '', $name));

      if (in_array($this->getEntityName(), $this->_isSectionOrGroup) && ($ind === 'section' || $ind === 'group')) {
        $fun = 'set' . ucfirst($ind . 'code');
        $this->$fun($entity[$name]['ns2:code']);

        $fun = 'set' . ucfirst($ind . 'name');
        $this->$fun($entity[$name]['ns2:name']);

      } else {
        $fun = 'set' . ucfirst($ind);
        $this->$fun($entity[$name]);
      }
    }
  }

  /**
   * Обновляем данные в сущности PurchasePlan
   *
   * @param array $plan
   */
  public function updatePlan($plan) {
    $excludeFields = ['purchaseplanitems', 'purchaseplanitemssmb', 'attachments'];

    foreach ($plan as $name => $val) {
      $ind = strtolower(str_replace('ns2:', '', $name));

      if (in_array($ind, $excludeFields)) {
        continue;
      }

      if ($ind === 'urloos') {
        $ind = 'urleis';
      }

      if ($ind === 'customer') {
        $customer = $this->getCustomer();

        if (!$customer) {
          $customer = new Contragents();
        }

        $customer->update($plan['ns2:customer']['mainInfo']);
        $this->setCustomer($customer);

      } elseif ($ind === 'placer') {

        $customer = $this->getCustomer();
        $placer = $this->getPlacer();

        if (!$placer) {
          $info = $plan['ns2:placer']['mainInfo'];

          if ($customer->getIko() === $info['iko'] && $customer->getInn() === $info['inn'] && $customer->getKpp() === $info['kpp']) {
            $placer = $customer;
          } else {
            $placer = new Contragents();
            $placer->update($info);
          }
        }

        $this->setPlacer($placer);

      } else {
        $fun = 'set' . ucfirst($ind);
        $this->$fun($plan[$name]);
      }
    }
  }

  /**
   * Обновляем данные в сущности PurchasePlanItems
   *
   * @param $planitems
   */
  public function updatePlanItems($items) {
    foreach ($items as $data) {
      if (!empty($data[0])) {
        foreach ($data as $row) {
          $item = new PurchasePlanItems($this->_em, $this->_class);
          $item->updateItem($row);
          $item->setPlanid($this);
          $this->setPlanitems($item);
        }
      } else {
        $item = new PurchasePlanItems($this->_em, $this->_class);
        $item->updateItem($data);
        $item->setPlanid($this);
        $this->setPlanitems($item);
      }
    }
  }

  /**
   * Обновление по каждой позиции плана
   *
   * @param $item
   */
  public function updateItem($item) {
    $excludeFields = ['changedgwsanddates', 'changednmskmoretenpercent', 'otherchanges', 'longterm', 'longtermvolumes', 'longtermsmbvolumes',
      'initialpositionid', 'purchaseplanneddate', 'purchasecategory', 'initialpositiondata'];

    foreach ($item as $nameItem => $itm) {
      $indItem = strtolower(str_replace('ns2:', '', $nameItem));

      if (in_array($indItem, $excludeFields)) {
        continue;
      }

      if ($indItem === 'purchaseplandataitemrows') {

      } elseif ($indItem === 'currency') {

      } elseif ($indItem === 'planitemcustomer') {

      } else {
        $fun = 'set' . ucfirst($indItem);
        $this->$fun($item[$nameItem]);
      }
    }
  }

}
