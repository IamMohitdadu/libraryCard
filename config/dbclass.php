<?php
/**
* Name: dbclass.php
* Use For: config.php
* Created By: Mohit Dadu
* Description: class file used to connect and fetch data from database.
*/

// connecting to the Filemaker Api
require_once ('./library/vendor/filemakerapi/FileMaker.php');

/* database class for performing CRUD operations. */	
class Database {

    public $database;
    public $host;
    public $username;
    public $password;
    public $connection;

    /* function to initialize database variables */
    public function initDB($db, $host, $user, $pass)
    {
        $this->database = $db;
        $this->host = $host;
        $this->username = $user;
        $this->password = $pass;
    } // end of function initDB.

    /* function to connect database */
    public function connDB()
    {
        $this->connection = new FileMaker($this->database, $this->host, $this->username, $this->password);

        // checking the error for database connection.
        if (FileMaker::isError($this->connection)) {
            return false;
        }

        return true;
    } //end of function connDB.

    /* function to fetch all data from database 
       and $layout is the layout name*/
    public function fetchData($layout)
    {   
        //checking for the database connection.
        if (!$this->connDB()) {
            return false;
        }

        $request = $this->connection->newFindAllCommand($layout);
        $result = $request->execute();
        $records = $result->getRecords();

        // checking the error to get records.
        if (FileMaker::isError($records)) {
            echo $records->getMessage();
            return false;
        } 

        return $result->getRecords();
    } // end of function fetchData.
    
    /* to find the particular data from database 
       id is of integer type. */
    public function findCard($layout, $id)
    {   
        //checking for the database connection.
        if (!$this->connDB()) {
            return false;
        }

        $request = $this->connection->newFindCommand($layout);
        $request->addFindCriterion('cardId', $id);
        $result = $request->execute();

        // checking the error to get records.
        if (FileMaker::isError($result)) {
            return false;
        } 

        $records = $result->getRecords();

        // checking the error to get records.
        if (FileMaker::isError($records)) {
            return false;
        } 
        return $result->getRecords();
    } // end of function findCard.

    /* to add new data into the card database and $layout, $name, $email 
       are of string and $phone is of integer type. */
    public function addCard($layout, $name, $email, $phone)
    {   
        //checking for the database connection.
        if (!$this->connDB()) {
            return false;
        }
        
        // storing the data into the database.
        $record = $this->connection->createRecord($layout);
        $record->setField('studentName', $name);
        $record->setField('email', $email);
        $record->setField('phoneNo', $phone);
        $result = $record->commit();

        // checking the error to get records.
        if (FileMaker::isError($result)) { 
            error_log("unable to add-".$result->getMessage(), 3, "./errorLog/errors.txt");
            return false;
        } else {
            return true;
        }
    }// end of function addCard.

    /* function to delete the student data from database
       and $dataId is of integer type. */
    public function deleteCard($dataId)
    {   
        //checking for the database connection.
        if (!$this->connDB()) {
            return false;
        }

        $id = $dataId;
        $deleteRecord = $this->connection->newDeleteCommand('cardData', $id);
        $result = $deleteRecord->execute();
    } // end of function deleteCard.

    /* to edit the student data into the database and $layout, $name, $email
       are of string and $id, $phone are of integer type. */
    public function editRecord($layout, $id, $name, $email, $phone)
    {
        //checking for the database connection.
        if(!$this->connDB()) {
            return false;
        }

        $request = $this->connection->newFindCommand($layout);
        $request->addFindCriterion('cardId', $id);
        $result = $request->execute();
        
        // checking the error to get records.
        if (FileMaker::isError($result)) { 
            return false;
        } else {
            $records = $result->getRecords();
            //  storing data record into database
            foreach ($records as $record) {
                $record->setField('studentName', $name);
                $record->setField('email', $email);
                $record->setField('phoneNo', $phone);
                $record->commit();
            }
            return true;
        }
    } // end of function editRecord.

    /* function to delete the student data from database
       and dataId is integer type. */
    public function deleteIssuedBook($dataId)
    {   
        //checking for the database connection.
        if(!$this->connDB()) {
            return false;
        }

        $id = $dataId;
        $deleteRecord = $this->connection->newDeleteCommand('cardBook', $id);
        $result = $deleteRecord->execute();
        return true;
    } // end of function deleteIssuedBook.

    /* to issue the book to the particular student and
       cardId and bookId is integer type. */
    public function issueBook($layout, $cardId, $bookId)
    {
        //checking for the database connection.
        if(!$this->connDB()) {
            return false;
        }
         
        // storing data into the database.
        $record = $this->connection->createRecord($layout);
        $record->setField('cardId', $cardId);
        $record->setField('bookId', $bookId);
        $result = $record->commit();   
        
        // checking the error to get records.
        if (FileMaker::isError($result)) { 
            return false;
        } else {
            return true;
        }
    } // end of function issueBook.

}// end of Database class.