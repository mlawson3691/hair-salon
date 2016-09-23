<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Jill";
            $test_stylist = new Stylist($name);

            //Act
            $test_stylist->save();
            $output = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist], $output);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Jill";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Susan";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $output = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist1, $test_stylist2], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = "Jill";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Susan";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $output = Stylist::getAll();

            //Assert
            $this->assertEquals([], $output);
        }
    }

?>
