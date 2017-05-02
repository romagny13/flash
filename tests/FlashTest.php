<?php

use \MicroPHP\Flash\Flash;

class FlashTest extends PHPUnit_Framework_TestCase
{
    function testAddMessages_OfType() {

        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);
        $flash
            ->addMessage('success','success message 1')
            ->addMessage('success','success message 2');
        
        $this->assertTrue($flash->has('success'));
        $messages = $flash->getMessages('success');
        $this->assertEquals(2, count($messages));
        $this->assertEquals('success message 1', $messages[0]);
        $this->assertEquals('success message 2', $messages[1]);
    }


    function testAddMessages_OfTypes() {

        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);
        $flash
            ->addMessage('success','success message 1')
            ->addMessage('success','success message 2')
            ->addMessage('error','error message 1')
            ->addMessage('error','error message 2');

        $this->assertTrue($flash->has('success'));
        $messages = $flash->getMessages('success');
        $this->assertEquals(2, count($messages));
        $this->assertEquals('success message 1', $messages[0]);
        $this->assertEquals('success message 2', $messages[1]);

        $errors = $flash->getMessages('error');
        $this->assertEquals(2, count($errors));
        $this->assertEquals('error message 1', $errors[0]);
        $this->assertEquals('error message 2', $errors[1]);
    }

    function testGetMessages_MessagesOfType_AreDeleted() {
        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);;
        $flash
            ->addMessage('success','success message 1')
            ->addMessage('success','success message 2');

        $this->assertTrue($flash->has('success'));
        $messages = $flash->getMessages('success');
        $this->assertFalse($flash->has('success'));
    }

    function testGetMessages_MessagesOfTypeOnly_AreDeleted() {
        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);;
        $flash
            ->addMessage('success','success message 1')
            ->addMessage('success','success message 2')
            ->addMessage('error','error message 1')
            ->addMessage('error','error message 2');
        
        $this->assertTrue($flash->has('success'));
        $messages = $flash->getMessages('success');
        $this->assertFalse($flash->has('success'));
        $this->assertTrue($flash->has('error'));
    }

    function testGetOnlyFirstMessage() {
        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);;
        $flash
            ->addMessage('success','success message 1')
            ->addMessage('success','success message 2');

        $this->assertTrue($flash->has('success'));
        $message = $flash->getMessage('success');
        $this->assertEquals('success message 1', $message);
        $this->assertFalse($flash->has('success'));
    }

    function testShortCuts_AddMessagesAndRemoveOnGetMessages() {
        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);;
        
        $flash
            ->addSuccess('success message 1')
            ->addSuccess('success message 2')
            ->addWarning('warning message 1')
            ->addWarning('warning message 2')
            ->addError('error message 1')
            ->addError('error message 2');
        

        $this->assertTrue($flash->hasSuccess());
        $this->assertTrue($flash->hasWarning());
        $this->assertTrue($flash->hasError());
        $successMessages = $flash->getSuccessMessages();
        $warningMessages = $flash->getWarningMessages();
        $errorMessages = $flash->getErrorMessages();

        $this->assertEquals(2, count($successMessages));
        $this->assertEquals('success message 1', $successMessages[0]);
        $this->assertEquals('success message 2', $successMessages[1]);
        $this->assertEquals(2, count($warningMessages));
        $this->assertEquals('warning message 1', $warningMessages[0]);
        $this->assertEquals('warning message 2', $warningMessages[1]);
        $this->assertEquals(2, count($errorMessages));
        $this->assertEquals('error message 1', $errorMessages[0]);
        $this->assertEquals('error message 2', $errorMessages[1]);
        
        $this->assertFalse($flash->hasSuccess());
        $this->assertFalse($flash->hasWarning());
        $this->assertFalse($flash->hasError());
    }

    function testShortCuts_AddMessagesAndRemoveOnGetMessage() {
        $storage = new FakeFlashStorage();
        $flash = new Flash($storage);;

        $flash
            ->addSuccess('success message 1')
            ->addSuccess('success message 2')
            ->addWarning('warning message 1')
            ->addWarning('warning message 2')
            ->addError('error message 1')
            ->addError('error message 2');


        $this->assertTrue($flash->hasSuccess());
        $this->assertTrue($flash->hasWarning());
        $this->assertTrue($flash->hasError());
        $successMessage = $flash->getSuccess();
        $warningMessage = $flash->getWarning();
        $errorMessage = $flash->getError();
        
        $this->assertEquals('success message 1', $successMessage);
        $this->assertEquals('warning message 1', $warningMessage);
        $this->assertEquals('error message 1', $errorMessage);

        $this->assertFalse($flash->hasSuccess());
        $this->assertFalse($flash->hasWarning());
        $this->assertFalse($flash->hasError());
    }

}