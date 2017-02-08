<?php
  /**
    * Name: dbclass.php
    * Use For: config.php
    * Created By: Mohit Dadu
    * Description: class file used to connect and fetch data from database.
    */
	
	// connecting to the Filemaker Api
    require_once ('filemakerapi/FileMaker.php');
		
    class Database {

        var $database;
        var $host;
        var $username;
        var $password;
        var $connection;

        // function to initialize database variables
        public function initDB($db, $host, $user, $pass)
        {
            $this->database = $db;
            $this->host = $host;
            $this->username = $user;
            $this->password = $pass;
        }

        // function to connect database 
        public function connDB()
        {
            $this->connection = new FileMaker($this->database, $this->host, $this->username, $this->password);
    
            if (FileMaker::isError($this->connection)) {
                return false;
            }
        return true;
        }

        // function to fetch all data from database
        public function fetchData($layout)
        {   
            if(!$this->connDB()) {
                return false;
            }

            $request = $this->connection->newFindAllCommand($layout);
            $result = $request->execute();
            $records = $result->getRecords();
            if (FileMaker::isError($records)) {
                echo $records->getMessage();
                return false;
            } 
            return $result->getRecords();
        }
        
        // to find the particular data from database
        public function findCard($layout, $id)
        {   
            if(!$this->connDB()) {
                return false;
            }

            $request = $this->connection->newFindCommand($layout);
            $request->addFindCriterion('cardId', $id);
            $result = $request->execute();
            $records = $result->getRecords();
            if (FileMaker::isError($records)) {
                return false;
            } 
            return $result->getRecords();
        }

        // to add new data into the card database
        public function addCard($layout, $name, $email, $phone)
        {   
            if(!$this->connDB()) {
                return false;
            }

            $record = $this->connection->createRecord($layout);
            $record->setField('studentName', $name);
            $record->setField('email', $email);
            $record->setField('phoneNo', $phone);
            $result = $record->commit();
            
            if (FileMaker::isError($result)) { 
                return false;
            } else {
                return true;
            }
        }

        // function to delete the student data from database
        public function deleteCard($dataId)
        {   
            if(!$this->connDB()) {
                return false;
            }

            $id = $dataId;
            $deleteRecord = $this->connection->newDeleteCommand('cardData', $id);
            $result = $deleteRecord->execute();
            header("Location: index.php");
        }

        // to edit the record 
        public function editRecord($layout, $id, $name, $email, $phone)
        {
            //$layout, $name, $email are of string and $id, $phone are of integer type.

            //checking the connection with the database.
            if(!$this->connDB()) {
                return false;
            }

            $request = $this->connection->newFindCommand($layout);
            $request->addFindCriterion('cardId', $id);
            $result = $request->execute();

            if (FileMaker::isError($result)) { 
                return false;
            } else {
                $records = $result->getRecords();
                
                //  fetching record from database
                foreach ($records as $record) {
                    $record->setField('studentName', $name);
                    $record->setField('email', $email);
                    $record->setField('phoneNo', $phone);
                    $record->commit();
                    return true;
                }
            }
        }

        // to find the book from database 
        public function findBook($layout, $searchName)
        {   
            //$layout and $searchName are of string type.

            //checking the connection with the database.
            if(!$this->connDB()) {
                return false;
            }

            $request = $this->connection->newFindCommand($layout);
            $request->addFindCriterion('bookName', $searchName);
            $result = $request->execute();
            $records = $result->getRecords();
            if (FileMaker::isError($records)) {
                echo $records->getMessage();
                return false;
            } 
            return $result->getRecords();
        }

        public function issueBook($layout, $cardId, $bookId)
        {
            if(!$this->connDB()) {
                return false;
            }

            $record = $this->connection->createRecord($layout);
            $record->setField('cardId', $cardId);
            $record->setField('bookId', $bookId);
            $result = $record->commit();            
            if (FileMaker::isError($result)) { 
                return false;
            } else {
                return true;
            }
        }

    }


