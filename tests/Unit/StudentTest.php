<?php

namespace Tests\Unit;

use App\test\Student;
use PHPUnit\Framework\TestCase;


class StudentTest extends TestCase
{
    public function test_set_student_name()
    {

        $student = new Student();
        $student->setName('mohammadreza');

        $name = $student->getName();

        $this->assertEquals($name, 'mohammadreza');;
    }
}
