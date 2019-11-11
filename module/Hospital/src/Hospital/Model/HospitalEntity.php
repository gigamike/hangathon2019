<?php
namespace Hospital\Model;

class HospitalEntity
{
	protected $id;
	protected $name;
	protected $address;
	protected $city_id;
	protected $created_datetime;

	public function __construct()
	{
		$this->created_datetime = date('Y-m-d H:i:s');
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($value)
	{
		$this->name = $value;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($value)
	{
		$this->address = $value;
	}

	public function getCityId()
	{
		return $this->city_id;
	}

	public function setCityId($value)
	{
		$this->city_id = $value;
	}

	public function getCreatedDatetime()
	{
		return $this->created_datetime;
	}

	public function setCreatedDatetime($value)
	{
		$this->created_datetime = $value;
	}
}
