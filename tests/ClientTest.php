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

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Bob";
            $stylist_id = 1;
            $test_client = new Client($name, $stylist_id);

            //Act
            $test_client->save();
            $output = Client::getAll();

            //Assert
            $this->assertEquals([$test_client], $output);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Bob";
            $stylist_id1 = 1;
            $test_client1 = new Client($name1, $stylist_id1);
            $test_client1->save();

            $name2 = "Bill";
            $stylist_id2 = 2;
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();

            //Act
            $output = Client::getAll();

            //Assert
            $this->assertEquals([$test_client1, $test_client2], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = "Bob";
            $stylist_id1 = 1;
            $test_client1 = new Client($name1, $stylist_id1);
            $test_client1->save();

            $name2 = "Bill";
            $stylist_id2 = 2;
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $output = Client::getAll();

            //Assert
            $this->assertEquals([], $output);
        }

        function test_find()
        {
            //Arrange
            $name1 = "Bob";
            $stylist_id1 = 1;
            $test_client1 = new Client($name1, $stylist_id1);
            $test_client1->save();

            $name2 = "Bill";
            $stylist_id2 = 2;
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();

            //Act
            $output = Client::find($test_client1->getId());

            //Assert
            $this->assertEquals($test_client1, $output);
        }

        function test_update()
        {
            //Arrange
            $name = "Bob";
            $stylist_id = 1;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();

            $new_name = "Bill";

            //Act
            $test_client->update($new_name);
            $output = $test_client->getName();

            //Assert
            $this->assertEquals($new_name, $output);
        }
    }
?>
