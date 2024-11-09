<?php
class EmployeeRoster {
    private $roster;

    public function __construct($rosterSize) {
        $this->roster = array_fill(0, $rosterSize, null);
    }

    public function getRoster() {
        return $this->roster;
    }

    public function setRoster($roster) {
        $this->roster = $roster;
    }

    public function add(Employee $e) {
        for ($i = 0; $i < count($this->roster); $i++) {
            if ($this->roster[$i] === null) {
                $this->roster[$i] = $e;
                return;
            }
        }
        echo "Roster is full. Cannot add more employees.\n";
    }

    public function remove($employee_number) {
        if (isset($this->roster[$employee_number])) {
            $this->roster[$employee_number] = null;
        } else {
            echo "Employee not found.\n";
        }
    }

    public function count() {
        return count(array_filter($this->roster));
    }

    public function countCE() {
        return count(array_filter($this->roster, function($e) {
            return $e instanceof CommissionEmployee;
        }));
    }

    public function countHE() {
        return count(array_filter($this->roster, function($e) {
            return $e instanceof HourlyEmployee;
        }));
    }

    public function countPE() {
        return count(array_filter($this->roster, function($e) {
            return $e instanceof PieceWorker;
        }));
    }

    public function display() {
        foreach ($this->roster as $employee) {
            if ($employee !== null) {
                echo $employee . "\n";
            }
        }
    }

    public function displayCE() {
        foreach ($this->roster as $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo $employee . "\n";
            }
        }
    }

    public function displayHE() {
        foreach ($this->roster as $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo $employee . "\n";
            }
        }
    }

    public function displayPE() {
        foreach ($this->roster as $employee) {
            if ($employee instanceof PieceWorker) {
                echo $employee . "\n";
            }
        }
    }

    public function payroll() {
        foreach ($this->roster as $employee) {
            if ($employee !== null) {
                echo $employee->getName() . " earns: " . $employee->earnings() . "\n";
            }
        }
    }
}
?>