<?php

class Main {

    private EmployeeRoster $roster;
    private $size;
    private $repeat;

    public function start() {
        $this->clear();
        $this->repeat = true;

        $this->size = (int)readline("Enter the size of the roster: ");

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        } else {
            $this->roster = new EmployeeRoster($this->size);
            $this->entrance();
        }
    }

    public function entrance() {
        $choice = 0;

        while ($this->repeat) {
            $this->clear();
            $this->menu();
            $choice = (int)readline("Pick from the menu: "); // Read user input

            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    $this->repeat = false; // Exit the loop
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    break;
            }
        }
        echo "Process terminated.\n";
        exit;
    }

    public function menu() {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu() {
        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $age = (int)readline("Enter age: ");
        $cName = readline("Enter company name: ");
        $this->empType($name, $address, $age, $cName);
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        echo "---Employee Details---\n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";
        echo "[1] Commission Employee       [2] Hourly Employee       [3] Piece Worker\n";
        $type = (int)readline("Choose type of Employee: ");

        switch ($type) {
            case 1:
                $regularSalary = (float)readline("Enter regular salary: ");
                $itemSold = (int)readline("Enter items sold: ");
                $commissionRate = (float)readline("Enter commission rate: ");
                $employee = new CommissionEmployee($name, $address, $age, $cName, $regularSalary, $itemSold, $commissionRate);
                break;
            case 2:
                $hoursWorked = (int)readline("Enter hours worked: ");
                $rate = (float)readline("Enter hourly rate: ");
                $employee = new HourlyEmployee($name, $address, $age, $cName, $hoursWorked, $rate);
                break;
            case 3:
                $numberItems = (int)readline("Enter number of items: ");
                $wagePerItem = (float)readline("Enter wage per item: ");
                $employee = new PieceWorker($name, $address, $age, $cName, $numberItems, $wagePerItem);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->empType($name, $address, $age, $cName);
                return; // Exit the method
        }

        $this->roster->add($employee);
        $this->repeat();
    }

    public function deleteMenu() {
        $this->clear();
        echo "***List of Employees on the current Roster***\n";
        $this->roster->display();
        $employeeNumber = (int)readline("Enter employee number to delete: ");
        $this->roster->remove($employeeNumber);
        readline("\nPress \"Enter\" key to continue...");
        $this->entrance();
    }

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->roster->display();
                break;
            case 2:
                echo "Total Employees: " . $this->roster->count() . "\n";
                break;
            case 3:
                $this->roster->payroll();
                break;
            case 0:
                return;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->otherMenu();
    }

    public function clear() {
        system('clear');
    }

    public function repeat() {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more? (y to continue): ");
            if (strtolower($c) == 'y') {
                $this->addMenu();
            } else {
                $this->entrance();
            }
        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance();
        }
    }
}

