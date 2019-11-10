pragma solidity >=0.4.22 <0.6.0;

contract MedicalRecord {
    struct PatientRecord{
      uint256 id;
      address patientAddress;
      string hospital;
      string doctor;
      string diagnostics;
      string prescriptions;
   }

   PatientRecord[] public patientRecords;
   uint256 public nextId;

   function setMedicalRecord(address _patientAddress, string memory _hospital, string memory _doctor, string memory _diagnostics, string memory _prescriptions) public{
    patientRecords.push(PatientRecord(nextId, _patientAddress, _hospital, _doctor, _diagnostics, _prescriptions));
    nextId++;
   }

   function read(uint256 id) view public returns(uint256, address, string memory, string memory, string memory, string memory){
      for(uint256 i=0; i<patientRecords.length; i++){
        if(patientRecords[i].id == id){
            return(patientRecords[i].id, patientRecords[i].patientAddress, patientRecords[i].hospital, patientRecords[i].doctor, patientRecords[i].diagnostics, patientRecords[i].prescriptions);
        }
      }
   }

   uint storedData;

    function set(uint x) public {
        storedData = x;
    }

    function get() public view returns (uint) {
        return storedData;
    }
}
