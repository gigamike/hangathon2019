<?php
namespace Member\Model;

class MedicalRecordEntity
{
	protected $id;
	protected $public_address;
	protected $smart_contract_key;
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

	public function getPublicAddress()
	{
		return $this->public_address;
	}

	public function setPublicAddress($value)
	{
		$this->public_address = $value;
	}

	public function getSmartContractKey()
	{
		return $this->smart_contract_key;
	}

	public function setSmartContractKey($value)
	{
		$this->smart_contract_key = $value;
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
