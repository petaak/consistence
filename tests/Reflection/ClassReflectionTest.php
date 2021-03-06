<?php

declare(strict_types = 1);

namespace Consistence\Reflection;

use ReflectionClass;

class ClassReflectionTest extends \Consistence\TestCase
{

	public function testStaticConstruct()
	{
		$this->expectException(\Consistence\StaticClassException::class);

		new ClassReflection();
	}

	public function testGetDeclaredMethods()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$methods = ClassReflection::getDeclaredMethods($classReflection);
		$this->assertCount(1, $methods);
		$this->assertSame('barMethod', $methods[0]->name);
	}

	public function testHasDeclaredMethod()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$this->assertTrue(ClassReflection::hasDeclaredMethod($classReflection, 'barMethod'));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'fooMethod'));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'xxx'));
		$this->assertTrue(ClassReflection::hasDeclaredMethod($classReflection, 'barMethod', ClassReflection::CASE_SENSITIVE));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'barmethod', ClassReflection::CASE_SENSITIVE));
	}

	public function testHasDeclaredMethodCaseSensitive()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$this->assertTrue(ClassReflection::hasDeclaredMethod($classReflection, 'barMethod', ClassReflection::CASE_SENSITIVE));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'barmethod', ClassReflection::CASE_SENSITIVE));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'xxx', ClassReflection::CASE_SENSITIVE));
	}

	public function testHasDeclaredMethodCaseInsensitive()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$this->assertTrue(ClassReflection::hasDeclaredMethod($classReflection, 'barMethod', ClassReflection::CASE_INSENSITIVE));
		$this->assertTrue(ClassReflection::hasDeclaredMethod($classReflection, 'barmethod', ClassReflection::CASE_INSENSITIVE));
		$this->assertFalse(ClassReflection::hasDeclaredMethod($classReflection, 'xxx', ClassReflection::CASE_INSENSITIVE));
	}

	public function testGetDeclaredProperties()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$properties = ClassReflection::getDeclaredProperties($classReflection);
		$this->assertCount(1, $properties);
		$this->assertSame('bar', $properties[0]->name);
	}

	public function testHasDeclaredProperty()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$this->assertTrue(ClassReflection::hasDeclaredProperty($classReflection, 'bar'));
		$this->assertFalse(ClassReflection::hasDeclaredProperty($classReflection, 'foo'));
		$this->assertFalse(ClassReflection::hasDeclaredProperty($classReflection, 'xxx'));
	}

	public function testGetDeclaredConstants()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$constants = ClassReflection::getDeclaredConstants($classReflection);
		$this->assertCount(1, $constants);
		$this->assertArrayHasKey('BAR', $constants);
	}

	public function testHasDeclaredConstant()
	{
		$classReflection = new ReflectionClass(Bar::class);
		$this->assertTrue(ClassReflection::hasDeclaredConstant($classReflection, 'BAR'));
		$this->assertFalse(ClassReflection::hasDeclaredConstant($classReflection, 'FOO'));
		$this->assertFalse(ClassReflection::hasDeclaredConstant($classReflection, 'XXX'));
	}

}
