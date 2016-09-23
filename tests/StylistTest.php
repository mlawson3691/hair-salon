<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
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

        function test_find()
        {
            //Arrange
            $name1 = "Jill";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Susan";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $output = Stylist::find($test_stylist1->getId());

            //Assert
            $this->assertEquals($test_stylist1, $output);
        }

        function test_findClients()
        {
            //Arrange
            $name1 = "Jill";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Susan";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            $name1 = "Bob";
            $stylist_id1 = $test_stylist1->getId();
            $test_client1 = new Client($name1, $stylist_id1);
            $test_client1->save();

            $name2 = "Bill";
            $stylist_id2 = $test_stylist2->getId();
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();

            //Act
            $output = $test_stylist1->findClients();

            //Assert
            $this->assertEquals([$test_client1], $output);
        }

        function test_update()
        {
            //Arrange
            $name = "Jill";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $new_name = "Jillie";

            //Act
            $test_stylist->update($new_name);
            $output = $test_stylist->getName();

            //Assert
            $this->assertEquals($new_name, $output);
        }

        function test_delete()
        {
            //Arrange
            $name1 = "Jill";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Susan";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $test_stylist1->delete();
            $output = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist2], $output);
        }
    }

?>
