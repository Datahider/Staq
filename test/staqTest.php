<?php

namespace losthost\Staq\test;
use PHPUnit\Framework\TestCase;
use losthost\Staq\staq;


class staqTest extends TestCase {
    
    public function testStack() {
        
        $stack1 = new staq('test', 1);
        $stack2 = new staq('test', 2);
        
        $stack1->clear();
        $stack2->clear();
        
        $this->assertEquals(7, $stack1->push(7));
        $this->assertEquals('some string', $stack1->push('some string'));
        $this->assertEquals([1, 2, 3], $stack1->push([1, 2, 3]));
        
        $this->assertEquals('777', $stack2->push('777'));
        
        $this->assertEquals([1, 2, 3], $stack1->pop());
        $this->assertEquals('some string', $stack1->pop());
        $this->assertEquals(7, $stack1->pop());
        
        $this->assertEquals('777', $stack2->pop());

    }

    public function testQueue() {
        
        $queue1 = new staq('test', 1);
        $queue2 = new staq('test', 2);
        
        $this->assertEquals(7, $queue1->push(7));
        $this->assertEquals('some string', $queue1->push('some string'));
        $this->assertEquals([1, 2, 3], $queue1->push([1, 2, 3]));
        
        $this->assertEquals('777', $queue2->push('777'));
        
        $this->assertEquals(7, $queue1->shift());
        $this->assertEquals('some string', $queue1->shift());
        $this->assertEquals([1, 2, 3], $queue1->shift());
        
        $this->assertEquals('777', $queue2->shift());

    }
    
    public function testPopException() {
        
        $this->expectExceptionMessage('empty');
        $stack = new staq('1');
        $stack->clear();
        $stack->pop();

    }

    public function testClear() {

        $q = new staq('1');
        $q->clear();
        $q->push(111);
        $q->clear();
        
        $this->expectExceptionMessage('empty');
        $q->shift();

    }
}
