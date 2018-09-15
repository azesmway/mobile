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
      if (function_exists($this->$fun($entity[$name]))){
        $this->$fun($entity[$name]);
      } else {
        // TODO Сделать логирование ошибки
      }
    }
  }

  /**
   * Обновляем данные в сущности PurchasePlan
   *
   * @param array $plan
   */
  public function updatePlan($plan)
  {
    foreach ($plan as $name => $val) {
      $ind = strtolower(str_replace('ns2:', '', $name));

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

      } elseif ($ind === 'purchaseplanitems') {

        // TODO Или полное удаление всей коллекции и как то пытаться найти и обновить
        $planitems = $this->getPlanitems();
        $planitems->clear();

        foreach ($plan['ns2:purchasePlanItems'] as $data) {
          if (!empty($data[0])) {
            foreach ($data as $row) {
              $item = new PurchasePlanItems();
              $item->updatePlanItem($row);
              $this->setPlanitems($item);
            }
          } else {
            $item = new PurchasePlanItems();
            $item->updatePlanItem($data);
            $this->setPlanitems($item);
          }
        }

      } elseif ($ind === 'purchaseplanitemssmb') {

      } elseif ($ind === 'attachments') {

      } else {
        $fun = 'set' . ucfirst($ind);
        if (function_exists($this->$fun($plan[$name]))) {
          $this->$fun($plan[$name]);
        } else {
          // TODO Сделать логирование ошибки
        }
      }
    }
  }

  /**
   * Обновляем данные в сущности PurchasePlanItems
   *
   * @param $planitems
   */
  public function updatePlanItem($item) {

      foreach ($item as $nameItem => $itm) {
        $indItem = strtolower(str_replace('ns2:', '', $nameItem));

        if ($indItem === 'purchaseplandataitemrows') {

        } elseif ($indItem === 'currency') {

        } elseif ($indItem === 'planitemcustomer') {

        } else {
          $fun = 'set' . ucfirst($indItem);

          if (function_exists($this->$fun($item[$nameItem]))) {
            $this->$fun($item[$nameItem]);
          } else {
            // TODO Сделать логирование ошибки
          }
        }
      }

  }
}