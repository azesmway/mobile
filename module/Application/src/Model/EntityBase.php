<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 13.09.2018
 * Time: 21:51
 */

namespace Application\Model;

use Application\Entity\Contragents;
use Application\Entity\PurchasePlanItems;

class EntityBase
{

  /**
   * Обновляем данные в сущности
   *
   * @param array $entity
   */
  public function update($entity)
  {
    foreach ($entity as $name => $val) {
      $ind = strtolower(str_replace('ns2:', '', $name));
      $fun = 'set' . ucfirst($ind);
      $this->$fun($entity[$name]);
    }
  }

  /**
   * Обновляем данные в сущности PurchasePlan
   *
   * @param array $plan
   */
  public function updatePlan($plan)
  {
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
          $item = new PurchasePlanItems();
          $item->updateItem($row);
          $item->setPlanid($this);
          $this->setPlanitems($item);
        }
      } else {
        $item = new PurchasePlanItems();
        $item->updateItem($data);
        $item->setPlanid($this);
        $this->setPlanitems($item);
      }
    }
  }

  /**
   * @param $item
   */
  public function updateItem($item)
  {
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