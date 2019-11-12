pragma solidity >=0.4.22 <0.6.0;

contract MedicalRecordFactory {
  address[] public deployedMedicalRecords;

  function createMedicalRecord() public {
    address newMedicalRecord = address(new MedicalRecord(msg.sender));
    deployedMedicalRecords.push(newMedicalRecord);
  }

  function getDeployedMedicalRecords() public view returns (address[] memory) {
    return deployedMedicalRecords;
  }
}

contract MedicalRecord {
    address public owner;

    struct PatientRecord{
      uint256 id;
      address patientAddress;
      string hospital;
      string doctor;
      string diagnostics;
      string prescriptions;
      uint time;
   }

   PatientRecord[] public patientRecords;
   uint256 public nextId;

   constructor(address creator) public {
    owner = creator;
  }

   function setMedicalRecord(address _patientAddress, string memory _hospital, string memory _doctor, string memory _diagnostics, string memory _prescriptions, uint _time) public{
    patientRecords.push(PatientRecord(nextId, _patientAddress, _hospital, _doctor, _diagnostics, _prescriptions, _time));
    nextId++;
   }

   function read(uint256 id) view public returns(uint256, address, string memory, string memory, string memory, string memory, uint){
      for(uint256 i=0; i<patientRecords.length; i++){
        if(patientRecords[i].id == id){
            return(patientRecords[i].id, patientRecords[i].patientAddress, patientRecords[i].hospital, patientRecords[i].doctor, patientRecords[i].diagnostics, patientRecords[i].prescriptions, patientRecords[i].time);
        }
      }
   }

   function getMedicalRecordCount() public view returns (uint) {
    return patientRecords.length;
  }
}
