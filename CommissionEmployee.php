<?php
class CommissionEmployee extends Employee {
    private $regularSalary;
    private $itemSold;
    private $commission_rate;

    public function __construct($name, $address, $age, $companyName, $regularSalary, $itemSold, $commission_rate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->regularSalary = $regularSalary;
        $this->itemSold = $itemSold;
        $this->commission_rate = $commission_rate;
    }

    public function getRegularSalary() {
        return $this->regularSalary;
    }
    public function getItemSold() {
        return $this->itemSold;
    }
    public function getCommissionRate() {
        return $this->commission_rate;
    }

    public function setRegularSalary($regularSalary) {
        $this->regularSalary = $regularSalary;
    }
    
    public function setItemSold($itemSold) {
        $this->itemSold = $itemSold;
    }

    public function setCommissionRate($commissionRate) {
        $this->commission_rate = $commissionRate;
    }


    public function earnings() {
        return $this->regularSalary + ($this->itemSold * $this->commission_rate);
    }

    public function __toString() {
        return "Commission Employee: \n".parent::__toString() . "Regular Salary: $this->regularSalary\nItems Sold: $this->itemSold\nCommission Rate: $this->commission_rate\n";
    }
}
?>